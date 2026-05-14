@extends('layouts.app')

@section('title', 'Kích hoạt - Locket Gold')

@section('content')
<div class="activation-page-wrapper" x-data="activationHandler()">
    @auth
    <div class="activation-container">
        <!-- ─── LEFT COLUMN: PURCHASED CARD ─── -->
        <div class="activation-left">
            @if($activation)
            <div class="hierarchy-card" id="mainCard">
                <div class="h-image-header">
                    <img src="{{ asset('images/hero1.png') }}" alt="Locket Gold Premium">
                </div>
                
                <div class="h-body">
                    <div class="h-badge">GÓI BẠN ĐÃ THANH TOÁN</div>
                    <div class="h-title-row">
                        <h3 class="h-title">{{ $activation->plan->name }}</h3>
                        <div class="h-rating">
                            <svg viewBox="0 0 24 24" fill="#f59e0b" width="16" height="16"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            <span>5.0/5</span>
                        </div>
                    </div>

                    <p class="h-description">
                        {{ $activation->plan->description ?? 'Gói nâng cấp trọn đời, mở khóa toàn bộ tính năng cao cấp cho tài khoản của bạn.' }}
                    </p>

                    <div class="h-details-row">
                        <div class="h-details-left"></div>
                        <div class="h-price">
                            {{ number_format($activation->plan->price, 0, ',', '.') }}đ<span>/{{ $activation->plan->name }}</span>
                        </div>
                    </div>

                    <div x-show="status === 'completed'" class="mb-4 p-5 bg-amber-500/5 rounded-2xl border border-amber-500/20 shadow-inner">
                        <div class="flex items-center gap-2 text-amber-600 font-extrabold mb-3 text-sm">
                            <iconify-icon icon="ic:round-check-circle" class="text-2xl text-green-500"></iconify-icon>
                            <span>KÍCH HOẠT THÀNH CÔNG!</span>
                        </div>
                        <p class="text-[12px] text-slate-500 leading-relaxed mb-4">
                            Tài khoản của bạn đã được cấp quyền Gold. <b>Vui lòng cài đặt DNS</b> để duy trì trạng thái này vĩnh viễn và không bị Apple thu hồi.
                        </p>
                        
                        <div class="flex flex-col gap-2">
                            <a :href="dnsLink" target="_blank" 
                               class="flex items-center justify-center gap-2 w-full py-3 rounded-xl font-bold text-sm transition-all hover:opacity-90 active:scale-[0.98]"
                               style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);">
                               <iconify-icon icon="ic:round-install-mobile" class="text-xl"></iconify-icon>
                               CÀI ĐẶT DNS (CHO IPHONE)
                            </a>
                        </div>
                    </div>

                    <div class="h-input-wrap" x-show="status !== 'completed'">
                        <input type="text" 
                               x-model="locket_username"
                               :disabled="processing"
                               placeholder="NHẬP USERNAME LOCKET ĐỂ NÂNG CẤP" 
                               class="h-input-field"
                               @keyup.enter="startActivation({{ $activation->id }})">
                    </div>

                    <div class="h-actions" x-show="status !== 'completed'">
                        <button class="h-btn-secondary" onclick="window.location='{{ route('support') }}'">Hỗ trợ</button>
                        <button class="h-btn-primary" 
                                @click="startActivation({{ $activation->id }})"
                                :disabled="processing">
                            <span x-show="!processing">Kích hoạt ngay</span>
                            <span x-show="processing" class="flex items-center gap-2 justify-center">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Đang xử lý...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            @else
            <div class="hierarchy-card p-12 text-center flex flex-col items-center justify-center min-h-[400px]">
                <div class="w-20 h-20 bg-admin-primary/5 rounded-full flex items-center justify-center mb-6">
                    <iconify-icon icon="ic:round-shopping-cart" class="text-4xl text-admin-primary/20"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold text-admin-heading mb-2">Chưa có gói thanh toán</h3>
                <p class="text-admin-body text-sm max-w-xs mx-auto mb-8">
                    Vui lòng chọn mua một gói Locket Gold để tiến hành kích hoạt tài khoản.
                </p>
                <a href="{{ route('pricing') }}" class="h-btn-primary px-8">Xem bảng giá</a>
            </div>
            @endif
        </div>

        <!-- ─── RIGHT COLUMN: PROGRESS & CHEATSHEET ─── -->
        <div class="activation-right">
            <!-- ─── MODERN STATUS DISPLAY ─── -->
            <div class="status-display-box relative shadow-2xl" 
                 x-show="processing || status === 'completed' || status === 'failed'" 
                 style="background: #ffffff; border-radius: 32px; border: 1px solid #f1f5f9; min-height: 420px;">
                
                <div class="relative z-10 flex flex-col items-center justify-center pt-20 pb-12 px-8 text-center h-full">
                    
                    <!-- ─── LOADING STATE ─── -->
                    <div x-show="processing" class="space-y-8 animate-pulse">
                        <div class="relative w-28 h-28 mx-auto">
                            <div class="absolute inset-0 border-4 rounded-full" style="border-color: #fef3c7;"></div>
                            <div class="absolute inset-0 border-4 border-transparent rounded-full animate-spin" style="border-top-color: #f59e0b;"></div>
                            <div class="absolute inset-5 rounded-full flex items-center justify-center shadow-inner" 
                                 style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-xl font-bold tracking-tight" style="color: #1e293b;">ĐANG XỬ LÝ NÂNG CẤP</h3>
                            <p class="text-sm" style="color: #64748b;">Hệ thống đang kết nối với máy chủ Apple...</p>
                        </div>
                    </div>

                    <!-- ─── SUCCESS STATE ─── -->
                    <div x-show="status === 'completed'" class="space-y-8 animate-in fade-in zoom-in duration-500">
                        <div class="w-28 h-28 mx-auto rounded-full flex items-center justify-center animate-bounce-short"
                             style="background: #22c55e; box-shadow: 0 15px 35px rgba(34, 197, 94, 0.35);">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-3xl font-black tracking-tighter" style="color: #22c55e;">THÀNH CÔNG RỰC RỠ!</h3>
                            <p class="text-base font-medium" style="color: #475569;">
                                Tài khoản <b>{{ Auth::user()->name ?? 'Người dùng' }}</b> đã được kích hoạt VIP Gold.
                            </p>
                        </div>

                        <!-- ─── THE DNS DOWNLOAD BUTTON (FIXED) ─── -->
                        <div class="pt-4 flex flex-col items-center gap-4">
                            <a :href="dnsLink" target="_blank"
                               class="w-full max-w-[280px] py-4 rounded-2xl font-black text-sm flex items-center justify-center gap-3 transition-all hover:scale-105 active:scale-95 shadow-xl"
                               style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);">
                               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                               CÀI ĐẶT DNS LOCKET GOLD
                            </a>
                            
                            <button @click="status = 'idle'; processing = false" 
                                    class="text-[11px] font-bold uppercase tracking-widest transition-all opacity-50 hover:opacity-100"
                                    style="color: #64748b;">
                                Quay lại trang kích hoạt
                            </button>
                        </div>
                    </div>

                    <!-- ─── FAILED STATE ─── -->
                    <div x-show="status === 'failed'" class="space-y-8 animate-in fade-in zoom-in duration-500">
                        <div class="w-28 h-28 mx-auto rounded-full flex items-center justify-center"
                             style="background: #ef4444; box-shadow: 0 15px 35px rgba(239, 68, 68, 0.35);">
                            <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-2xl font-black tracking-tight" style="color: #ef4444;">KÍCH HOẠT THẤT BẠI</h3>
                            <p class="text-sm font-medium max-w-xs mx-auto" style="color: #475569;" x-text="errorMessage"></p>
                        </div>
                        <button @click="status = 'idle'; processing = false" 
                                class="px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-tighter transition-all active:scale-95 shadow-lg shadow-slate-200"
                                style="background: #1e293b; color: #ffffff;">THỬ LẠI NGAY</button>
                    </div>

                </div>
            </div>

            <!-- Standard Cheatsheet -->
            <div class="cheatsheet-board" x-show="!processing && status !== 'completed' && status !== 'failed'">
                <div class="grid-bg"></div>
                <header class="cheatsheet-header">
                    <h2 class="main-title">Quy trình <span>Kích hoạt</span></h2>
                    <div class="video-guide-btn">
                        <div class="play-icon-wrap">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <span>Xem video hướng dẫn</span>
                    </div>
                </header>

                <div class="notes-canvas compact-grid">
                    <div class="cs-note note-green step-compact">
                        <div class="cs-pin"></div>
                        <div class="cs-num">01</div>
                        <h4>Username</h4>
                        <p>Nhập tên Locket của bạn.</p>
                    </div>
                    <div class="cs-note note-pink step-compact">
                        <div class="cs-pin"></div>
                        <div class="cs-num">02</div>
                        <h4>Nâng cấp</h4>
                        <p>Nhấn nút kích hoạt ngay.</p>
                    </div>
                    <div class="cs-note note-blue step-compact">
                        <div class="cs-pin"></div>
                        <div class="cs-num">03</div>
                        <h4>Xử lý</h4>
                        <p>Hệ thống tự động bypass.</p>
                    </div>
                    <div class="cs-note note-yellow step-compact">
                        <div class="cs-pin"></div>
                        <div class="cs-num">04</div>
                        <h4>Tận hưởng</h4>
                        <p>Trải nghiệm tính năng Gold!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- ─── GUEST VIEW: CLEAN CENTERED HYBRID STYLE ─── -->
    <style>
        @media (min-width: 768px) {
            .mobile-only-banner { display: none !important; }
            .content-container { 
                max-width: 800px !important; 
                margin: 0 auto !important; 
                padding-top: 120px !important; /* Tăng khoảng cách từ đỉnh xuống */
            }
        }
        @media (max-width: 767px) {
            .mobile-only-banner { display: block !important; }
            .content-container { 
                width: 100% !important; 
                padding: 20px 40px !important; /* Ép lề hai bên cho mobile không bị sát */
            }
        }
    </style>

    <div class="guest-layout-wrapper min-h-[85vh] flex flex-col items-center justify-start py-0 animate-in fade-in duration-1000">
        
        <!-- TOP BANNER (Mobile Only) - Height and Object-Fit fixed to show full text -->
        <div class="mobile-only-banner w-full h-72 overflow-hidden shrink-0 bg-white">
            <img src="https://i.pinimg.com/originals/7c/d1/49/7cd1496160e5f11f73ca8c2f46c5bc18.gif" 
                 class="w-full h-full object-contain">
        </div>

        <!-- CENTERED CONTENT AREA - Moved up with negative margin -->
        <div class="content-container text-center">
            <div class="mb-10 inline-flex p-5 bg-amber-500 text-white rounded-[32px] shadow-2xl shadow-amber-500/40 animate-bounce-short">
                <iconify-icon icon="solar:lock-keyhole-bold-duotone" class="text-6xl"></iconify-icon>
            </div>
            
            <h2 class="text-4xl md:text-7xl font-black text-slate-900 tracking-tighter mb-8 uppercase leading-tight">
                Dừng lại <br class="hidden md:block"> <span class="text-amber-500">Một chút!</span>
            </h2>
            
            <p class="text-slate-600 text-base md:text-xl mb-12 md:mb-32 font-bold leading-relaxed">
                Bạn chưa đăng nhập để sử dụng tính năng này. <br class="hidden md:block">
                Hãy đăng nhập để mở khóa đặc quyền <span class="text-amber-500">Locket Gold</span> ngay.
            </p>
            
            <div class="guest-btn-group flex flex-row items-center justify-center gap-8 md:gap-12">
                <a href="{{ route('login') }}" class="w-full sm:w-auto min-w-[200px] md:min-w-[240px] h-12 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all hover:scale-105 active:scale-95 shadow-lg" 
                   style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff; box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);">
                    <iconify-icon icon="solar:login-bold" class="text-lg"></iconify-icon>
                    Đăng nhập
                </a>
                <a href="{{ route('register') }}" class="w-full sm:w-auto min-w-[200px] md:min-w-[240px] h-12 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all hover:scale-105 active:scale-95 shadow-lg"
                   style="background: #1e293b; color: #ffffff; box-shadow: 0 8px 20px rgba(30, 41, 59, 0.2);">
                    <iconify-icon icon="solar:user-plus-bold" class="text-lg"></iconify-icon>
                    Tạo tài khoản
                </a>
            </div>
        </div>

    </div>
    @endauth
</div>

<style>
/* Existing CSS Preserved for Auth Flow */
.activation-page-wrapper { background: var(--bg-deep); min-height: 100vh; padding: 20px 0 100px; }
.activation-container { display: flex; max-width: 1100px; margin: 0 auto; padding: 0 20px; gap: 30px; align-items: stretch; }

.activation-left { flex: 0 0 420px; }
.activation-right { flex: 1; display: flex; flex-direction: column; }

@media (max-width: 900px) {
    .activation-container { flex-direction: column; gap: 20px; }
    .activation-left { flex: none; width: 100%; }
    .activation-right { flex: none; width: 100%; }
}

.hierarchy-card { background: var(--bg-card); border-radius: 28px; overflow: hidden; box-shadow: 0 15px 45px rgba(0,0,0,0.06); border: 1px solid var(--border); height: 100%; }
.h-image-header { width: 100%; height: 180px; }
.h-image-header img { width: 100%; height: 100%; object-fit: cover; }
.h-body { padding: 25px; }
.h-title { font-size: 1.2rem; font-weight: 800; color: var(--text-primary); }
.h-badge { display: inline-block; padding: 4px 10px; background: rgba(34, 197, 94, 0.1); color: #16a34a; font-size: 0.65rem; font-weight: 800; border-radius: 8px; margin-bottom: 12px; }
.h-price { font-size: 1.4rem; font-weight: 800; color: var(--text-primary); }

.h-input-field { width: 100%; background: var(--bg-deep); border: 1px solid var(--border); padding: 14px 20px; border-radius: 16px; font-size: 0.8rem; font-weight: 700; color: var(--text-primary); outline: none; transition: all 0.3s ease; text-align: center; margin-bottom: 20px; }
.h-input-field:focus { border-color: #f59e0b; }

.h-actions { display: grid; grid-template-columns: 100px 1fr; gap: 12px; }
.h-btn-primary { background: var(--text-primary); color: var(--bg-card); border: none; padding: 14px; border-radius: 16px; font-weight: 700; font-size: 0.85rem; cursor: pointer; }
.h-btn-secondary { background: var(--bg-card); color: var(--text-secondary); border: 1px solid var(--border); padding: 14px; border-radius: 16px; font-weight: 700; font-size: 0.85rem; cursor: pointer; }

/* Cheatsheet and Status Styles */
.cheatsheet-board { position: relative; padding: 30px; background: var(--bg-card); border-radius: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); overflow: hidden; border: 1px solid var(--border); }
.grid-bg { position: absolute; inset: 0; background-image: linear-gradient(var(--border) 1px, transparent 1px), linear-gradient(90deg, var(--border) 1px, transparent 1px); background-size: 20px 20px; z-index: 0; opacity: 0.5; }
.main-title { font-size: 1.6rem; font-weight: 800; color: var(--text-primary); text-align: center; margin-bottom: 25px; }
.main-title span { color: #f59e0b; }

.notes-canvas { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
@media (max-width: 500px) { .notes-canvas { grid-template-columns: 1fr; } }
.cs-note { padding: 20px; border-radius: 4px; position: relative; box-shadow: 2px 2px 10px rgba(0,0,0,0.05); transform: rotate(-1deg); }
.cs-note:nth-child(even) { transform: rotate(1deg); }
.cs-pin { position: absolute; top: -10px; left: 50%; transform: translateX(-50%); width: 20px; height: 20px; background: rgba(0,0,0,0.1); border-radius: 50%; border: 2px solid rgba(255,255,255,0.5); }

.note-green { background: #f0fdf4; color: #166534; border-bottom: 3px solid #bcf0cc; } 
.note-pink { background: #fdf2f8; color: #9d174d; border-bottom: 3px solid #f9d1e5; } 
.note-blue { background: #eff6ff; color: #1e40af; border-bottom: 3px solid #bfdbfe; } 
.note-yellow { background: #fffbeb; color: #854d0e; border-bottom: 3px solid #fef3c7; }

.status-display-box { background: #ffffff; border-radius: 32px; border: 1px solid #f1f5f9; min-height: 380px; }
@keyframes bounce-short { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
.animate-bounce-short { animation: bounce-short 1s ease-in-out infinite; }
</style>

<script>
function activationHandler() {
    return {
        locket_username: '',
        processing: false,
        status: '{{ $activation->status ?? "idle" }}',
        dnsLink: '{{ $activation->dns_link ?? "" }}',
        errorMessage: '',
        logs: [],
        addLog(msg, type = 'info') {
            this.logs.push({ msg, type });
            if (this.logs.length > 8) this.logs.shift();
        },
        async startActivation(id) {
            if (!this.locket_username) {
                alert('Vui lòng nhập Username Locket!');
                return;
            }

            this.processing = true;
            this.logs = [];
            this.addLog('Initializing activation request...');
            this.addLog('Validating user: ' + this.locket_username);

            try {
                const response = await fetch('{{ route('activation.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        activation_id: id,
                        locket_username: this.locket_username
                    })
                });

                const data = await response.json();

                if (data.success) {
                    this.addLog('UID Resolved: SUCCESS', 'success');
                    this.addLog('RevenueCat Bypass: COMPLETED', 'success');
                    this.addLog('NextDNS Profile: CREATED', 'success');
                    this.addLog('ACTIVATION SUCCESSFUL!', 'success');
                    this.status = 'completed';
                    this.dnsLink = data.dns_link;
                } else {
                    this.errorMessage = data.message || 'Có lỗi xảy ra, vui lòng thử lại.';
                    this.status = 'failed';
                }
            } catch (error) {
                this.addLog('System Error: Connection failed', 'error');
                this.status = 'failed';
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>
@endsection
