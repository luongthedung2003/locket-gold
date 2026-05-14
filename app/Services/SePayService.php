<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SePayService
{
    protected $bankName;
    protected $bankAccount;
    protected $webhookKey;

    public function __construct()
    {
        $this->bankName = env('SEPAY_BANK_NAME', 'MBBank');
        $this->bankAccount = env('SEPAY_BANK_ACCOUNT', '0123456789');
        $this->webhookKey = env('SEPAY_WEBHOOK_KEY', 'sepay_secret_key_123456');
    }

    /**
     * Generate VietQR image URL via SePay
     */
    public function generateQrUrl($amount, $memo)
    {
        $amount = (int) $amount;
        $memo = urlencode($memo);
        // Using VietQR.io for better compatibility with bank apps pre-filling memo
        return "https://img.vietqr.io/image/{$this->bankName}-{$this->bankAccount}-compact2.png?amount={$amount}&addInfo={$memo}";
    }

    /**
     * Validate SePay Webhook
     */
    public function validateWebhook($authHeader)
    {
        if (empty($authHeader)) {
            Log::warning('SePay Webhook: Missing Authorization Header');
            return false;
        }
        
        // Strip everything before the actual key (Bearer, Apikey, etc.)
        $receivedKey = trim(preg_replace('/^(Bearer|Apikey|ApiKey|apikey)\s+/i', '', $authHeader));
        $expectedKey = trim($this->webhookKey);

        if ($receivedKey !== $expectedKey) {
            Log::warning('SePay Webhook: Key Mismatch', [
                'received' => $receivedKey,
                'expected' => $expectedKey
            ]);
            return false;
        }

        return true;
    }

    /**
     * Parse SePay payload to get transaction details
     */
    public function parseTransaction($payload)
    {
        $memo = $payload['content'] ?? '';
        $amount = $payload['transferAmount'] ?? 0;
        
        return [
            'memo' => $memo,
            'amount' => $amount
        ];
    }
}
