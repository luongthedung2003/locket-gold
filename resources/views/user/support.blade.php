@extends('layouts.app')

@section('title', 'Hỗ trợ - Locket Gold')

@section('content')
<div class="support-board-wrapper">
    <div class="grid-bg"></div>

    <div class="board-container">
        <!-- ─── HEADER ─── -->
        <header class="board-header">
            <h1 class="main-title">Ultimate <span>Support</span> Cheatsheet</h1>
            <p class="sub-title">Mọi giải pháp cho <span>Trải nghiệm Gold</span> của bạn</p>
        </header>

        <div class="notes-canvas">
            <!-- Curved Paths SVG -->
            <svg class="connection-lines" viewBox="0 0 1000 800" fill="none">
                <path d="M150,150 Q300,50 500,150 T850,250 T600,500 T200,700" stroke="rgba(0,0,0,0.1)" stroke-width="2" stroke-dasharray="10,10" />
            </svg>

            <!-- Note 01: Activation -->
            <div class="s-note note-green s-1">
                <div class="s-pin"></div>
                <div class="s-logo">
                    <svg viewBox="0 0 24 24" fill="#22c55e" width="45" height="45"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                </div>
                <div class="s-num">01</div>
                <h4>Kích hoạt</h4>
                <p>Nhập mã kích hoạt vào trang chuyên biệt. Hệ thống Bot sẽ xử lý tự động trong 5-10 phút.</p>
            </div>

            <!-- Note 02: Payment -->
            <div class="s-note note-pink s-2">
                <div class="s-pin"></div>
                <div class="s-logo">
                    <svg viewBox="0 0 24 24" fill="#ec4899" width="45" height="45"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                </div>
                <div class="s-num">02</div>
                <h4>Thanh toán</h4>
                <p>Chúng tôi hỗ trợ chuyển khoản ngân hàng, Ví MoMo và thẻ cào với tỷ giá ưu đãi nhất.</p>
            </div>

            <!-- Note 03: Features -->
            <div class="s-note note-blue s-3">
                <div class="s-pin"></div>
                <div class="s-logo">
                    <svg viewBox="0 0 24 24" fill="#3b82f6" width="45" height="45"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <div class="s-num">03</div>
                <h4>Tính năng VIP</h4>
                <p>Mở khóa 100% icon Gold, không quảng cáo, upload ảnh HD và nhiều quyền lợi Premium khác.</p>
            </div>

            <!-- Note 04: Security -->
            <div class="s-note note-yellow s-4">
                <div class="s-pin"></div>
                <div class="s-logo">
                    <svg viewBox="0 0 24 24" fill="#f59e0b" width="45" height="45"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <div class="s-num">04</div>
                <h4>Bảo mật</h4>
                <p>Thông tin của bạn được mã hóa SSL 256-bit. Chúng tôi không lưu trữ mật khẩu cá nhân của khách hàng.</p>
            </div>

            <!-- Note 05: Contact -->
            <div class="s-note note-purple s-5">
                <div class="s-pin"></div>
                <div class="s-logo">
                    <svg viewBox="0 0 24 24" fill="#a855f7" width="45" height="45"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.1a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                </div>
                <div class="s-num">05</div>
                <h4>Liên hệ</h4>
                <p>Hỗ trợ trực tiếp qua Telegram @LocketGold_Support hoặc Fanpage chính thức 24/7.</p>
            </div>

            <!-- Note 06: Community -->
            <div class="s-note note-cyan s-6">
                <div class="s-pin"></div>
                <div class="s-logo">
                    <svg viewBox="0 0 24 24" fill="#06b6d4" width="45" height="45"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="s-num">06</div>
                <h4>Cộng đồng</h4>
                <p>Tham gia Group VIP để nhận thông báo về các tính năng mới và quà tặng hàng tuần.</p>
            </div>
        </div>
    </div>
</div>

<style>
/* BASE WRAPPER */
.support-board-wrapper {
    position: relative;
    min-height: 100vh;
    background: #fdfdfd;
    overflow: hidden;
    padding-bottom: 100px;
}
html:not(.light) .support-board-wrapper { background: #000; }

.grid-bg {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px);
    background-size: 30px 30px;
    z-index: 0;
}
html:not(.light) .grid-bg {
    background-image: 
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
}

.board-container { position: relative; z-index: 1; max-width: 1200px; margin: 0 auto; padding: 60px 20px; }

/* HEADER */
.board-header { text-align: center; margin-bottom: 80px; }
.main-title { font-family: 'DM Sans', sans-serif; font-size: 3.5rem; font-weight: 800; color: #1e293b; margin: 0; }
.main-title span { color: #e50914; }
.sub-title { font-size: 1.2rem; color: #64748b; margin-top: 15px; }
.sub-title span { font-weight: 700; color: #9333ea; }
html:not(.light) .main-title { color: #fff; }

/* CANVAS */
.notes-canvas { position: relative; min-height: 900px; }

.connection-lines {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}
html:not(.light) .connection-lines path { stroke: rgba(255,255,255,0.05); }

/* NOTE STYLES */
.s-note {
    position: absolute;
    width: 260px;
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 15px 45px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.s-note:hover { transform: scale(1.08) rotate(2deg) !important; z-index: 100; }

.s-num { font-family: 'Bebas Neue', cursive; font-size: 2.8rem; line-height: 1; margin-bottom: 10px; }
.s-note h4 { margin: 10px 0 8px 0; font-size: 1.1rem; font-weight: 800; color: #1e293b; }
.s-note p { font-size: 0.85rem; line-height: 1.6; color: #64748b; margin: 0; }
.s-logo { position: absolute; top: 25px; right: 25px; opacity: 0.1; }

/* 3D PIN */
.s-pin {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 28px;
    height: 28px;
    border-radius: 50%;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    z-index: 5;
}
.s-pin::after {
    content: "";
    position: absolute;
    top: 6px; left: 6px; width: 10px; height: 10px;
    background: rgba(255,255,255,0.4); border-radius: 50%;
}

/* ARTISTIC POSITIONS */
.s-1 { top: 0; left: 5%; transform: rotate(-5deg); }
.s-2 { top: 60px; left: 38%; transform: rotate(4deg); }
.s-3 { top: 20px; right: 5%; transform: rotate(-3deg); }
.s-4 { top: 380px; left: 8%; transform: rotate(3deg); }
.s-5 { top: 450px; left: 42%; transform: rotate(-4deg); }
.s-6 { top: 400px; right: 10%; transform: rotate(6deg); }

@media (max-width: 1000px) {
    .main-title { font-size: 2.5rem; }
    .notes-canvas { display: flex; flex-direction: column; align-items: center; gap: 50px; min-height: auto; }
    .s-note { position: static !important; width: 100%; max-width: 350px; transform: none !important; }
    .connection-lines { display: none; }
}

/* NOTE COLORS */
.note-green { background: #f0fdf4; border-bottom: 5px solid #bbf7d0; } .note-green .s-num { color: #22c55e; } .note-green .s-pin { background: #22c55e; }
.note-pink { background: #fdf2f8; border-bottom: 5px solid #fbcfe8; } .note-pink .s-num { color: #ec4899; } .note-pink .s-pin { background: #ec4899; }
.note-blue { background: #eff6ff; border-bottom: 5px solid #bfdbfe; } .note-blue .s-num { color: #3b82f6; } .note-blue .s-pin { background: #3b82f6; }
.note-yellow { background: #fffbeb; border-bottom: 5px solid #fef3c7; } .note-yellow .s-num { color: #f59e0b; } .note-yellow .s-pin { background: #f59e0b; }
.note-purple { background: #faf5ff; border-bottom: 5px solid #e9d5ff; } .note-purple .s-num { color: #a855f7; } .note-purple .s-pin { background: #a855f7; }
.note-cyan { background: #ecfeff; border-bottom: 5px solid #cffafe; } .note-cyan .s-num { color: #06b6d4; } .note-cyan .s-pin { background: #06b6d4; }

/* DARK MODE ADJUSTMENTS */
html:not(.light) .s-note { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-bottom: none; backdrop-filter: blur(10px); }
html:not(.light) .s-note h4 { color: #fff; }
html:not(.light) .s-note p { color: #94a3b8; }
html:not(.light) .s-logo { opacity: 0.3; }
</style>
@endsection
