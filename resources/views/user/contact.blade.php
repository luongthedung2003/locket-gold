@extends('layouts.app')

@section('title', 'Liên hệ - Locket Gold')

@section('content')
<div class="contact-page-wrapper">
    
    <!-- ─── HERO BACKGROUND & DESKTOP FORM ─── -->
    <div class="contact-hero">
        <img src="{{ asset('images/hero1.png') }}" alt="Contact Background" class="hero-bg-img">
        <div class="hero-overlay"></div>
        
        <!-- Floating Top Buttons (Mobile) -->
        <div class="floating-top-nav mobile-only">
            <button class="circle-btn" onclick="history.back()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <button class="circle-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.1a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            </button>
        </div>

        <!-- Center Play Icon (Mobile Only) -->
        <div class="center-play-btn mobile-only">
            <div class="play-inner">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M5 3l14 9-14 9V3z"></path></svg>
            </div>
        </div>

        <!-- ─── NEW: DESKTOP FORM (LEFT SIDE) ─── -->
        <div class="desktop-form-container laptop-only">
            <div class="liquid-form-glass">
                <div class="form-header">
                    <h2 class="form-title">Let's <span>talk</span></h2>
                    <p class="form-subtitle">Chúng tôi luôn sẵn sàng lắng nghe mọi góp ý và yêu cầu hỗ trợ từ bạn.</p>
                </div>

                <form action="#" method="POST" class="contact-form">
                    @csrf
                    <div class="input-group">
                        <label>Your Name</label>
                        <input type="text" placeholder="Tên của bạn..." required>
                    </div>
                    <div class="input-group">
                        <label>Your Email</label>
                        <input type="email" placeholder="example@gmail.com" required>
                    </div>
                    <div class="input-group">
                        <label>Your Message</label>
                        <textarea rows="3" placeholder="Lời nhắn..."></textarea>
                    </div>
                    <button type="submit" class="btn-send-glass">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ─── INFO SHEET (RIGHT SIDE ON LAPTOP, SLIDING ON MOBILE) ─── -->
    <div class="info-sheet glass-card">
        <div class="sheet-handle mobile-only"></div>
        
        <div class="sheet-header">
            <div class="title-group">
                <h2 class="sheet-title">Liên hệ Hỗ trợ</h2>
                <div class="location-info">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="color:var(--accent);"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"></path></svg>
                    <span>Hà Nội, Việt Nam</span>
                </div>
            </div>
            <div class="price-group">
                <span class="status-badge">ONLINE</span>
                <span class="sub-text">Hỗ trợ 24/7</span>
            </div>
        </div>

        <p class="sheet-desc">
            Chào mừng bạn đến với trung tâm hỗ trợ Locket Gold. Chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc về cài đặt, thanh toán và các tính năng Premium.
        </p>

        <!-- Team Avatars -->
        <div class="team-section">
            <div class="avatar-stack">
                <div class="stack-img" style="background-image: url('{{ asset('images/hero1.png') }}')"></div>
                <div class="stack-img" style="background-image: url('{{ asset('images/hero2.png') }}')"></div>
                <div class="stack-img" style="background-image: url('{{ asset('images/hero3.png') }}')"></div>
                <div class="stack-count">+3 Members</div>
            </div>
            <div class="rating-info">
                <span class="rating-val">4.9</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="#FFD700"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
            </div>
        </div>

        <!-- Map Preview -->
        <div class="map-preview">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.085350435134!2d105.8504!3d21.0285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjHCsDAxJzQyLjYiTiAxMDXCsDUxJzAxLjQiRQ!5e0!3m2!1svi!2svn!4v1715560000000!5m2!1svi!2svn" 
                width="100%" height="100%" style="border:0; filter: grayscale(1) invert(0.9) contrast(1.2); border-radius: 20px;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <!-- Action Button -->
        <div class="sheet-actions">
            <a href="https://zalo.me/g/your_group_id" class="btn-zalo" target="_blank">Tham gia cộng đồng Zalo</a>
        </div>
    </div>
</div>

<style>
/* Page Wrapper */
.contact-page-wrapper {
    position: relative;
    max-width: 500px;
    margin: 0 auto;
    height: 90vh;
    border-radius: 40px;
    overflow: hidden;
    background: #000;
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    margin-top: 20px;
}

/* Hero Section */
.contact-hero { position: relative; height: 60%; width: 100%; overflow: hidden; }
.hero-bg-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.1)); }

.floating-top-nav { position: absolute; top: 20px; left: 20px; right: 20px; display: flex; justify-content: space-between; z-index: 5; }
.circle-btn { width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; }

.center-play-btn { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
.play-inner { width: 60px; height: 60px; border-radius: 50%; background: rgba(255,255,255,0.2); backdrop-filter: blur(15px); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.2); }

/* Desktop Form Container */
.desktop-form-container { display: none; position: absolute; inset: 0; z-index: 10; padding: 40px; align-items: center; justify-content: center; }

.liquid-form-glass {
    background: rgba(25, 25, 25, 0.85);
    backdrop-filter: blur(25px);
    padding: 40px;
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.1);
    width: 100%;
    max-width: 400px;
    position: relative;
}

.liquid-form-glass::before {
    content: "";
    position: absolute;
    top: 30px; left: -20px; bottom: 30px; width: 40px;
    background: inherit;
    backdrop-filter: inherit;
    border-radius: 100px 0 0 100px;
    z-index: -1;
    border-left: 1px solid rgba(255,255,255,0.1);
    clip-path: polygon(0% 20%, 100% 0%, 100% 100%, 0% 80%, 0% 50%); /* Artistic edge */
}

.form-title { font-size: 2.2rem; font-weight: 800; color: #fff; margin: 0; }
.form-title span { color: #e50914; }
.form-subtitle { font-size: 0.85rem; color: rgba(255,255,255,0.6); margin-top: 10px; }

.contact-form { margin-top: 25px; display: grid; gap: 15px; }
.input-group label { display: block; font-size: 0.75rem; font-weight: 700; color: rgba(255,255,255,0.4); margin-bottom: 5px; }
.input-group input, .input-group textarea {
    width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
    padding: 12px 15px; border-radius: 12px; color: #fff; outline: none; font-size: 0.85rem;
}
.btn-send-glass {
    background: #e50914; color: #fff; border: none; padding: 14px; border-radius: 12px;
    font-weight: 700; cursor: pointer; transition: 0.3s;
}
.btn-send-glass:hover { background: #ff1f2d; transform: translateY(-2px); }

/* Info Sheet */
.info-sheet {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: rgba(25, 25, 25, 0.85); backdrop-filter: blur(25px);
    border-top-left-radius: 35px; border-top-right-radius: 35px;
    padding: 10px 25px 30px; border: 1px solid rgba(255,255,255,0.1); z-index: 10;
}
.sheet-handle { width: 40px; height: 4px; background: rgba(255,255,255,0.2); border-radius: 2px; margin: 0 auto 20px; }
.sheet-title { font-size: 1.4rem; font-weight: 700; color: #fff; margin-bottom: 4px; }
.location-info { display: flex; align-items: center; gap: 6px; font-size: 0.8rem; color: rgba(255,255,255,0.5); }
.status-badge { display: block; font-size: 1.1rem; font-weight: 800; color: #4cd964; }
.sheet-desc { font-size: 0.85rem; color: rgba(255,255,255,0.7); line-height: 1.5; margin: 15px 0; }

.team-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
.avatar-stack { display: flex; align-items: center; }
.stack-img { width: 32px; height: 32px; border-radius: 50%; border: 2px solid #222; background-size: cover; margin-right: -10px; }
.stack-count { margin-left: 20px; font-size: 0.75rem; color: rgba(255,255,255,0.5); background: rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 10px; }

.map-preview { width: 100%; height: 120px; border-radius: 20px; overflow: hidden; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.05); }
.btn-zalo { display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0068ff, #00aaff); color: white; text-decoration: none; padding: 14px; border-radius: 15px; font-weight: 700; }

.mobile-only { display: block; }
.laptop-only { display: none; }

/* ─── RESPONSIVE LAPTOP ─── */
@media (min-width: 1024px) {
    .contact-page-wrapper { max-width: 1100px; height: 750px; display: flex; border-radius: 35px; }
    .contact-hero { width: 55%; height: 100%; }
    .hero-bg-img { transform: scale(1.1); }
    .desktop-form-container { display: flex; }
    .info-sheet { position: relative; width: 45%; height: 100%; bottom: auto; border-radius: 0; padding: 50px; border: none; }
    .mobile-only { display: none; }
    .laptop-only { display: flex; }
    .sheet-title { font-size: 2.2rem; }
    .map-preview { height: 220px; }
}
</style>
@endsection
