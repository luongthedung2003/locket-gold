@extends('layouts.app')

@section('title', 'Tạo tài khoản mới - Locket Gold')

@section('content')
<div class="yetti-page-container" id="yettiPage">
    <div class="yetti-card">
        <!-- ─── LEFT: IMAGE & INTERACTIVE YETTI ─── -->
        <div class="yetti-hero">
            <div class="yetti-image-container">
                <img src="{{ asset('images/hero2.png') }}" alt="Hero" class="yetti-base-img">
                
                <!-- Overlay for Interactive Eyes -->
                <div class="yetti-interactive-layer">
                    <div class="eye left-eye"><div class="pupil"></div></div>
                    <div class="eye right-eye"><div class="pupil"></div></div>
                </div>
            </div>
            
            <div class="hero-overlay-text">
                <div class="hero-badge">JOIN THE GOLD COMMUNITY</div>
                <h1>JOIN US.<br>GROW TOGETHER.</h1>
                <p class="hero-sub">Tạo tài khoản để bắt đầu hành trình nâng cấp trải nghiệm Locket của bạn. Chỉ mất 30 giây để trở thành một phần của cộng đồng Locket Gold.</p>
                <div class="hero-features">
                    <div class="h-feat"><iconify-icon icon="solar:star-bold"></iconify-icon> Bảo mật tuyệt đối</div>
                    <div class="h-feat"><iconify-icon icon="solar:star-bold"></iconify-icon> Cập nhật tính năng mới sớm nhất</div>
                    <div class="h-feat"><iconify-icon icon="solar:star-bold"></iconify-icon> Hỗ trợ cộng đồng 24/7</div>
                </div>
            </div>
        </div>

        <!-- ─── RIGHT: REGISTER FORM ─── -->
        <div class="yetti-form-side">
            <div class="yetti-logo-area">
                <div class="logo-yetti">
                    <iconify-icon icon="noto:yeti" class="yetti-logo-icon"></iconify-icon>
                    <span>YETTI.AI</span>
                </div>
            </div>

            <div class="yetti-form-header">
                <h2>TẠO TÀI KHOẢN</h2>
                <p>Tham gia cộng đồng và bắt đầu hành trình của bạn ngay hôm nay</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="yetti-form">
                @csrf
                <div class="y-input-group">
                    <label>Họ và tên</label>
                    <input type="text" name="name" placeholder="Nhập họ và tên của bạn" value="{{ old('name') }}" required>
                </div>

                <div class="y-input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Nhập email của bạn" value="{{ old('email') }}" required>
                </div>

                <div class="y-input-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Tạo mật khẩu" required>
                </div>

                <button type="submit" class="y-btn-black">Đăng ký</button>
                
                <button type="button" class="y-btn-google" onclick="showYettiModal()">
                    <iconify-icon icon="logos:google-icon"></iconify-icon>
                    Đăng ký với Google
                </button>
            </form>

            <div class="yetti-footer">
                <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
            </div>
        </div>
    </div>

    <!-- ─── BEAUTIFUL MODAL ─── -->
    <div id="comingSoonModal" class="y-modal-overlay" style="display: none;" onclick="closeYettiModal(event)">
        <div class="y-modal-content" onclick="event.stopPropagation()">
            <div class="y-modal-decoration"></div>
            
            <div class="y-modal-icon">
                <iconify-icon icon="solar:programming-bold-duotone"></iconify-icon>
            </div>
            
            <h3 class="y-modal-title">TÍNH NĂNG ĐANG PHÁT TRIỂN</h3>
            <p class="y-modal-desc">
                Chức năng đăng ký bằng Google đang được chúng tôi xây dựng và hoàn thiện. Vui lòng quay lại sau hoặc sử dụng tài khoản email để đăng ký.
            </p>
            
            <button onclick="closeYettiModal()" class="y-modal-btn">
                Đã hiểu
            </button>
        </div>
    </div>
</div>

<style>
/* Reusing the same styles for consistency */
.yetti-page-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 100px);
    padding: 20px;
    background: #f8fafc;
}
html:not(.light) .yetti-page-container { background: #000; }

.yetti-card {
    display: flex;
    width: 100%;
    max-width: 1100px;
    height: auto;
    min-height: 650px;
    max-height: 850px;
    background: #ffffff;
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 25px 70px rgba(0,0,0,0.07);
}
html:not(.light) .yetti-card { background: #111; border: 1px solid rgba(255,255,255,0.05); }

.yetti-hero {
    flex: 1.2;
    position: relative;
    background: #e2e8f0;
    overflow: hidden;
}
html:not(.light) .yetti-hero { background: #1a1a1a; }

.yetti-image-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.yetti-base-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    opacity: 0.9;
}

.hero-overlay-text {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 40px 40px 90px 40px;
    background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 60%, transparent 100%);
    z-index: 10;
}

.hero-badge {
    display: inline-block;
    padding: 6px 14px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 99px;
    color: white;
    font-size: 0.7rem;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 15px;
}

.hero-overlay-text h1 {
    font-family: 'DM Sans', sans-serif;
    font-weight: 900;
    font-size: 2.5rem;
    color: white;
    line-height: 1.1;
    margin: 0 0 10px 0;
}

.hero-sub {
    color: rgba(255,255,255,0.8);
    font-size: 0.8rem;
    line-height: 1.5;
    margin-bottom: 20px;
    max-width: 350px;
}

.hero-features {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.h-feat {
    display: flex;
    align-items: center;
    gap: 10px;
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
}
.h-feat iconify-icon { color: #facc15; font-size: 1.1rem; }

.yetti-interactive-layer {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    pointer-events: none;
}

.eye {
    position: absolute;
    width: 44px;
    height: 44px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(0,0,0,0.05);
    box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
}

.left-eye { top: 100px; left: 60px; }
.right-eye { top: 100px; left: 115px; }

.pupil {
    width: 20px;
    height: 20px;
    background: #111;
    border-radius: 50%;
    transition: transform 0.05s ease-out;
}
.pupil::after {
    content: '';
    position: absolute;
    top: 3px; left: 3px;
    width: 6px; height: 6px;
    background: white;
    border-radius: 50%;
    opacity: 0.3;
}

.yetti-form-side {
    flex: 1;
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.yetti-logo-area {
    margin-bottom: 20px;
}

.logo-yetti {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 900;
    font-size: 1.1rem;
    letter-spacing: 1px;
}

.yetti-logo-icon { font-size: 20px; }

.yetti-form-header h2 {
    font-size: 1.7rem;
    font-weight: 900;
    margin-bottom: 5px;
    font-family: 'DM Sans', sans-serif;
}

.yetti-form-header p {
    color: #64748b;
    margin-bottom: 25px;
    font-size: 0.85rem;
}

.y-input-group {
    margin-bottom: 15px;
}

.y-input-group label {
    display: block;
    font-weight: 700;
    font-size: 0.8rem;
    margin-bottom: 6px;
}

.y-input-group input {
    width: 100%;
    padding: 12px 18px;
    background: #f1f5f9;
    border: none;
    border-radius: 12px;
    font-size: 0.9rem;
    outline: none;
    transition: all 0.2s;
}
html:not(.light) .y-input-group input { background: #1a1a1a; color: white; }

.y-btn-black {
    width: 100%;
    background: linear-gradient(to right, var(--btn-start) 0%, var(--btn-end) 100%);
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.9rem;
    cursor: pointer;
    margin-bottom: 12px;
    transition: all 0.2s;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
html:not(.light) .y-btn-black { color: #fff; }

.y-btn-black:hover { 
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

.y-btn-google {
    width: 100%;
    background: #fff;
    color: #000;
    padding: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    cursor: pointer;
    transition: all 0.2s;
}
html:not(.light) .y-btn-google { background: #111; color: #fff; border-color: #333; }

.yetti-footer {
    margin-top: 40px;
    text-align: center;
    font-size: 0.9rem;
}

.yetti-footer a {
    font-weight: 800;
    color: #000;
    text-decoration: none;
}
html:not(.light) .yetti-footer a { color: #fff; }

@media (max-width: 992px) {
    .yetti-page-container { height: auto; min-height: 100vh; padding: 0; }
    .yetti-card { flex-direction: column; border-radius: 0; height: auto; max-height: none; box-shadow: none; }
    .yetti-hero { height: 350px; flex: none; }
    .hero-overlay-text { bottom: 0; padding: 20px 20px 40px 20px; }
    .hero-overlay-text h1 { font-size: 2rem; }
    .hero-sub { display: none; }
    .yetti-form-side { padding: 30px 20px; }
    
    .left-eye { top: 40px; left: 40px; width: 30px; height: 30px; }
    .right-eye { top: 40px; left: 80px; width: 30px; height: 30px; }
    .pupil { width: 12px; height: 12px; }
}

/* MODAL CUSTOM STYLES */
.y-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    z-index: 10000;
}

.y-modal-content {
    background: white;
    width: 100%;
    max-width: 400px;
    padding: 40px;
    border-radius: 32px;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 30px 60px rgba(0,0,0,0.2);
}
html:not(.light) .y-modal-content { background: #111; color: white; border: 1px solid rgba(255,255,255,0.1); }

.y-modal-decoration {
    position: absolute;
    top: -40px; right: -40px;
    width: 120px; height: 120px;
    background: rgba(59, 130, 246, 0.15);
    border-radius: 50%;
    filter: blur(30px);
}

.y-modal-icon {
    width: 80px; height: 80px;
    background: #eff6ff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    font-size: 36px;
    color: #3b82f6;
}
html:not(.light) .y-modal-icon { background: rgba(59, 130, 246, 0.1); }

.y-modal-title {
    font-size: 1.5rem;
    font-weight: 900;
    margin-bottom: 12px;
    font-family: 'DM Sans', sans-serif;
}

.y-modal-desc {
    color: #64748b;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 32px;
}
html:not(.light) .y-modal-desc { color: #94a3b8; }

.y-modal-btn {
    width: 100%;
    padding: 16px;
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 16px;
    font-weight: 800;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
}

.y-modal-btn:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

/* TRANSITIONS */
.modal-fade-in { animation: modalFadeIn 0.3s ease-out forwards; }
.modal-fade-out { animation: modalFadeOut 0.2s ease-in forwards; }

@keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
@keyframes modalFadeOut {
    from { opacity: 1; transform: scale(1); }
    to { opacity: 0; transform: scale(0.9); }
}
</style>

<script>
window.showYettiModal = function() {
    const modal = document.getElementById('comingSoonModal');
    modal.style.display = 'flex';
    modal.classList.remove('modal-fade-out');
    modal.classList.add('modal-fade-in');
};

window.closeYettiModal = function(e) {
    if (e) e.stopPropagation();
    const modal = document.getElementById('comingSoonModal');
    modal.classList.remove('modal-fade-in');
    modal.classList.add('modal-fade-out');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 200);
};

document.addEventListener('mousemove', (e) => {
    const eyes = document.querySelectorAll('.eye');
    eyes.forEach(eye => {
        const pupil = eye.querySelector('.pupil');
        const rect = eye.getBoundingClientRect();
        const eyeX = rect.left + rect.width / 2;
        const eyeY = rect.top + rect.height / 2;
        
        const angle = Math.atan2(e.clientY - eyeY, e.clientX - eyeX);
        const distance = Math.min(
            eye.clientWidth / 4,
            Math.hypot(e.clientX - eyeX, e.clientY - eyeY) / 10
        );
        
        const x = Math.cos(angle) * distance;
        const y = Math.sin(angle) * distance;
        
        pupil.style.transform = `translate(${x}px, ${y}px)`;
    });
});
</script>
@endsection
