import asyncio
import os
import json
from aiohttp import web
from app.services import locket, nextdns, sepay
from app.config import NEXTDNS_KEY, TOKEN_SETS, PREMIUM_PRICE, T
from app import database as db

# Simple rate limiter
active_requests = set()

async def serve_index(request):
    filepath = os.path.join(os.path.dirname(__file__), "static", "index.html")
    return web.FileResponse(filepath)

async def api_resolve(request):
    try:
        body = await request.text()
        print(f"DEBUG: Received resolve request body: {body}")
        if not body:
             return web.json_response({"error": "Empty body"}, status=400)
        data = await request.json()
    except Exception as e:
        print(f"DEBUG: JSON Parse Error: {e}")
        return web.json_response({"error": f"Invalid JSON: {str(e)}"}, status=400)
        
    username = data.get("username", "").strip()
    if not username:
        return web.json_response({"error": "Username is required"}, status=400)

    if "locket.cam/" in username:
        username = username.split("locket.cam/")[-1].split("?")[0]
        print(f"DEBUG: Extracted username from link: {username}")

    print(f"DEBUG: Resolving username: {username}")
    uid = await locket.resolve_uid(username)
    print(f"DEBUG: Resolved UID result: {uid}")
    if not uid:
        return web.json_response({"error": "Không tìm thấy user"}, status=404)
    
    status = await locket.check_status(uid)
    is_gold = status and status.get("active")
    expires = status.get("expires") if status else None
    
    return web.json_response({
        "uid": uid,
        "username": username,
        "is_gold": is_gold,
        "expires": expires
    })

async def api_activate(request):
    try:
        body = await request.text()
        print(f"DEBUG: Received activate request body: {body}")
        if not body:
            return web.json_response({"error": "Empty body"}, status=400)
        data = await request.json()
    except Exception as e:
        print(f"DEBUG: JSON Parse Error: {e}")
        return web.json_response({"error": f"Invalid JSON: {str(e)}"}, status=400)

    uid = data.get("uid", "").strip()
    username = data.get("username", "user")
    
    if not uid:
        return web.json_response({"error": "Missing UID"}, status=400)
    
    if uid in active_requests:
        return web.json_response({"error": "Đang xử lý, vui lòng đợi..."}, status=429)
    
    active_requests.add(uid)
    
    try:
        token_config = TOKEN_SETS[0]
        logs = []
        
        def log_cb(msg):
            clean = msg.replace('\033[95m','').replace('\033[94m','').replace('\033[92m','').replace('\033[93m','').replace('\033[91m','').replace('\033[0m','').replace('\033[1m','')
            logs.append(clean)
        
        success, msg_result = await locket.inject_gold(uid, token_config, log_cb)
        
        dns_pid = None
        dns_link = None
        mobileconfig_url = None
        
        if success:
            pid, link = await nextdns.create_profile(NEXTDNS_KEY, log_cb)
            dns_pid = pid
            dns_link = link
            if pid:
                mobileconfig_url = f"/api/dns/{pid}/{username}"
        
        return web.json_response({
            "success": success,
            "message": msg_result,
            "logs": logs,
            "dns_pid": dns_pid,
            "dns_link": dns_link,
            "mobileconfig_url": mobileconfig_url
        })
    finally:
        active_requests.discard(uid)

async def api_dns_download(request):
    pid = request.match_info['pid']
    username = request.match_info.get('username', 'user')
    
    filepath = nextdns.generate_mobileconfig(pid, username)
    
    response = web.FileResponse(filepath)
    response.headers['Content-Type'] = 'application/x-apple-aspen-config'
    response.headers['Content-Disposition'] = f'attachment; filename="DNS_{username}.mobileconfig"'
    
    # Cleanup after serving
    async def cleanup():
        await asyncio.sleep(5)
        try: os.remove(filepath)
        except: pass
    asyncio.create_task(cleanup())
    
    return response

async def sepay_webhook(request):
    try:
        headers = request.headers
        payload = await request.json()
        
        if not sepay.validate_webhook(headers, payload):
            print("[WEB] Invalid SePay Webhook Signature")
            return web.Response(text="Invalid signature", status=401)
        
        memo, amount = sepay.parse_transaction(payload)
        print(f"[WEB] Received SePay Webhook: Memo={memo}, Amount={amount}")
        
        order = db.get_order_by_memo(memo)
        if not order:
            print(f"[WEB] Order not found for memo: {memo}")
            return web.Response(text="Order not found", status=200) # Still return 200 to SePay
        
        user_id, target_amount, status = order
        if status == 'COMPLETED':
            print(f"[WEB] Order {memo} already completed")
            return web.Response(text="Already processed", status=200)
        
        # Check if amount matches (or is enough)
        if amount < target_amount:
            print(f"[WEB] Amount mismatch: Expected {target_amount}, got {amount}")
            return web.Response(text="Amount mismatch", status=200)
        
        # Update DB
        db.update_order_status(memo, 'COMPLETED')
        db.set_premium(user_id, 1)
        
        # Notify user via Bot
        from app.bot import bot_app
        if bot_app:
            lang = db.get_lang(user_id) or "VI"
            asyncio.create_task(bot_app.bot.send_message(
                chat_id=user_id,
                text=T("payment_success", lang),
                parse_mode="HTML"
            ))
            
        return web.Response(text="OK", status=200)
    except Exception as e:
        print(f"[WEB] Error processing SePay webhook: {e}")
        return web.Response(text="Internal Error", status=500)

def create_web_app():
    app = web.Application()
    
    # Static files
    static_dir = os.path.join(os.path.dirname(__file__), "static")
    os.makedirs(static_dir, exist_ok=True)
    
    app.router.add_get("/", serve_index)
    app.router.add_post("/api/resolve", api_resolve)
    app.router.add_post("/api/activate", api_activate)
    app.router.add_get("/api/dns/{pid}/{username}", api_dns_download)
    app.router.add_post("/webhook/sepay", sepay_webhook)
    app.router.add_static("/static/", static_dir)
    
    return app

async def start_web_server(port=8080):
    app = create_web_app()
    runner = web.AppRunner(app)
    await runner.setup()
    site = web.TCPSite(runner, "0.0.0.0", port)
    await site.start()
    print(f"[WEB] Server running at http://0.0.0.0:{port}")
    return runner
