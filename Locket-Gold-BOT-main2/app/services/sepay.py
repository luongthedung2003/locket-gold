import hashlib
import json
from app.config import BANK_NAME, BANK_ACCOUNT, SEPAY_WEBHOOK_KEY

def generate_qr_url(amount, memo):
    """
    Generate VietQR image URL via SePay
    """
    # Use template=compact for better display on mobile
    return f"https://qr.sepay.vn/img?bank={BANK_NAME}&acc={BANK_ACCOUNT}&amount={amount}&memo={memo}&template=compact"

def validate_webhook(headers, payload):
    """
    Validate SePay Webhook. 
    SePay usually sends the Webhook Key in the Authorization header: 'Bearer YOUR_WEBHOOK_KEY'
    """
    auth_header = headers.get('Authorization', '')
    if not auth_header.startswith('Apikey '):
        return False
    
    received_key = auth_header.replace('Apikey ', '').strip()
    return received_key == SEPAY_WEBHOOK_KEY

def parse_transaction(payload):
    """
    Parse SePay payload to get transaction details.
    Example payload:
    {
        "id": 123,
        "content": "LOCKET12345",
        "transferAmount": 50000,
        "transferType": "in",
        ...
    }
    """
    try:
        data = payload
        if isinstance(payload, str):
            data = json.loads(payload)
            
        memo = data.get('content', '')
        amount = int(data.get('transferAmount', 0))
        return memo, amount
    except Exception:
        return None, 0
