@extends('layouts.app')

@section('title', 'Thanh toán - Locket Gold')

@section('content')
<div class="checkout-wrapper" x-data="checkoutHandler()">
    <div class="ticket-container horizontal">
        <!-- LEFT SIDE: QR -->
        <div class="ticket-qr-side">
            <div class="ticket-top text-center">
                <div class="confetti-icon">🎉</div>
                <h2 class="thank-you">Quét mã</h2>
                <p class="sub-text">Mở App Bank để quét</p>
            </div>
            
            <div class="qr-box-wrap">
                <div class="qr-box">
                    <img src="{{ $qrUrl }}" alt="VietQR">
                </div>
                <div class="qr-status mt-4">
                    <iconify-icon icon="ic:round-sync" class="animate-spin text-red-500 text-lg"></iconify-icon>
                    <span>Đang chờ giao dịch...</span>
                </div>
            </div>
        </div>

        <!-- VERTICAL DIVIDER -->
        <div class="ticket-vertical-divider">
            <div class="v-notch v-notch-top"></div>
            <div class="v-notch v-notch-bottom"></div>
            <div class="v-dashed-line"></div>
        </div>

        <!-- RIGHT SIDE: INFO -->
        <div class="ticket-info-side">
            <div class="ticket-info-header">
                <h3 class="font-extrabold text-xl mb-1 dark:text-white">Chi tiết đơn hàng</h3>
                <p class="text-xs text-slate-500">Vui lòng kiểm tra kỹ thông tin</p>
            </div>

            <div class="ticket-info-body">
                <div class="info-row-grid">
                    <div class="info-group">
                        <label>MÃ ĐƠN HÀNG</label>
                        <div class="val font-mono">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div class="info-group text-right">
                        <label>SỐ TIỀN</label>
                        <div class="val text-red-600 text-lg">{{ number_format($order->amount, 0, ',', '.') }}đ</div>
                    </div>
                </div>

                <div class="info-group mt-6">
                    <label>NỘI DUNG CHUYỂN KHOẢN</label>
                    <div class="memo-badge">
                        <span class="memo-text">{{ $order->payment_memo }}</span>
                        <button class="copy-btn" @click="copyMemo('{{ $order->payment_memo }}')">
                            <iconify-icon icon="ic:round-content-copy"></iconify-icon>
                        </button>
                    </div>
                </div>

                <div class="info-group mt-6">
                    <label>THỜI GIAN HẾT HẠN</label>
                    <div class="val text-sm flex items-center gap-2">
                        <iconify-icon icon="ic:round-timer" class="text-amber-500"></iconify-icon>
                        15 phút (Tự động hủy)
                    </div>
                </div>

                <div class="payment-source mt-8">
                    <div class="flex items-center gap-3">
                        <div class="bank-icon">
                            <iconify-icon icon="ic:round-security" class="text-2xl text-green-600"></iconify-icon>
                        </div>
                        <div>
                            <div class="font-bold text-[13px] text-slate-800 dark:text-white">Thanh toán bảo mật</div>
                            <div class="text-[10px] text-slate-500">Xác nhận tự động qua cổng SePay</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="ticket-scallop"></div>
    </div>
    
    <div class="text-center mt-8">
        <button class="text-slate-400 hover:text-slate-600 text-sm font-bold flex items-center gap-2 mx-auto transition-colors" onclick="window.history.back()">
            <iconify-icon icon="ic:round-arrow-back" class="text-lg"></iconify-icon>
            Hủy thanh toán và quay lại
        </button>
    </div>
</div>

<style>
.checkout-wrapper {
    background: var(--bg-deep);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}

.ticket-container.horizontal {
    background: var(--bg-card);
    width: 100%;
    max-width: 850px;
    border-radius: 32px;
    box-shadow: 0 30px 80px rgba(0,0,0,0.12);
    display: flex;
    position: relative;
    overflow: hidden;
    animation: slideUp 0.8s cubic-bezier(0.23, 1, 0.32, 1);
}

@media (max-width: 800px) {
    .checkout-wrapper { padding: 15px 10px; }
    .ticket-container.horizontal {
        flex-direction: column;
        max-width: 100%;
        border-radius: 24px;
    }
    .ticket-qr-side { 
        padding: 25px 20px 10px; 
        border-bottom: 1px dashed var(--border);
        flex: none;
        width: 100%;
    }
    .ticket-info-side { 
        padding: 10px 20px 25px; 
        flex: none;
        width: 100%;
    }
    .ticket-vertical-divider { display: none; }
    .ticket-scallop { display: none; }
    .qr-box img { width: 170px; height: 170px; }
    .main-title { font-size: 1.2rem; margin-bottom: 10px; }
    .qr-box { padding: 10px; }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

/* SIDE QR */
.ticket-qr-side {
    flex: 0 0 320px;
    padding: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: rgba(0,0,0,0.01);
}

.qr-box-wrap {
    text-align: center;
}

.qr-box {
    background: white;
    padding: 16px;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    display: inline-block;
}

.qr-box img {
    width: 200px;
    height: 200px;
    display: block;
}

/* DIVIDER */
.ticket-vertical-divider {
    position: relative;
    width: 40px;
    display: flex;
    justify-content: center;
}

.v-notch {
    position: absolute;
    width: 32px;
    height: 32px;
    background: var(--bg-deep);
    border-radius: 50%;
    left: 50%;
    transform: translateX(-50%);
}

.v-notch-top { top: -16px; }
.v-notch-bottom { bottom: -16px; }

.v-dashed-line {
    width: 0;
    height: 100%;
    border-left: 2px dashed var(--border);
}

/* SIDE INFO */
.ticket-info-side {
    flex: 1;
    padding: 50px 50px 50px 20px;
}

.info-row-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.info-group label {
    display: block;
    font-size: 10px;
    font-weight: 800;
    color: var(--text-muted);
    letter-spacing: 1px;
    margin-bottom: 6px;
}

.info-group .val {
    font-weight: 800;
    color: var(--text-primary);
}

.memo-badge {
    background: #fff5f5;
    border: 1px solid #fed7d7;
    padding: 14px 20px;
    border-radius: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 12px rgba(229,9,20,0.05);
}
html:not(.light) .memo-badge {
    background: rgba(229, 9, 20, 0.05);
    border-color: rgba(229, 9, 20, 0.1);
}

.memo-text {
    font-family: 'DM Mono', monospace;
    font-size: 1.25rem;
    font-weight: 800;
    color: #e50914;
    letter-spacing: 1px;
}

.copy-btn {
    color: #e50914;
    cursor: pointer;
    transition: all 0.2s;
    background: white;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: 1px solid #fed7d7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}
html:not(.light) .copy-btn {
    background: #1a1a1a;
    border-color: rgba(255,255,255,0.1);
}
.copy-btn:hover { transform: translateY(-2px); background: #e50914; color: white; }
.copy-btn:active { transform: scale(0.9); }

.payment-source {
    background: var(--bg-deep);
    padding: 18px 24px;
    border-radius: 20px;
    border: 1px solid var(--border);
}

.bank-icon {
    width: 48px;
    height: 48px;
    background: white;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
html:not(.light) .bank-icon { background: #1a1a1a; }

.ticket-scallop {
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 100%;
    height: 20px;
    background-image: radial-gradient(circle, var(--bg-deep) 10px, transparent 11px);
    background-size: 30px 30px;
    background-position: center;
}
</style>

<script>
function checkoutHandler() {
    return {
        orderId: {{ $order->id }},
        init() {
            setInterval(async () => {
                try {
                    const response = await fetch(`/checkout/status/${this.orderId}`);
                    const data = await response.json();
                    if (data.status === 'paid') window.location.href = '{{ route('activation') }}';
                } catch (error) {}
            }, 5000);
        },
        copyMemo(text) {
            navigator.clipboard.writeText(text);
            // Có thể dùng Toast ở đây nếu muốn
            alert('Đã sao chép nội dung: ' + text);
        }
    }
}
</script>
@endsection
