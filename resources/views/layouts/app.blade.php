<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            if (savedTheme === 'light') {
                document.documentElement.classList.add('light');
            }
        })();
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Locket Gold')</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .mobile-nav { display: none; }

        @media (max-width: 900px) {
            :root { --nav-bg: #0b0b0b; --page-bg: #000000; } /* Đen tuyệt đối */
            html.light { --nav-bg: #fffcfc; --page-bg: #fffcfc; } /* Trắng hồng nhạt */

            .mobile-nav {
                display: flex !important;
                position: fixed !important;
                bottom: 0 !important;
                left: 0 !important;
                right: 0 !important;
                height: 80px !important;
                background: #ffffff !important;
                border-top: 1px solid rgba(0,0,0,0.05) !important;
                border-radius: 30px 30px 0 0 !important;
                box-shadow: 0 -10px 40px rgba(0,0,0,0.06) !important;
                z-index: 10000 !important;
                padding: 0 15px 10px 15px !important;
                align-items: center !important;
                justify-content: space-around !important;
                transition: all 0.4s ease !important;
            }

            html:not(.light) .mobile-nav {
                background: #0b0b0b !important;
                border-top-color: rgba(255,255,255,0.05) !important;
                box-shadow: 0 -10px 40px rgba(0,0,0,0.4) !important;
            }

            .m-nav-item {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                text-decoration: none !important;
                color: #8e8e93 !important;
                transition: all 0.3s ease !important;
                flex: 1 !important;
                height: 100% !important;
                position: relative !important;
            }

            .m-nav-item.active {
                color: #000000 !important;
            }

            html:not(.light) .m-nav-item.active {
                color: #ffffff !important;
            }

            .m-nav-item svg {
                width: 24px !important;
                height: 24px !important;
                margin-bottom: 4px !important;
                transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            }

            .m-nav-item.active svg {
                transform: translateY(-5px) scale(1.1) !important;
                color: #e50914 !important;
            }

            .m-nav-item span {
                font-size: 10px !important;
                font-weight: 700 !important;
                transition: all 0.3s ease !important;
            }

            /* Dấu chấm báo hiệu */
            .m-nav-item .m-dot {
                width: 5px !important;
                height: 5px !important;
                background: #e50914 !important;
                border-radius: 50% !important;
                margin-top: 4px !important;
                opacity: 0 !important;
                transform: scale(0) !important;
                transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            }

            .m-nav-item.active .m-dot {
                opacity: 1 !important;
                transform: scale(1) !important;
            }

            /* NÚT TRUNG TÂM NỔI */
            .m-nav-center {
                flex: 1 !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                height: 100% !important;
            }

            .m-center-btn {
                width: 60px !important;
                height: 60px !important;
                background: #000000 !important;
                border-radius: 50% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                box-shadow: 0 10px 25px rgba(0,0,0,0.3) !important;
                border: 4px solid #ffffff !important;
                margin-top: -50px !important;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            }

            html:not(.light) .m-center-btn {
                background: #e50914 !important;
                border-color: #0b0b0b !important;
                box-shadow: 0 10px 30px rgba(229, 9, 20, 0.4) !important;
            }

            .m-center-btn svg {
                width: 28px !important;
                height: 28px !important;
                color: #ffffff !important;
            }

            .m-center-btn:active {
                transform: scale(0.9) !important;
            }

            .main { padding-bottom: 80px !important; }

            /* ── NEW MOBILE HEADER STYLES ── */
            .topnav {
                position: sticky;
                top: 0;
                height: 70px !important;
                padding: 0 16px !important;
                background: var(--page-bg) !important;
                border-bottom: none !important; /* Xóa viền cứng */
                box-shadow: 0 1px 15px rgba(229, 9, 20, 0.1) !important; /* Bóng đỏ nhòe */
                z-index: 1000;
            }
            html.light .topnav {
                box-shadow: 0 4px 12px rgba(229, 9, 20, 0.04), 0 1px 0 #ffe4e6 !important;
            }
            .hamburger, .nav-links, .user-badge, .theme-toggle { display: none !important; }
            .hamburger.show-always { display: flex !important; }

            .mobile-user-section {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .m-avatar {
                width: 44px; height: 44px;
                border-radius: 50%;
                overflow: hidden;
                border: 2px solid #fff;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }
            .m-avatar img { width: 100%; height: 100%; object-fit: cover; }

            .m-user-info { display: flex; flex-direction: column; }
            .m-greeting { 
                font-size: 13px; 
                color: #64748b; 
                font-weight: 500; 
            }
            .m-status { 
                display: flex; 
                align-items: center; 
                gap: 4px; 
                color: var(--text-primary); 
                font-weight: 700; 
                font-size: 15px; 
            }
            .m-status svg { color: #e50914; } /* Pin icon màu đỏ */

            .mobile-actions {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-left: auto;
            }
            .m-action-btn {
                position: relative;
                width: 42px; height: 42px;
                border-radius: 50%;
                background: rgba(255,255,255,0.8);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #334155;
                box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            }
            html:not(.light) .m-action-btn { background: rgba(255,255,255,0.05); color: #fff; }

            .m-badge {
                position: absolute;
                top: -2px; right: -2px;
                background: #e50914;
                color: #fff;
                font-size: 10px;
                font-weight: 800;
                padding: 2px 5px;
                border-radius: 10px;
                border: 2px solid #fff;
            }
            .mobile-user-section, .mobile-actions { display: flex !important; }
            .desktop-login-btn { display: none !important; }
        }

        /* ─── PREMIUM USER BADGE & DROPDOWN (Global) ─── */
        .user-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 16px 6px 6px;
            background: rgba(229, 9, 20, 0.05);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(229, 9, 20, 0.1);
            position: relative;
        }
        html:not(.light) .user-badge {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.1);
        }
        .user-badge:hover { transform: translateY(-2px); background: rgba(229, 9, 20, 0.1); }

        .avatar {
            width: 38px; height: 38px;
            background: #e50914;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(229, 9, 20, 0.3);
            border: 2px solid #fff;
        }

        .user-info { display: flex; flex-direction: column; line-height: 1.2; }
        .uname { font-weight: 800; font-size: 14px; color: var(--text-primary); }
        .utier { font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; }

        .user-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            width: 180px;
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 10000;
            border: 1px solid rgba(0,0,0,0.05);
            padding: 8px;
        }
        html:not(.light) .user-dropdown {
            background: #1a1a1a;
            border-color: rgba(255,255,255,0.05);
            box-shadow: 0 15px 40px rgba(0,0,0,0.5);
        }
        .user-dropdown.show { display: flex; animation: slideUpToast 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55); }

        @keyframes slideUpToast {
            from { opacity: 0; transform: translateY(15px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .dropdown-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #64748b;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            border-radius: 12px;
        }
        html:not(.light) .dropdown-item { color: #94a3b8; }
        .dropdown-item:hover { background: rgba(229, 9, 20, 0.1); color: #e50914; }


        /* HIỆU ỨNG CHUYỂN ĐỔI ICON SÁNG TỐI */
        .theme-toggle-mobile, .theme-toggle {
            position: relative;
            overflow: hidden;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        .tt-sun, .tt-moon {
            position: absolute;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            transform: rotate(-90deg) scale(0.5);
        }
        
        /* Khi ở chế độ SÁNG -> Hiện Mặt trời */
        html.light .tt-sun {
            opacity: 1;
            transform: rotate(0) scale(1);
            position: relative; /* Giữ khung cho nút bấm */
        }
        html.light .tt-moon {
            opacity: 0;
            transform: rotate(90deg) scale(0.5);
        }

        /* Khi ở chế độ TỐI -> Hiện Mặt trăng */
        html:not(.light) .tt-moon {
            opacity: 1;
            transform: rotate(0) scale(1);
            position: relative; /* Giữ khung cho nút bấm */
        }
        html:not(.light) .tt-sun {
            opacity: 0;
            transform: rotate(-90deg) scale(0.5);
        }

        /* ĐỒNG BỘ NÚT SÁNG TỐI LAPTOP & ĐIỆN THOẠI - CỰC MẠNH */
        .topnav .theme-toggle, 
        .topnav .theme-toggle-mobile {
            width: 44px !important;
            height: 44px !important;
            align-items: center !important;
            justify-content: center !important;
            background: transparent !important;
            background-color: transparent !important;
            border: none !important;
            border-radius: 12px !important;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative;
            z-index: 9999 !important; /* Đảm bảo nút luôn nổi lên trên cùng, không bị che khuất */
            padding: 0 !important;
            margin: 0 5px;
            color: #e50914 !important;
            box-shadow: none !important;
        }

        /* Xóa bỏ mọi nền mờ ảo có thể còn sót lại */
        .topnav .theme-toggle *, 
        .topnav .theme-toggle-mobile * {
            background: transparent !important;
            background-color: transparent !important;
        }

        /* HIỂN THỊ THEO THIẾT BỊ */
        @media (min-width: 901px) {
            .topnav .theme-toggle { display: flex !important; }
            .topnav .theme-toggle-mobile { display: none !important; }
        }
        @media (max-width: 900px) {
            .topnav .theme-toggle { display: none !important; }
            .topnav .theme-toggle-mobile { display: flex !important; }
        }

        /* Hiệu ứng Hover chung */
        .theme-toggle:hover, .theme-toggle-mobile:hover {
            background: rgba(229, 9, 20, 0.05) !important;
            transform: scale(1.1) rotate(5deg) !important;
        }

        /* Hiệu ứng khi nhấn (Active) */
        .theme-toggle:active, .theme-toggle-mobile:active {
            transform: scale(0.95) !important;
        }

        .theme-toggle svg, .theme-toggle-mobile svg {
            width: 24px !important;
            height: 24px !important;
            z-index: 2;
            pointer-events: none !important;
        }

        .theme-toggle:hover, .theme-toggle-mobile:hover {
            transform: scale(1.15) rotate(8deg) !important;
            color: #e50914 !important;
        }

        .mobile-user-section, .mobile-actions { display: none; }

        /* ─── iOS STYLE NOTIFICATION ─── */
        /* ─── iOS STYLE NOTIFICATION (COMPACT) ─── */
        .y-toast {
            position: fixed;
            top: 20px;
            right: -400px;
            width: 320px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            display: flex;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            z-index: 1000000;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
            padding: 12px 16px;
            align-items: flex-start;
            gap: 12px;
        }
        html:not(.light) .y-toast {
            background: #1e1e1e;
            border-color: rgba(255,255,255,0.05);
        }
        .y-toast.show { right: 20px; }
        
        .y-toast-icon {
            font-size: 20px;
            margin-top: 2px;
            flex-shrink: 0;
        }
        .y-toast-success .y-toast-icon { color: #10b981; }
        .y-toast-error .y-toast-icon { color: #f59e0b; }
        
        .y-toast-text { flex: 1; }
        .y-toast-title { font-weight: 800; font-size: 0.9rem; margin-bottom: 0px; color: var(--text-primary); }
        .y-toast-message { font-size: 0.8rem; color: #64748b; font-weight: 500; line-height: 1.4; }
        html:not(.light) .y-toast-message { color: #94a3b8; }
        
        .y-toast-close {
            color: #94a3b8;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.2s;
            margin-top: 2px;
        }
        .y-toast-close:hover { color: #e50914; }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ─── NOTIFICATION BOX (COMPACT) ─── -->
<div id="y-toast" class="y-toast {{ session('success') ? 'y-toast-success' : 'y-toast-error' }}">
    <div class="y-toast-icon">
        @if(session('success'))
            <iconify-icon icon="solar:check-circle-bold"></iconify-icon>
        @else
            <iconify-icon icon="solar:danger-triangle-bold"></iconify-icon>
        @endif
    </div>
    <div class="y-toast-text">
        <div class="y-toast-title">{{ session('success') ? 'Success' : (session('error') ? 'Error' : 'Warning') }}</div>
        <div class="y-toast-message">{{ session('success') ?? session('error') ?? $errors->first() }}</div>
    </div>
    <div class="y-toast-close" onclick="closeToast()">
        <iconify-icon icon="solar:close-circle-bold"></iconify-icon>
    </div>
</div>

<div class="app">

  <!-- ─── SIDEBAR ─── -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <div class="brand">
        <h1>Locket Gold</h1>
        <p>Premium Upgrade</p>
      </div>
      <button class="btn-icon" aria-label="Minimize">
        <svg viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="2"/></svg>
      </button>
    </div>

    <div class="search-wrap sidebar-search-desktop">
      <input type="text" placeholder="Tìm kiếm...">
      <span class="search-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      </span>
    </div>

    <!-- Main Navigation for Sidebar (Mobile only) -->
    <div class="nav-mobile-only">
      <p class="section-title">Menu Chính</p>
      <div class="sidebar-nav">
        <a href="{{ route('home') }}" class="sidebar-nav-item @if(Route::is('home')) active @endif">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Trang chủ
        </a>
        <a href="{{ route('activation') }}" class="sidebar-nav-item @if(Route::is('activation')) active @endif">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.778-7.778z"/><path d="M12 12l.93-2.015C13.447 8.837 15.057 8 16.5 8c1.5 0 3 1.5 3 3 0 1.443-.838 3.053-1.985 3.57L15.58 15.5"/><circle cx="12" cy="12" r="1"/></svg>
          Kích hoạt
        </a>
        <a href="{{ route('pricing') }}" class="sidebar-nav-item @if(Route::is('pricing')) active @endif">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          Bảng giá
        </a>
        <a href="{{ route('guide') }}" class="sidebar-nav-item @if(Route::is('guide')) active @endif">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
          Hướng dẫn
        </a>
        <a href="{{ route('support') }}" class="sidebar-nav-item @if(Route::is('support')) active @endif">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          Hỗ trợ
        </a>
        <a href="{{ route('contact') }}" class="sidebar-nav-item @if(Route::is('contact')) active @endif">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          Liên hệ
        </a>

        <!-- Login/Logout Button for Mobile Sidebar -->
        <div style="margin-top: 15px;">
            @guest
            <a href="{{ route('login') }}" class="login-toast-btn" style="width: 100%; height: 42px;">
              <div class="lt-circle">
                <svg class="lt-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                  <polyline points="10 17 15 12 10 7"></polyline>
                  <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
              </div>
              <span class="lt-text">Đăng nhập</span>
            </a>
            @else
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="login-toast-btn" style="width: 100%; height: 42px; border: none; background: rgba(229, 9, 20, 0.1); color: #e50914;">
                  <div class="lt-circle" style="background: #e50914;">
                    <svg class="lt-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                      <polyline points="16 17 21 12 16 7"></polyline>
                      <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                  </div>
                  <span class="lt-text">Đăng xuất</span>
                </button>
            </form>
            @endguest
        </div>
      </div>
    </div>

    <div class="sidebar-recent-desktop">
      <p class="section-title">Hoạt động gần đây</p>
      <div class="continue-list">
        @auth
            @if(isset($userActivities) && $userActivities->count() > 0)
                @foreach($userActivities as $activity)
                <div class="movie-item">
                  <div class="movie-thumb">
                    <img src="{{ asset('images/' . ($activity->icon ?? 'hero1.png')) }}" alt="{{ $activity->type }}">
                  </div>
                  <div class="movie-info">
                    <h4>{{ $activity->title }}</h4>
                    <p>{{ $activity->description }}</p>
                    <div class="progress-bar"><div class="progress-fill" style="width:{{ $activity->progress }}%"></div></div>
                  </div>
                </div>
                @endforeach
            @else
                <div style="padding: 15px; color: #64748b; font-size: 0.85rem; text-align: center;">
                    Chưa có hoạt động nào gần đây.
                </div>
            @endif
        @else
            <div style="padding: 15px; color: #64748b; font-size: 0.85rem; text-align: center;">
                Vui lòng đăng nhập để xem hoạt động.
            </div>
        @endauth
      </div>
    </div>

    <div class="sidebar-new-desktop">
      <p class="section-title">Gói mới nhất</p>
      <div class="new-arrival-list" style="display: flex; flex-direction: column; gap: 15px;">
        <div class="new-arrival">
          <img src="{{ asset('images/hero1.png') }}" alt="New 1">
          <div class="new-arrival-overlay"></div>
          <div class="new-arrival-info">
            <div>
              <h3>Locket Gold Vĩnh Viễn</h3>
              <p>Nâng cấp ngay để nhận ưu đãi.</p>
            </div>
            <div class="play-circle">
              <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
          </div>
        </div>
        <div class="new-arrival">
          <img src="{{ asset('images/hero2.png') }}" alt="New 2">
          <div class="new-arrival-overlay"></div>
          <div class="new-arrival-info">
            <div>
              <h3>Gói VIP Family</h3>
              <p>Chia sẻ cùng bạn bè ngay.</p>
            </div>
            <div class="play-circle">
              <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </aside>

  <!-- ─── MAIN ─── -->
  <main class="main">
    <nav class="topnav">
      <!-- Desktop Hamburger (Hidden on custom mobile header unless guest) -->
      <button class="hamburger @guest show-always @endguest" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>

      <!-- NEW MOBILE HEADER ELEMENTS -->
      @auth
      <div class="mobile-user-section" style="position: relative;">
          <div class="m-avatar" onclick="toggleUserMenuMobile()">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=e50914&color=fff" alt="User">
          </div>
          <div class="m-user-info" onclick="toggleUserMenuMobile()">
            <span class="m-greeting">Xin chào!!</span>
            <div class="m-status">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#e50914" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span>{{ Auth::user()->name }}</span>
            </div>
          </div>
          <div id="userDropdownMobile" class="user-dropdown" style="top: 100%;">
              <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">
                      <iconify-icon icon="solar:logout-bold-duotone"></iconify-icon> Đăng xuất
                  </button>
              </form>
          </div>
      </div>
      @else
      <div class="mobile-user-section" style="display: flex; align-items: center;">
         <h2 style="font-family: 'Bebas Neue', sans-serif; font-size: 1.6rem; margin: 0; color: var(--text-primary); letter-spacing: 1px; display: flex; align-items: center; gap: 8px;">
            LOCKET GOLD <span style="font-size: 0.6rem; background: #e50914; color: white; padding: 2px 6px; border-radius: 4px; vertical-align: middle;">PRO</span>
         </h2>
      </div>
      @endauth

      <div class="nav-links">
        <button class="nav-link @if(Route::is('home')) active @endif" onclick="window.location='{{ route('home') }}'">TRANG CHỦ</button>
        <button class="nav-link @if(Route::is('activation')) active @endif" onclick="window.location='{{ route('activation') }}'">KÍCH HOẠT</button>
        <button class="nav-link @if(Route::is('pricing')) active @endif" onclick="window.location='{{ route('pricing') }}'">BẢNG GIÁ</button>
        <button class="nav-link @if(Route::is('guide')) active @endif" onclick="window.location='{{ route('guide') }}'">HƯỚNG DẪN</button>
        <button class="nav-link @if(Route::is('support')) active @endif" onclick="window.location='{{ route('support') }}'">HỖ TRỢ</button>
        <button class="nav-link @if(Route::is('contact')) active @endif" onclick="window.location='{{ route('contact') }}'">LIÊN HỆ</button>
      </div>

      <div class="mobile-actions">
        <button class="m-action-btn theme-toggle-mobile" id="themeToggleMobile" aria-label="Toggle theme" onclick="toggleThemeGlobal(event)">
          <svg class="tt-sun" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="4"></circle>
            <path d="M12 2v2"></path>
            <path d="M12 20v2"></path>
            <path d="m4.93 4.93 1.41 1.41"></path>
            <path d="m17.66 17.66 1.41 1.41"></path>
            <path d="M2 12h2"></path>
            <path d="M20 12h2"></path>
            <path d="m6.34 17.66-1.41 1.41"></path>
            <path d="m19.07 4.93-1.41 1.41"></path>
          </svg>
          <svg class="tt-moon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
            <path d="M19 4.5l-0.5 0.5l0.5 0.5l0.5 -0.5z" fill="currentColor"></path>
            <path d="M16 2.5l-0.5 0.5l0.5 0.5l0.5 -0.5z" fill="currentColor"></path>
          </svg>
        </button>
        
        <button class="m-action-btn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="m-badge">6</span>
        </button>
      </div>

      <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme" onclick="toggleThemeGlobal(event)">
        <svg class="tt-sun" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="4"></circle>
          <path d="M12 2v2"></path>
          <path d="M12 20v2"></path>
          <path d="m4.93 4.93 1.41 1.41"></path>
          <path d="m17.66 17.66 1.41 1.41"></path>
          <path d="M2 12h2"></path>
          <path d="M20 12h2"></path>
          <path d="m6.34 17.66-1.41 1.41"></path>
          <path d="m19.07 4.93-1.41 1.41"></path>
        </svg>
        <svg class="tt-moon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
          <path d="M19 4.5l-0.5 0.5l0.5 0.5l0.5 -0.5z" fill="currentColor"></path>
          <path d="M16 2.5l-0.5 0.5l0.5 0.5l0.5 -0.5z" fill="currentColor"></path>
        </svg>
      </button>
      @auth
      <div style="position: relative;">
          <div class="user-badge" id="authBtnDesktop" onclick="toggleUserMenuDesktop()">
            <div class="avatar">
                @php
                    $nameParts = explode(' ', Auth::user()->name);
                    $initials = strtoupper(substr($nameParts[0], 0, 1));
                    if(count($nameParts) > 1) {
                        $initials .= strtoupper(substr(end($nameParts), 0, 1));
                    }
                @endphp
                {{ $initials }}
            </div>
            <div class="user-info">
              <div class="uname">{{ Auth::user()->name }}</div>
              <div class="utier">Member</div>
            </div>
            <span class="chevron">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
            </span>
          </div>
          <div id="userDropdownDesktop" class="user-dropdown">
              <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">
                      <iconify-icon icon="solar:logout-bold-duotone"></iconify-icon> Đăng xuất
                  </button>
              </form>
          </div>
      </div>
      @else
      <!-- Desktop Login Toast Button -->
      <a href="{{ route('login') }}" class="login-toast-btn desktop-login-btn">
          <div class="lt-circle">
            <svg class="lt-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
              <polyline points="10 17 15 12 10 7"></polyline>
              <line x1="15" y1="12" x2="3" y2="12"></line>
            </svg>
          </div>
          <span class="lt-text">Đăng nhập</span>
      </a>
      @endauth
    </nav>

    <div class="content">
        @yield('content')
    </div>
  </main>
</div>

<!-- ─── MOBILE BOTTOM NAV ─── -->
<nav class="mobile-nav">
  <a href="{{ route('home') }}" class="m-nav-item {{ Route::is('home') ? 'active' : '' }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
    <span>Home</span>
    <div class="m-dot"></div>
  </a>
  
  <a href="{{ route('activation') }}" class="m-nav-item {{ Route::is('activation') ? 'active' : '' }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.778-7.778z"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="15" x2="12" y2="21"/><line x1="9" y1="18" x2="15" y2="18"/></svg>
    <span>Activate</span>
    <div class="m-dot"></div>
  </a>

  <div class="m-nav-center">
    <div class="m-center-btn" onclick="window.location='{{ route('pricing') }}'">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.435-4.5.5-5 0 0 2 1 2 2 0 .667 1 1.5 2 3s.5 3-1 4c-1.5 1-3 1.5-4.5 1.5z"></path><path d="M15.5 14.5c.5-1.5 0-3-1-4.5-1.125-1.687-2.125-2.5-3.5-3.5-1.375 1-2.375 2.5-3.5 4.5s-1.5 3-1 4.5c.5 1.5 2 2.5 3.5 3 1.5.5 3.5.5 5 0s3-1.5 3.5-3z"></path></svg>
    </div>
  </div>

  <a href="{{ route('pricing') }}" class="m-nav-item {{ Route::is('pricing') ? 'active' : '' }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
    <span>Pricing</span>
    <div class="m-dot"></div>
  </a>

  <a href="{{ route('contact') }}" class="m-nav-item {{ Route::is('contact') ? 'active' : '' }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
    <span>Contact</span>
    <div class="m-dot"></div>
  </a>
</nav>

@stack('scripts')

<script>
    // Global Theme Toggle Function to ensure it always runs
    window.toggleThemeGlobal = function(e) {
        if (e) e.preventDefault();
        const html = document.documentElement;
        html.classList.toggle('light');
        const currentTheme = html.classList.contains('light') ? 'light' : 'dark';
        localStorage.setItem('theme', currentTheme);
    };

    (function() {
        // Notification Logic
        const toast = document.getElementById('y-toast');
        const showToast = @if(session('success') || session('error') || $errors->any()) true @else false @endif;
        
        if (showToast) {
            setTimeout(() => {
                toast.classList.add('show');
                setTimeout(() => {
                    closeToast();
                }, 4000); // Tự động đóng sau 4 giây
            }, 500);
        }

        window.closeToast = function() {
            toast.classList.remove('show');
        };

        window.toggleUserMenuDesktop = function() {
            const btn = document.getElementById('authBtnDesktop');
            const dropdown = document.getElementById('userDropdownDesktop');
            btn.classList.toggle('active');
            dropdown.classList.toggle('show');
        };

        window.toggleUserMenuMobile = function() {
            const btn = document.getElementById('authBtnMobile');
            const dropdown = document.getElementById('userDropdownMobile');
            btn.classList.toggle('active');
            dropdown.classList.toggle('show');
        };

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-badge') && !e.target.closest('.mobile-user-section')) {
                document.querySelectorAll('.user-dropdown').forEach(d => d.classList.remove('show'));
            }
        });

        // Sidebar Toggle via Avatar
        const mAvatar = document.querySelector('.m-avatar');
        if (mAvatar) {
            mAvatar.addEventListener('click', () => {
                const hamburger = document.getElementById('hamburger');
                if (hamburger) hamburger.click();
            });
        }
    })();
</script>

</body>
</html>
