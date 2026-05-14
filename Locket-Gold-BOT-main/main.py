import asyncio
import threading
from app.bot import run_bot
from app.web import start_web_server

def run_web_in_thread():
    """Run web server in a separate thread with its own event loop"""
    loop = asyncio.new_event_loop()
    asyncio.set_event_loop(loop)
    loop.run_until_complete(start_web_server(port=8082))
    loop.run_forever()

if __name__ == "__main__":
    # Start web server in background thread
    web_thread = threading.Thread(target=run_web_in_thread, daemon=True)
    web_thread.start()
    
    # Run telegram bot in main thread
    run_bot()
