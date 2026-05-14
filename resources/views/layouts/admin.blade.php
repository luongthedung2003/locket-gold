<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Horizon UI')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- ECharts -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
    
    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #F4F7FE;
        }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #A3AED0;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #707EAE;
        }

        /* ─── TOAST NOTIFICATION ─── */
        .y-toast {
            position: fixed;
            top: 20px;
            right: -400px;
            width: 320px;
            background: #ffffff;
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            z-index: 9999999;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .y-toast.show { right: 20px; }
        .y-toast-icon { width: 34px; height: 34px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; background: rgba(0,0,0,0.03); }
        .y-toast-success .y-toast-icon { color: #10b981; }
        .y-toast-error .y-toast-icon { color: #f59e0b; }
        .y-toast-text { flex: 1; }
        .y-toast-title { font-weight: 800; font-size: 0.9rem; color: #1B254B; }
        .y-toast-message { font-size: 0.8rem; color: #707EAE; font-weight: 500; line-height: 1.4; }
        .y-toast-close { cursor: pointer; color: #A3AED0; transition: color 0.2s; }
        .y-toast-close:hover { color: #e50914; }
    </style>
</head>
<body class="text-admin-body bg-[#F4F7FE] overflow-x-hidden" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen relative overflow-hidden">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden" @stack('layout_x_data')>
            <!-- Navbar -->
            @include('admin.partials.navbar')

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8 pt-2 text-[0.9rem]">
                @yield('content')
            </main>
            
            <!-- Footer -->
            @include('admin.partials.footer')
        </div>
    </div>

    <!-- ─── NOTIFICATION TOAST ─── -->
    <div id="y-toast" class="y-toast {{ session('success') ? 'y-toast-success' : 'y-toast-error' }}">
        <div class="y-toast-icon">
            @if(session('success'))
                <iconify-icon icon="ic:round-check-circle"></iconify-icon>
            @else
                <iconify-icon icon="ic:round-error"></iconify-icon>
            @endif
        </div>
        <div class="y-toast-text">
            <div class="y-toast-title">{{ session('success') ? 'Thành công' : (session('error') ? 'Lỗi' : 'Thông báo') }}</div>
            <div class="y-toast-message">{{ session('success') ?? session('error') ?? $errors->first() }}</div>
        </div>
        <div class="y-toast-close" onclick="closeToast()">
            <iconify-icon icon="ic:round-close"></iconify-icon>
        </div>
    </div>

    @stack('modals')
    @stack('scripts')
    
    <script>
        (function() {
            const toast = document.getElementById('y-toast');
            const showToast = @if(session('success') || session('error') || $errors->any()) true @else false @endif;
            
            if (showToast) {
                setTimeout(() => {
                    toast.classList.add('show');
                    setTimeout(() => { closeToast(); }, 4000);
                }, 500);
            }

            window.closeToast = function() {
                toast.classList.remove('show');
            };
        })();
    </script>
</body>
</html>
