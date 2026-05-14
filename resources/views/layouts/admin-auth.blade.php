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
    
    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #F4F7FE;
        }
        .font-poppins { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="text-admin-body bg-white">
    <div class="flex h-screen overflow-hidden">
        <!-- Left Side: Auth Form -->
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center p-8 md:p-12 overflow-y-auto">
            @yield('content')
        </div>

        <!-- Right Side: Background Image -->
        <div class="hidden md:flex w-1/2 bg-cover bg-center rounded-bl-[100px] relative items-center justify-center" style="background-image: url('{{ asset('assets/admin/horizon/auth/auth-bg.png') }}')">
            <div class="flex flex-col items-center gap-6">
                <img src="{{ asset('assets/admin/horizon/logo-white.png') }}" alt="Logo" class="w-44 h-44">
                <img src="{{ asset('assets/admin/horizon/auth/horizon.png') }}" alt="Horizon" class="h-8">
                
                <div class="mt-12 p-6 border-2 border-white/20 rounded-3xl text-center backdrop-blur-sm bg-white/5 w-72">
                    <p class="text-white/80 text-xs mb-2">Learn more about Horizon UI on</p>
                    <a href="#" class="text-white font-bold text-xl">horizon-ui.com</a>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="absolute bottom-10 flex gap-10 text-white/80 text-sm font-medium">
                <a href="#" class="hover:text-white transition-colors">Marketplace</a>
                <a href="#" class="hover:text-white transition-colors">License</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Use</a>
                <a href="#" class="hover:text-white transition-colors">Blog</a>
            </div>
        </div>
    </div>
</body>
</html>
