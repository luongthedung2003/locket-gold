@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng - Locket Gold')
@section('page_title', 'Quản lý đơn hàng')

@section('content')
<div class="w-full" x-data="orderManagement()">
    <!-- Header Controls -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
        <div class="flex items-center gap-2 md:gap-4 w-full md:w-auto overflow-x-auto pb-2 md:pb-0" style="scrollbar-width: none; -ms-overflow-style: none;">
            <style>.overflow-x-auto::-webkit-scrollbar { display: none; }</style>
            <!-- Search -->
            <div class="relative flex-shrink-0">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-admin-body">
                    <iconify-icon icon="bx:search" class="text-lg"></iconify-icon>
                </span>
                <input type="text" class="bg-white border-none rounded-full py-2.5 pl-10 pr-4 w-48 md:w-64 focus:ring-2 focus:ring-admin-primary transition-all text-sm font-medium placeholder-gray-400 shadow-sm" placeholder="Search orders...">
            </div>

            <!-- Filter -->
            <button class="bg-white rounded-full px-4 py-2.5 flex items-center gap-2 text-sm font-bold text-admin-heading shadow-sm flex-shrink-0 hover:bg-gray-50 transition-colors">
                Gói Locket <iconify-icon icon="ic:round-tune" class="text-admin-body"></iconify-icon>
            </button>

            <!-- Date Range Picker -->
            <div x-data="dateRangePicker()" class="relative flex items-center bg-white rounded-full shadow-sm flex-shrink-0 border border-transparent hover:border-gray-200 transition-colors">
                <button @click="prevRange()" class="p-2.5 px-3 text-admin-body hover:bg-gray-50 rounded-l-full transition-colors border-r border-gray-100">
                    <iconify-icon icon="ic:round-chevron-left" class="text-xl"></iconify-icon>
                </button>
                
                <div class="relative flex-1">
                    <input x-ref="pickerInput" type="text" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" placeholder="Chọn ngày">
                    <div class="px-2 py-2.5 flex items-center justify-center gap-2 text-sm font-bold text-admin-heading transition-colors min-w-[180px]">
                        <span x-text="displayDate">Jan 8 - Feb 21 (2026)</span>
                        <iconify-icon icon="ic:round-calendar-today" class="text-admin-body"></iconify-icon>
                    </div>
                </div>

                <button @click="nextRange()" class="p-2.5 px-3 text-admin-body hover:bg-gray-50 rounded-r-full transition-colors border-l border-gray-100">
                    <iconify-icon icon="ic:round-chevron-right" class="text-xl"></iconify-icon>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button class="bg-[#1B2559] hover:bg-opacity-90 text-white rounded-full px-6 py-2.5 flex items-center gap-2 text-sm font-bold transition-colors shadow-lg shadow-[#1B2559]/20 flex-shrink-0 w-full md:w-auto justify-center">
            <iconify-icon icon="ic:round-check-circle" class="text-lg"></iconify-icon> Xử lý tất cả
        </button>
    </div>

    <!-- Table Headers (Desktop Only) -->
    <div class="hidden lg:grid grid-cols-12 gap-4 px-8 mb-2 text-xs font-bold text-admin-body tracking-wider uppercase">
        <div class="col-span-3">KHÁCH HÀNG</div>
        <div class="col-span-6">THÔNG TIN ĐƠN HÀNG</div>
        <div class="col-span-1 text-center">TỔNG TIỀN</div>
        <div class="col-span-2 text-center">TRẠNG THÁI</div>
    </div>

    <!-- Orders List -->
    <div class="space-y-4">
        <template x-for="order in orders" :key="order.id">
            <div @click="openModal(order)" class="bg-white rounded-3xl lg:rounded-[2rem] p-4 lg:p-5 flex flex-col lg:grid lg:grid-cols-12 gap-4 items-center shadow-sm hover:shadow-md transition-shadow cursor-pointer border border-transparent hover:border-admin-primary/20">
                
                <!-- Customer (Mobile & Desktop) -->
                <div class="col-span-3 flex items-center justify-between lg:justify-start w-full lg:w-auto">
                    <div class="flex items-center gap-3 lg:gap-4">
                        <img :src="order.avatar" alt="Avatar" class="w-10 h-10 lg:w-12 lg:h-12 rounded-full object-cover shadow-sm">
                        <div>
                            <h4 class="font-bold text-admin-heading text-sm lg:text-base" x-text="order.name"></h4>
                            <p class="text-xs text-admin-body font-medium mt-0.5 truncate max-w-[150px] lg:max-w-none" x-text="order.email"></p>
                        </div>
                    </div>
                    
                    <!-- Status on Mobile -->
                    <div class="lg:hidden flex flex-col items-end gap-1">
                        <div :class="order.statusClass" class="px-3 py-1 rounded-full flex items-center gap-1.5">
                            <div class="w-1.5 h-1.5 rounded-full" :class="order.statusDot"></div>
                            <span class="text-xs font-bold" x-text="order.status"></span>
                        </div>
                        <p class="text-sm font-bold text-admin-heading mt-1" x-text="order.amount + ' VNĐ'"></p>
                    </div>
                </div>

                <!-- Details (Desktop Only) -->
                <div class="hidden lg:flex col-span-6 justify-between px-4">
                    <div class="text-center">
                        <p class="text-xs text-admin-body font-medium mb-1">Gói</p>
                        <p class="text-sm font-bold text-admin-heading" x-text="order.package"></p>
                        <p class="text-[10px] text-admin-body font-medium mt-1" x-text="order.packageSub"></p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-admin-body font-medium mb-1">Mã đơn</p>
                        <p class="text-sm font-bold text-admin-heading" x-text="order.code"></p>
                        <p class="text-[10px] text-admin-body font-medium mt-1" x-text="order.method"></p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-admin-body font-medium mb-1">Ngày mua</p>
                        <p class="text-sm font-bold text-admin-heading" x-text="order.date"></p>
                        <p class="text-[10px] text-admin-body font-medium mt-1" x-text="order.dateSub"></p>
                    </div>
                    <div class="text-center opacity-40">
                        <p class="text-xs text-admin-body font-medium mb-1">Gia hạn</p>
                        <p class="text-sm font-bold text-admin-heading" x-text="order.expire"></p>
                        <p class="text-[10px] text-admin-body font-medium mt-1" x-text="order.expireSub"></p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-admin-body font-medium mb-1">Thiết bị</p>
                        <p class="text-sm font-bold text-admin-heading" x-text="order.device"></p>
                        <p class="text-[10px] text-admin-body font-medium mt-1" x-text="order.deviceSub"></p>
                    </div>
                </div>

                <!-- Amount (Desktop Only) -->
                <div class="hidden lg:block col-span-1 text-center">
                    <p class="text-lg font-bold text-admin-heading" x-text="order.amount"></p>
                    <p class="text-[10px] text-admin-body font-medium">VNĐ</p>
                </div>

                <!-- Status (Desktop Only) -->
                <div class="hidden lg:flex col-span-2 justify-center">
                    <div :class="order.statusClass" class="px-4 py-1.5 rounded-full flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full" :class="order.statusDot"></div>
                        <span class="text-sm font-bold" x-text="order.status"></span>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Order Detail Modal / Slide-over -->
    <div x-show="modalOpen" class="fixed inset-0 z-[100] flex items-center justify-center lg:justify-end p-4 sm:p-6 lg:p-0" style="display: none;">
        <!-- Backdrop -->
        <div x-show="modalOpen" x-transition.opacity class="absolute inset-0 bg-[#151D48]/60 backdrop-blur-sm" @click="closeModal()"></div>
        
        <!-- Modal Content / Panel -->
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95 lg:opacity-100 lg:translate-y-0 lg:translate-x-full lg:scale-100"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100 lg:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100 lg:translate-x-0"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95 lg:opacity-100 lg:translate-y-0 lg:translate-x-full lg:scale-100"
             class="relative w-full max-w-lg lg:max-w-md xl:max-w-lg bg-white rounded-[2rem] lg:rounded-none lg:rounded-l-[2rem] shadow-2xl overflow-hidden flex flex-col max-h-[85vh] lg:max-h-full lg:h-full">
            
            <!-- Modal Header -->
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white z-10">
                <h3 class="text-xl font-bold text-[#1F2937]">Tiến trình đơn hàng</h3>
                <div class="flex items-center gap-3">
                    <div class="bg-[#E5F8ED] text-[#05CD99] px-3 py-1 rounded-full text-[10px] font-bold flex items-center gap-1.5 tracking-wider uppercase">
                        <div class="w-1.5 h-1.5 rounded-full bg-[#05CD99]"></div>
                        IN TRANSIT
                    </div>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6 lg:p-8 overflow-y-auto flex-1 bg-white custom-scrollbar" x-if="selectedOrder">
                
                <!-- Timeline -->
                <div class="relative space-y-8 mb-10">
                    <!-- Vertical Line -->
                    <div class="absolute left-[15px] top-4 bottom-8 w-[2px] bg-gradient-to-b from-[#05CD99] via-[#05CD99] to-gray-200"></div>

                    <!-- Step 1 -->
                    <div class="relative flex items-start justify-between gap-4">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-8 h-8 rounded-full bg-[#05CD99] flex items-center justify-center text-white z-10 ring-4 ring-white shadow-sm flex-shrink-0">
                                <iconify-icon icon="ic:round-check" class="text-lg"></iconify-icon>
                            </div>
                            <div class="pt-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-bold text-[#1F2937] text-base leading-none">Đã xác nhận đơn</h4>
                                    <span class="bg-[#E5F8ED] text-[#05CD99] px-2 py-0.5 rounded-md text-[10px] font-bold flex items-center gap-1 leading-none">
                                        <iconify-icon icon="ic:round-check"></iconify-icon> DONE
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 font-medium mt-2">Đã nhận thanh toán — mã đơn <span x-text="selectedOrder?.code"></span></p>
                            </div>
                        </div>
                        <div class="text-[11px] font-medium text-gray-400 text-right whitespace-nowrap mt-1 flex-shrink-0 tracking-wide" x-text="selectedOrder?.date + ', ' + selectedOrder?.dateSub"></div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative flex items-start justify-between gap-4">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-8 h-8 rounded-full bg-[#05CD99] flex items-center justify-center text-white z-10 ring-4 ring-white shadow-sm flex-shrink-0">
                                <iconify-icon icon="ic:round-check" class="text-lg"></iconify-icon>
                            </div>
                            <div class="pt-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-bold text-[#1F2937] text-base leading-none">Bắt đầu xử lý</h4>
                                    <span class="bg-[#E5F8ED] text-[#05CD99] px-2 py-0.5 rounded-md text-[10px] font-bold flex items-center gap-1 leading-none">
                                        <iconify-icon icon="ic:round-check"></iconify-icon> DONE
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 font-medium mt-2">Kiểm tra tài khoản Locket — chuẩn bị nâng cấp</p>
                            </div>
                        </div>
                        <div class="text-[11px] font-medium text-gray-400 text-right whitespace-nowrap mt-1 flex-shrink-0 tracking-wide">14/05/2026, 15:30</div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative flex items-start justify-between gap-4">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-8 h-8 rounded-full bg-white border-[3px] border-[#05CD99] flex items-center justify-center z-10 ring-4 ring-white shadow-sm flex-shrink-0 relative">
                                <!-- Active Indicator (spinner or partial fill) -->
                                <svg class="absolute inset-0 w-full h-full text-[#05CD99] animate-spin-slow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="animation-duration: 3s;"><path d="M21 12a9 9 0 1 1-6.219-8.56"></path></svg>
                            </div>
                            <div class="pt-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-bold text-[#1F2937] text-base leading-none">Đang nâng cấp</h4>
                                    <span class="bg-[#E5F8ED] text-[#05CD99] px-2 py-0.5 rounded-md text-[10px] font-bold flex items-center gap-1.5 leading-none tracking-wider">
                                        <div class="w-1.5 h-1.5 bg-[#05CD99] rounded-full"></div> ACTIVE
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 font-medium mt-2">Đang kết nối Server — chờ phản hồi từ Locket</p>
                            </div>
                        </div>
                        <div class="text-[11px] font-medium text-gray-400 text-right whitespace-nowrap mt-1 flex-shrink-0 tracking-wide">15/05/2026, 09:15</div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative flex items-start justify-between gap-4">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-8 h-8 rounded-full bg-white border-2 border-gray-200 text-gray-400 font-bold text-sm flex items-center justify-center z-10 ring-4 ring-white shadow-sm flex-shrink-0">
                                4
                            </div>
                            <div class="pt-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-bold text-gray-400 text-base leading-none">Hoàn tất</h4>
                                    <span class="bg-gray-100 text-gray-400 px-2 py-0.5 rounded-md text-[10px] font-bold flex items-center gap-1 leading-none tracking-wider">
                                        PENDING
                                    </span>
                                </div>
                                <p class="text-sm text-gray-400 font-medium mt-2">Tài khoản Locket Gold sẽ được kích hoạt</p>
                            </div>
                        </div>
                        <div class="text-[11px] font-medium text-gray-400 text-right whitespace-nowrap mt-1 flex-shrink-0 tracking-wide">—</div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="w-full h-px bg-gray-100 mb-6"></div>

                <!-- OVERVIEW section -->
                <div>
                    <h5 class="text-[10px] font-bold text-gray-400 tracking-[0.15em] uppercase mb-4">OVERVIEW</h5>
                    <div class="grid grid-cols-3 gap-2 sm:gap-3 mb-6">
                        <!-- Box 1 -->
                        <div class="bg-[#E5F8ED] rounded-xl p-3 sm:p-4 flex flex-col items-center justify-center text-center">
                            <span class="text-xl sm:text-2xl font-bold text-[#05CD99] mb-1">2</span>
                            <span class="text-[9px] sm:text-[10px] font-bold text-[#05CD99] tracking-wider uppercase">COMPLETED</span>
                        </div>
                        <!-- Box 2 -->
                        <div class="bg-[#F0FDF4] rounded-xl p-3 sm:p-4 flex flex-col items-center justify-center text-center border border-[#E5F8ED]">
                            <span class="text-xl sm:text-2xl font-bold text-[#05CD99] mb-1">1</span>
                            <span class="text-[9px] sm:text-[10px] font-bold text-[#05CD99] tracking-wider uppercase">IN PROGRESS</span>
                        </div>
                        <!-- Box 3 -->
                        <div class="bg-gray-100 rounded-xl p-3 sm:p-4 flex flex-col items-center justify-center text-center">
                            <span class="text-xl sm:text-2xl font-bold text-gray-400 mb-1">1</span>
                            <span class="text-[9px] sm:text-[10px] font-bold text-gray-400 tracking-wider uppercase">REMAINING</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mb-3 overflow-hidden flex">
                        <div class="bg-[#05CD99] h-full rounded-full" style="width: 63%"></div>
                    </div>
                    <div class="flex justify-between items-center text-[10px] font-bold text-gray-400 tracking-wider">
                        <span>EST. DONE: 15/05/2026</span>
                        <span>63% COMPLETE</span>
                    </div>
                </div>

            </div>

            <!-- Modal Footer (Optional, hiding the old buttons for cleaner design) -->
            <div class="p-4 bg-white border-t border-gray-50 flex justify-end">
                <button @click="closeModal()" class="px-6 py-2.5 rounded-full text-gray-500 font-bold text-sm hover:bg-gray-50 transition-colors border border-gray-200">
                    Đóng
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('dateRangePicker', () => ({
        displayDate: 'Jan 8 - Feb 21 (2026)',
        picker: null,
        init() {
            this.picker = flatpickr(this.$refs.pickerInput, {
                mode: 'range',
                dateFormat: 'M j',
                locale: 'vn',
                defaultDate: [new Date(2026, 0, 8), new Date(2026, 1, 21)],
                onChange: (selectedDates, dateStr, instance) => {
                    if (selectedDates.length === 2) {
                        const start = instance.formatDate(selectedDates[0], 'M j');
                        const end = instance.formatDate(selectedDates[1], 'M j');
                        const year = selectedDates[1].getFullYear();
                        this.displayDate = `${start} - ${end} (${year})`;
                    }
                }
            });
        },
        prevRange() {
            // Logic to step back in time
        },
        nextRange() {
            // Logic to step forward in time
        }
    }));

    Alpine.data('orderManagement', () => ({
        modalOpen: false,
        selectedOrder: null,
        orders: [
            {
                id: 1,
                name: 'Nguyễn Văn A',
                email: 'nguyenvana@gmail.com',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar1.png') }}',
                package: '1 Năm',
                packageSub: 'Locket Gold',
                code: '#LK-9012',
                method: 'Momo',
                date: '08:00',
                dateSub: '14/05/2026',
                expire: '--:--',
                expireSub: '--/--/----',
                device: 'iPhone 15',
                deviceSub: 'iOS 17.4',
                amount: '399K',
                status: 'Đã nâng cấp',
                statusClass: 'bg-[#E5F8ED] text-[#05CD99]',
                statusDot: 'bg-[#05CD99]'
            },
            {
                id: 2,
                name: 'Trần Thị B',
                email: 'tranthib@gmail.com',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar2.png') }}',
                package: '1 Tháng',
                packageSub: 'Locket Gold',
                code: '#LK-9013',
                method: 'CK Ngân hàng',
                date: '09:10',
                dateSub: '14/05/2026',
                expire: '--:--',
                expireSub: '--/--/----',
                device: 'Galaxy S24',
                deviceSub: 'Android 14',
                amount: '49K',
                status: 'Lỗi tài khoản',
                statusClass: 'bg-[#FFF4E5] text-[#FFB547]',
                statusDot: 'bg-[#FFB547]'
            },
            {
                id: 3,
                name: 'Lê Văn C',
                email: 'levanc_pro@gmail.com',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar3.png') }}',
                package: 'Vĩnh viễn',
                packageSub: 'Locket Gold',
                code: '#LK-9014',
                method: 'Apple Pay',
                date: '10:05',
                dateSub: '14/05/2026',
                expire: '--:--',
                expireSub: '--/--/----',
                device: 'iPhone 13',
                deviceSub: 'iOS 16.5',
                amount: '899K',
                status: 'Đã nâng cấp',
                statusClass: 'bg-[#E5F8ED] text-[#05CD99]',
                statusDot: 'bg-[#05CD99]'
            },
            {
                id: 4,
                name: 'Phạm Thị D',
                email: 'phamthid99@gmail.com',
                avatar: '{{ asset('assets/admin/horizon/avatars/avatar4.png') }}',
                package: '1 Năm',
                packageSub: 'Locket Gold',
                code: '#LK-9015',
                method: 'ZaloPay',
                date: '11:30',
                dateSub: '14/05/2026',
                expire: '--:--',
                expireSub: '--/--/----',
                device: 'iPhone 14 Pro',
                deviceSub: 'iOS 17.1',
                amount: '399K',
                status: 'Hoàn tiền',
                statusClass: 'bg-[#E1E9F8] text-[#4318FF]',
                statusDot: 'bg-[#4318FF]'
            }
        ],
        openModal(order) {
            this.selectedOrder = order;
            this.modalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeModal() {
            this.modalOpen = false;
            setTimeout(() => {
                this.selectedOrder = null;
                document.body.style.overflow = '';
            }, 300);
        }
    }))
})
</script>
@endpush
@endsection
