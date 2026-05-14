@extends('layouts.admin')

@section('title', 'Quản lý nhân viên - Locket Gold')
@section('page_title', 'Nhân viên')

@section('content')
<div class="w-full" x-data="employeeManagement()">
    <div class="w-full pt-2">
        <!-- Top Tabs (Transparent Background container) -->
        <div class="border-b border-gray-200 mb-6 overflow-x-auto" style="scrollbar-width: none; -ms-overflow-style: none;">
            <style>
                .overflow-x-auto::-webkit-scrollbar { display: none; }
            </style>
            <div class="flex space-x-6 min-w-max">
                <button class="flex items-center gap-2 py-4 border-b-2 border-[#05CD99] text-[#05CD99] font-bold text-sm px-2 transition-colors">
                    <iconify-icon icon="ic:outline-language" class="text-lg"></iconify-icon> Tất cả
                </button>
                <button class="flex items-center gap-2 py-4 border-b-2 border-transparent text-admin-body hover:text-admin-heading font-medium text-sm px-2 transition-colors">
                    <iconify-icon icon="ic:outline-domain" class="text-lg"></iconify-icon> Chính thức
                </button>
                <button class="flex items-center gap-2 py-4 border-b-2 border-transparent text-admin-body hover:text-admin-heading font-medium text-sm px-2 transition-colors">
                    <iconify-icon icon="ic:outline-contacts" class="text-lg"></iconify-icon> Cộng tác viên
                </button>
                <button class="flex items-center gap-2 py-4 border-b-2 border-transparent text-admin-body hover:text-admin-heading font-medium text-sm px-2 transition-colors">
                    <iconify-icon icon="ic:outline-tag" class="text-lg"></iconify-icon> Best Seller
                </button>
                <button class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-white text-admin-body transition-colors mt-2">
                    <iconify-icon icon="ic:round-add" class="text-xl"></iconify-icon>
                </button>
            </div>
        </div>
        <!-- Actions Row -->
        <div class="flex flex-row items-center justify-between gap-2 sm:gap-4 mb-6">
            <!-- Search -->
            <div class="relative flex-1 xl:w-80">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                    <iconify-icon icon="bx:search" class="text-xl"></iconify-icon>
                </span>
                <input type="text" class="w-full bg-white border border-gray-200 rounded-xl py-2 sm:py-2.5 pl-10 sm:pl-11 pr-4 focus:ring-2 focus:ring-[#05CD99] focus:border-transparent transition-all text-sm font-medium placeholder-gray-400" placeholder="Search...">
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                <button class="flex items-center justify-center gap-2 text-[#05CD99] font-bold text-sm px-3 sm:px-4 py-2 hover:bg-[#05CD99]/10 rounded-lg transition-colors bg-white sm:bg-transparent border border-gray-200 sm:border-none shadow-sm sm:shadow-none">
                    <iconify-icon icon="ic:outline-cloud-download" class="text-xl sm:text-lg"></iconify-icon> 
                    <span class="hidden sm:inline">Import</span>
                </button>
                
                <button class="hidden sm:flex justify-center items-center gap-2 text-[#05CD99] font-bold text-sm px-4 py-2 hover:bg-[#05CD99]/10 rounded-lg transition-colors">
                    <iconify-icon icon="ic:outline-filter-list" class="text-lg"></iconify-icon> Filter
                </button>

                <div class="w-px h-6 bg-gray-200 hidden sm:block"></div>

                <!-- Toggle List/Grid (Hidden on mobile) -->
                <div class="hidden sm:flex items-center justify-between bg-gray-100 p-1 rounded-lg">
                    <button class="flex-1 flex justify-center items-center gap-1 bg-[#05CD99] text-white px-3 py-1.5 rounded-md text-sm font-bold shadow-sm">
                        <iconify-icon icon="ic:outline-format-list-bulleted" class="text-lg"></iconify-icon> List
                    </button>
                    <button class="flex-1 flex justify-center items-center gap-1 text-gray-500 hover:text-admin-heading px-3 py-1.5 rounded-md text-sm font-medium transition-colors">
                        <iconify-icon icon="ic:outline-grid-view" class="text-lg"></iconify-icon> Grid
                    </button>
                </div>

                <!-- Sort -->
                <button class="flex items-center justify-center gap-2 bg-white border border-gray-200 text-admin-body px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm sm:shadow-none">
                    <iconify-icon icon="ic:outline-sort" class="text-xl sm:text-lg"></iconify-icon> 
                    <span class="hidden sm:inline">Sort by</span>
                    <iconify-icon icon="ic:round-expand-more" class="text-lg ml-1 hidden sm:inline"></iconify-icon>
                </button>
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden lg:block bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
            <div class="w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[1000px] text-left border-collapse">
                    <!-- Table Header -->
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-4 px-6 w-16">
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-[#05CD99] focus:ring-[#05CD99] cursor-pointer">
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-2"><iconify-icon icon="ic:outline-person-outline" class="text-lg text-admin-body"></iconify-icon> Profile</span>
                                    <iconify-icon icon="ic:round-unfold-more" class="text-admin-body"></iconify-icon>
                                </div>
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-2"><iconify-icon icon="ic:outline-contact-phone" class="text-lg text-admin-body"></iconify-icon> Contact</span>
                                    <iconify-icon icon="ic:round-unfold-more" class="text-admin-body"></iconify-icon>
                                </div>
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-2"><iconify-icon icon="ic:outline-people-alt" class="text-lg text-admin-body"></iconify-icon> Đã mời</span>
                                    <iconify-icon icon="ic:round-unfold-more" class="text-admin-body"></iconify-icon>
                                </div>
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-2"><iconify-icon icon="ic:outline-bolt" class="text-lg text-admin-body"></iconify-icon> Status</span>
                                    <iconify-icon icon="ic:round-unfold-more" class="text-admin-body"></iconify-icon>
                                </div>
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-2"><iconify-icon icon="ic:outline-tag" class="text-lg text-admin-body"></iconify-icon> Doanh thu</span>
                                    <iconify-icon icon="ic:round-unfold-more" class="text-admin-body"></iconify-icon>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        <template x-for="(employee, index) in employees" :key="employee.id">
                            <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition-colors" :class="employee.selected ? 'bg-[#F4F7FE]' : ''">
                                <!-- Checkbox -->
                                <td class="py-4 px-6">
                                    <input type="checkbox" x-model="employee.selected" class="w-5 h-5 rounded border-gray-300 text-[#05CD99] focus:ring-[#05CD99] cursor-pointer">
                                </td>
                                
                                <!-- Profile -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <img :src="employee.avatar" alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                                        <div>
                                            <h4 class="font-bold text-admin-heading text-sm" x-text="employee.name"></h4>
                                            <p class="text-xs text-admin-body mt-0.5 flex items-center gap-1">
                                                <iconify-icon icon="ic:outline-access-time"></iconify-icon> <span x-text="employee.time"></span>
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contact -->
                                <td class="py-4 px-6">
                                    <div class="space-y-1">
                                        <p class="text-sm font-medium text-admin-heading flex items-center gap-2">
                                            <iconify-icon icon="ic:outline-email" class="text-admin-body"></iconify-icon> <span x-text="employee.email"></span>
                                        </p>
                                        <p class="text-xs text-admin-body flex items-center gap-2">
                                            <iconify-icon icon="ic:outline-phone" class="text-admin-body"></iconify-icon> <span x-text="employee.phone"></span>
                                        </p>
                                    </div>
                                </td>

                                <!-- Đã mời -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                            <iconify-icon icon="ic:round-people" class="text-lg"></iconify-icon>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-admin-heading text-sm" x-text="employee.invites + ' người'"></h4>
                                            <p class="text-xs text-admin-body mt-0.5" x-text="employee.refLink"></p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-6">
                                    <div :class="employee.statusClass" class="px-3 py-1.5 rounded-full inline-flex items-center gap-1.5 text-xs font-bold w-max">
                                        <span x-text="employee.status"></span>
                                    </div>
                                </td>

                                <!-- Doanh thu -->
                                <td class="py-4 px-6">
                                    <p class="text-sm font-bold text-admin-heading" x-text="employee.revenue"></p>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden space-y-4 pb-8">
            <template x-for="employee in employees" :key="'mobile-'+employee.id">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm relative">
                    <!-- Status Badge -->
                    <div class="absolute top-5 right-5">
                        <div :class="employee.statusClass" class="px-3 py-1 rounded-full text-[10px] font-bold">
                            <span x-text="employee.status"></span>
                        </div>
                    </div>

                    <!-- Profile -->
                    <div class="flex items-center gap-4 border-b border-gray-100 pb-4 mb-4">
                        <img :src="employee.avatar" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-sm">
                        <div>
                            <h4 class="font-bold text-admin-heading text-base" x-text="employee.name"></h4>
                            <p class="text-xs text-admin-body flex items-center gap-1 mt-1">
                                <iconify-icon icon="ic:outline-access-time"></iconify-icon> <span x-text="employee.time"></span>
                            </p>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-admin-body flex items-center gap-2"><iconify-icon icon="ic:outline-email"></iconify-icon> Email</span>
                            <span class="font-medium text-admin-heading" x-text="employee.email"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-admin-body flex items-center gap-2"><iconify-icon icon="ic:outline-phone"></iconify-icon> SĐT</span>
                            <span class="font-medium text-admin-heading" x-text="employee.phone"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-admin-body flex items-center gap-2"><iconify-icon icon="ic:outline-people-alt"></iconify-icon> Đã mời</span>
                            <span class="font-bold text-[#05CD99]" x-text="employee.invites + ' người'"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm pt-2 border-t border-gray-50">
                            <span class="text-admin-heading font-bold flex items-center gap-2"><iconify-icon icon="ic:outline-account-balance-wallet"></iconify-icon> Doanh thu</span>
                            <span class="font-bold text-admin-heading text-lg" x-text="employee.revenue"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('employeeManagement', () => ({
        employees: [
            {
                id: 1,
                selected: false,
                name: 'Olivia Anderson',
                time: 'Today at 14.50PM',
                email: 'oliviaanderson12@gmail.com',
                phone: '+84 901 234 567',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar1.png') }}',
                invites: 125,
                refLink: 'locketgold.vn/ref/olivia',
                status: 'Accepted',
                statusClass: 'bg-[#E5F8ED] text-[#05CD99]',
                revenue: '23.450.000 đ'
            },
            {
                id: 2,
                selected: true,
                name: 'Benjamin Ramirez',
                time: 'Today at 11.43AM',
                email: 'b.ramirez@gmail.com',
                phone: '+84 987 654 321',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar2.png') }}',
                invites: 89,
                refLink: 'locketgold.vn/ref/ben',
                status: 'Pending',
                statusClass: 'bg-[#FFF4E5] text-[#FFB547]',
                revenue: '12.390.000 đ'
            },
            {
                id: 3,
                selected: false,
                name: 'Sophia Mitchell',
                time: 'Today at 09.10AM',
                email: 'sophiaa2904@gmail.com',
                phone: '+84 912 345 678',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar3.png') }}',
                invites: 432,
                refLink: 'locketgold.vn/ref/sophia',
                status: 'Accepted',
                statusClass: 'bg-[#E5F8ED] text-[#05CD99]',
                revenue: '127.750.000 đ'
            },
            {
                id: 4,
                selected: false,
                name: 'Liam Walker',
                time: 'Today at 08.24AM',
                email: 'liamwalkerr@gmail.com',
                phone: '+84 933 444 555',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar4.png') }}',
                invites: 156,
                refLink: 'locketgold.vn/ref/liam',
                status: 'Accepted',
                statusClass: 'bg-[#E5F8ED] text-[#05CD99]',
                revenue: '38.450.000 đ'
            },
            {
                id: 5,
                selected: false,
                name: 'Ava Bennett',
                time: 'Yesterday at 23.50PM',
                email: 'avabennett2@gmail.com',
                phone: '+84 966 777 888',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar1.png') }}',
                invites: 42,
                refLink: 'locketgold.vn/ref/ava',
                status: 'Canceled',
                statusClass: 'bg-[#FFEBEB] text-[#EE5D50]',
                revenue: '15.840.000 đ'
            }
        ]
    }))
})
</script>
@endpush
@endsection
