<!-- Mobile backdrop -->
<div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-[#151D48]/50 lg:hidden" @click="sidebarOpen = false" style="display: none;"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="w-72 bg-white flex-shrink-0 flex flex-col border-r border-gray-50 fixed inset-y-0 left-0 z-50 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen lg:flex">
    <!-- Logo -->
    <div class="h-24 flex items-center px-12 gap-3 sticky top-0 bg-white z-20">
        <img src="{{ asset('assets/admin/horizon/logo-main.png') }}" alt="Horizon" class="w-8 h-8">
        <span class="text-2xl font-bold font-poppins text-admin-heading tracking-tight uppercase">LOCKETGOLD</span>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto px-4 py-4 flex flex-col">
        <nav class="space-y-1 mb-6">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between group py-3 pr-4">
                <div class="flex items-center gap-4 pl-8">
                    <iconify-icon icon="ic:round-home" class="text-2xl {{ request()->routeIs('admin.dashboard') ? 'text-admin-primary' : 'text-admin-body group-hover:text-admin-heading' }}"></iconify-icon>
                    <span class="font-bold {{ request()->routeIs('admin.dashboard') ? 'text-admin-heading' : 'text-admin-body group-hover:text-admin-heading' }} transition-colors">Dashboard</span>
                </div>
                @if(request()->routeIs('admin.dashboard'))
                    <div class="w-1 h-8 bg-admin-primary rounded-l-full"></div>
                @endif
            </a>

            <!-- Orders -->
            <a href="{{ route('admin.orders') }}" class="flex items-center justify-between group py-3 pr-4">
                <div class="flex items-center gap-4 pl-8">
                    <iconify-icon icon="ic:outline-shopping-cart" class="text-2xl {{ request()->routeIs('admin.orders') ? 'text-admin-primary' : 'text-admin-body group-hover:text-admin-heading' }}"></iconify-icon>
                    <span class="font-bold {{ request()->routeIs('admin.orders') ? 'text-admin-heading' : 'text-admin-body group-hover:text-admin-heading' }} transition-colors">Đơn hàng</span>
                </div>
                @if(request()->routeIs('admin.orders'))
                    <div class="w-1 h-8 bg-admin-primary rounded-l-full"></div>
                @endif
            </a>

            <!-- Contacts -->
            <a href="{{ route('admin.contacts') }}" class="flex items-center justify-between group py-3 pr-4">
                <div class="flex items-center gap-4 pl-8">
                    <iconify-icon icon="ic:round-bar-chart" class="text-2xl {{ request()->routeIs('admin.contacts') ? 'text-admin-primary' : 'text-admin-body group-hover:text-admin-heading' }}"></iconify-icon>
                    <span class="font-bold {{ request()->routeIs('admin.contacts') ? 'text-admin-heading' : 'text-admin-body group-hover:text-admin-heading' }} transition-colors">Tin nhắn liên hệ</span>
                </div>
                @if(request()->routeIs('admin.contacts'))
                    <div class="w-1 h-8 bg-admin-primary rounded-l-full"></div>
                @endif
            </a>

            <!-- Employees -->
            <a href="{{ route('admin.employees') }}" class="flex items-center justify-between group py-3 pr-4">
                <div class="flex items-center gap-4 pl-8">
                    <iconify-icon icon="ic:round-people-outline" class="text-2xl {{ request()->routeIs('admin.employees') ? 'text-admin-primary' : 'text-admin-body group-hover:text-admin-heading' }}"></iconify-icon>
                    <span class="font-bold {{ request()->routeIs('admin.employees') ? 'text-admin-heading' : 'text-admin-body group-hover:text-admin-heading' }} transition-colors">Nhân viên</span>
                </div>
                @if(request()->routeIs('admin.employees'))
                    <div class="w-1 h-8 bg-admin-primary rounded-l-full"></div>
                @endif
            </a>

            <!-- Affiliate -->
            <a href="{{ route('admin.affiliates') }}" class="flex items-center justify-between group py-3 pr-4">
                <div class="flex items-center gap-4 pl-8">
                    <iconify-icon icon="ic:round-dashboard" class="text-2xl {{ request()->routeIs('admin.affiliates') ? 'text-admin-primary' : 'text-admin-body group-hover:text-admin-heading' }}"></iconify-icon>
                    <span class="font-bold {{ request()->routeIs('admin.affiliates') ? 'text-admin-heading' : 'text-admin-body group-hover:text-admin-heading' }} transition-colors">Affiliate</span>
                </div>
                @if(request()->routeIs('admin.affiliates'))
                    <div class="w-1 h-8 bg-admin-primary rounded-l-full"></div>
                @endif
            </a>

            <!-- Plan Management -->
            <a href="{{ route('admin.plans.index') }}" class="flex items-center justify-between group py-3 pr-4">
                <div class="flex items-center gap-4 pl-8">
                    <iconify-icon icon="ic:round-star" class="text-2xl {{ request()->routeIs('admin.plans.*') ? 'text-admin-primary' : 'text-admin-body group-hover:text-admin-heading' }}"></iconify-icon>
                    <span class="font-bold {{ request()->routeIs('admin.plans.*') ? 'text-admin-heading' : 'text-admin-body group-hover:text-admin-heading' }} transition-colors">Quản lý gói Locket</span>
                </div>
                @if(request()->routeIs('admin.plans.*'))
                    <div class="w-1 h-8 bg-admin-primary rounded-l-full"></div>
                @endif
            </a>

        </nav>

        <div class="mt-8">
            <!-- Separator / Subheader -->
            <div class="pt-4 pb-4 pl-8">
                <span class="text-[10px] font-bold text-admin-body uppercase tracking-[0.2em]">Cá nhân & Bảo mật</span>
            </div>

            <nav class="space-y-1">

            <!-- Profile -->
            <a href="{{ route('admin.profile') }}" class="flex items-center justify-between group py-3 pr-4">
                <div class="flex items-center gap-4 pl-8">
                    <iconify-icon icon="ic:baseline-person" class="text-2xl {{ request()->routeIs('admin.profile') ? 'text-admin-primary' : 'text-admin-body group-hover:text-admin-heading' }}"></iconify-icon>
                    <span class="font-bold {{ request()->routeIs('admin.profile') ? 'text-admin-heading' : 'text-admin-body group-hover:text-admin-heading' }} transition-colors">Trang cá nhân</span>
                </div>
                @if(request()->routeIs('admin.profile'))
                    <div class="w-1 h-8 bg-admin-primary rounded-l-full"></div>
                @endif
            </a>

            @guest
            <!-- Sign In -->
            <a href="{{ route('admin.login') }}" class="flex items-center justify-between group py-3 pr-4">
                <div class="flex items-center gap-4 pl-8">
                    <iconify-icon icon="ic:round-lock" class="text-2xl text-admin-body group-hover:text-admin-heading"></iconify-icon>
                    <span class="font-bold text-admin-body group-hover:text-admin-heading transition-colors">Sign In</span>
                </div>
            </a>
            @else
            <!-- Sign Out -->
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center justify-between group py-3 pr-4">
                    <div class="flex items-center gap-4 pl-8">
                        <iconify-icon icon="ic:round-logout" class="text-2xl text-admin-body group-hover:text-admin-heading"></iconify-icon>
                        <span class="font-bold text-admin-body group-hover:text-admin-heading transition-colors">Sign Out</span>
                    </div>
                </a>
            </form>
            @endguest
            </nav>
        </div>
    </div>

    <!-- Upgrade Card -->
    <div class="px-6 pb-8 mt-10">
        <div class="bg-gradient-to-br from-[#868CFF] to-admin-primary rounded-3xl p-6 relative pt-12 text-center">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-20 h-20 bg-gradient-to-br from-[#868CFF] to-admin-primary rounded-full border-4 border-[#F4F7FE] flex items-center justify-center">
                <img src="{{ asset('assets/admin/horizon/logo-white.png') }}" alt="logo" class="w-10 h-10">
            </div>
            <h4 class="text-white font-bold mb-2">Upgrade to PRO</h4>
            <p class="text-white/80 text-xs leading-relaxed">to get access to all features! Connect with Venus World!</p>
        </div>
    </div>
</aside>
