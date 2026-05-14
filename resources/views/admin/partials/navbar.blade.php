<header class="flex items-center justify-between px-4 md:px-8 py-4 sticky top-0 z-30 bg-[#F4F7FE]/80 backdrop-blur-md w-full">
    <!-- Breadcrumbs & Title -->
    <div class="min-w-0 pr-2">
        <nav class="hidden sm:flex text-xs font-medium text-admin-body mb-1" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="#" class="hover:text-admin-heading transition-colors">Pages</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-1">/</span>
                        <a href="#" class="hover:text-admin-heading transition-colors">@yield('page_title', 'Main Dashboard')</a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex items-center gap-3 md:gap-6 flex-nowrap">
            <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-admin-heading font-poppins tracking-tight whitespace-nowrap">@yield('page_title', 'Main Dashboard')</h1>
            <div class="flex-shrink-0">
                @stack('page_actions')
            </div>
        </div>
    </div>

    <!-- Floating Actions Container -->
    <div class="bg-white rounded-full shadow-lg shadow-gray-200/50 p-1 sm:p-2 flex flex-shrink-0 items-center gap-1 sm:gap-2 md:gap-4">
        @stack('navbar_actions')
        <!-- Search -->
        <div class="relative hidden lg:block">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-admin-heading">
                <iconify-icon icon="bx:search" class="text-xl"></iconify-icon>
            </span>
            <input type="text" class="bg-[#F4F7FE] border-none rounded-full py-2 md:py-3 pl-10 md:pl-12 pr-4 w-48 md:w-64 focus:ring-2 focus:ring-admin-primary transition-all text-xs md:text-sm placeholder-admin-body" placeholder="Search...">
        </div>

        <!-- Icons -->
        <div class="flex items-center gap-0.5 sm:gap-1 md:gap-2 pr-1 md:pr-2">
            <button @click="sidebarOpen = !sidebarOpen" class="p-1.5 md:p-2 text-admin-body hover:text-admin-heading transition-colors rounded-full hover:bg-gray-50 lg:hidden">
                <iconify-icon icon="ic:baseline-menu" class="text-xl md:text-2xl"></iconify-icon>
            </button>
            <button class="p-1.5 md:p-2 text-admin-body hover:text-admin-heading transition-colors rounded-full hover:bg-gray-50">
                <iconify-icon icon="ic:baseline-notifications-none" class="text-xl md:text-2xl"></iconify-icon>
            </button>
            <button class="hidden sm:block p-1.5 md:p-2 text-admin-body hover:text-admin-heading transition-colors rounded-full hover:bg-gray-50">
                <iconify-icon icon="material-symbols:wb-sunny-outline" class="text-xl md:text-2xl"></iconify-icon>
            </button>
            <button class="hidden sm:block p-1.5 md:p-2 text-admin-body hover:text-admin-heading transition-colors rounded-full hover:bg-gray-50">
                <iconify-icon icon="ic:outline-info" class="text-xl md:text-2xl"></iconify-icon>
            </button>
            
            <!-- Profile -->
            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full overflow-hidden border-2 border-gray-100 cursor-pointer ml-1 md:ml-2">
                <img src="{{ asset('assets/admin/horizon/avatars/avatar1.png') }}" alt="User" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</header>
