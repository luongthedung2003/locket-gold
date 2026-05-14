@extends('layouts.admin')

@section('title', 'Đăng ký Affiliate - Locket Gold')
@section('page_title', 'Đăng ký Affiliate')

@section('content')
<div class="w-full" x-data="affiliateManagement()">
    <div class="w-full pt-2">
        <!-- Top Tabs (Transparent Background container) -->
        <div class="border-b border-gray-200 mb-6 overflow-x-auto" style="scrollbar-width: none; -ms-overflow-style: none;">
            <style>
                .overflow-x-auto::-webkit-scrollbar { display: none; }
            </style>
            <div class="flex space-x-6 min-w-max">
                <button class="flex items-center gap-2 py-4 border-b-2 border-[#05CD99] text-[#05CD99] font-bold text-sm px-2 transition-colors">
                    <iconify-icon icon="ic:outline-fiber-new" class="text-xl"></iconify-icon> Đăng ký mới
                </button>
                <button class="flex items-center gap-2 py-4 border-b-2 border-transparent text-admin-body hover:text-admin-heading font-medium text-sm px-2 transition-colors">
                    <iconify-icon icon="ic:outline-support-agent" class="text-lg"></iconify-icon> Đang phỏng vấn
                </button>
                <button class="flex items-center gap-2 py-4 border-b-2 border-transparent text-admin-body hover:text-admin-heading font-medium text-sm px-2 transition-colors">
                    <iconify-icon icon="ic:outline-how-to-reg" class="text-lg"></iconify-icon> Đã duyệt
                </button>
                <button class="flex items-center gap-2 py-4 border-b-2 border-transparent text-admin-body hover:text-admin-heading font-medium text-sm px-2 transition-colors">
                    <iconify-icon icon="ic:outline-do-not-disturb-alt" class="text-lg"></iconify-icon> Từ chối
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
                <input type="text" class="w-full bg-white border border-gray-200 rounded-xl py-2 sm:py-2.5 pl-10 sm:pl-11 pr-4 focus:ring-2 focus:ring-[#05CD99] focus:border-transparent transition-all text-sm font-medium placeholder-gray-400" placeholder="Tìm kiếm ứng viên...">
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                <button class="hidden sm:flex justify-center items-center gap-2 text-[#05CD99] font-bold text-sm px-4 py-2 hover:bg-[#05CD99]/10 rounded-lg transition-colors">
                    <iconify-icon icon="ic:outline-filter-list" class="text-lg"></iconify-icon> Lọc
                </button>

                <div class="w-px h-6 bg-gray-200 hidden sm:block"></div>

                <!-- Sort -->
                <button class="flex items-center justify-center gap-2 bg-white border border-gray-200 text-admin-body px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm sm:shadow-none">
                    <iconify-icon icon="ic:outline-sort" class="text-xl sm:text-lg"></iconify-icon> 
                    <span class="hidden sm:inline">Mới nhất</span>
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
                                    <span class="flex items-center gap-2"><iconify-icon icon="ic:outline-person-outline" class="text-lg text-admin-body"></iconify-icon> Ứng viên</span>
                                    <iconify-icon icon="ic:round-unfold-more" class="text-admin-body"></iconify-icon>
                                </div>
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-2"><iconify-icon icon="ic:outline-contact-phone" class="text-lg text-admin-body"></iconify-icon> Liên hệ</span>
                                    <iconify-icon icon="ic:round-unfold-more" class="text-admin-body"></iconify-icon>
                                </div>
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-2"><iconify-icon icon="ic:outline-campaign" class="text-lg text-admin-body"></iconify-icon> Nền tảng</span>
                                    <iconify-icon icon="ic:round-unfold-more" class="text-admin-body"></iconify-icon>
                                </div>
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <iconify-icon icon="ic:outline-bolt" class="text-lg text-admin-body"></iconify-icon> Trạng thái
                                </div>
                            </th>
                            <th class="py-4 px-6 font-bold text-admin-heading text-sm text-center">
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        <template x-for="(affiliate, index) in affiliates" :key="affiliate.id">
                            <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition-colors" :class="affiliate.selected ? 'bg-[#F4F7FE]' : ''">
                                <!-- Checkbox -->
                                <td class="py-4 px-6">
                                    <input type="checkbox" x-model="affiliate.selected" class="w-5 h-5 rounded border-gray-300 text-[#05CD99] focus:ring-[#05CD99] cursor-pointer">
                                </td>
                                
                                <!-- Profile -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-[#E1E9F8] flex items-center justify-center text-[#4318FF] font-bold text-lg" x-text="affiliate.name.charAt(0)"></div>
                                        <div>
                                            <h4 class="font-bold text-admin-heading text-sm" x-text="affiliate.name"></h4>
                                            <p class="text-xs text-admin-body mt-0.5 flex items-center gap-1">
                                                <iconify-icon icon="ic:outline-access-time"></iconify-icon> <span x-text="affiliate.time"></span>
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contact Info -->
                                <td class="py-4 px-6">
                                    <div class="space-y-1">
                                        <p class="text-sm font-medium text-admin-heading flex items-center gap-2">
                                            <iconify-icon icon="ic:outline-email" class="text-admin-body"></iconify-icon> <span x-text="affiliate.email"></span>
                                        </p>
                                        <p class="text-xs text-admin-body flex items-center gap-2" x-show="affiliate.phone">
                                            <iconify-icon icon="ic:outline-phone" class="text-admin-body"></iconify-icon> <span x-text="affiliate.phone"></span>
                                        </p>
                                    </div>
                                </td>

                                <!-- Platform -->
                                <td class="py-4 px-6">
                                    <div>
                                        <h4 class="font-bold text-admin-heading text-sm mb-1 flex items-center gap-1" x-html="affiliate.platformIcon + ' ' + affiliate.platform"></h4>
                                        <p class="text-xs font-bold text-[#4318FF]" x-text="affiliate.followers + ' Followers'"></p>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-6 text-center">
                                    <div :class="affiliate.statusClass" class="px-3 py-1.5 rounded-full inline-flex items-center gap-1.5 text-xs font-bold w-max mx-auto">
                                        <span x-text="affiliate.status"></span>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-6 text-center">
                                    <button @click="openModal(affiliate)" class="p-2 text-[#4318FF] hover:bg-[#4318FF]/10 rounded-lg transition-colors" title="Duyệt / Xem chi tiết">
                                        <iconify-icon icon="ic:outline-visibility" class="text-xl"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden space-y-4 pb-8">
            <template x-for="affiliate in affiliates" :key="'mobile-'+affiliate.id">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm relative">
                    <!-- Status Badge -->
                    <div class="absolute top-5 right-5">
                        <div :class="affiliate.statusClass" class="px-3 py-1 rounded-full text-[10px] font-bold">
                            <span x-text="affiliate.status"></span>
                        </div>
                    </div>

                    <!-- Profile -->
                    <div class="flex items-center gap-4 border-b border-gray-100 pb-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-[#E1E9F8] flex items-center justify-center text-[#4318FF] font-bold text-xl border-2 border-white shadow-sm" x-text="affiliate.name.charAt(0)"></div>
                        <div class="pr-16">
                            <h4 class="font-bold text-admin-heading text-base" x-text="affiliate.name"></h4>
                            <p class="text-xs text-admin-body flex items-center gap-1 mt-1">
                                <iconify-icon icon="ic:outline-access-time"></iconify-icon> <span x-text="affiliate.time"></span>
                            </p>
                        </div>
                    </div>

                    <!-- Platform Preview -->
                    <div class="mb-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <h5 class="font-bold text-admin-heading text-sm mb-1 flex items-center gap-1" x-html="affiliate.platformIcon + ' ' + affiliate.platform"></h5>
                        <p class="text-sm font-bold text-[#4318FF]" x-text="affiliate.followers + ' Followers'"></p>
                    </div>

                    <!-- Details & Actions -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-admin-body flex items-center gap-2"><iconify-icon icon="ic:outline-email"></iconify-icon> Email</span>
                            <span class="font-medium text-admin-heading" x-text="affiliate.email"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm" x-show="affiliate.phone">
                            <span class="text-admin-body flex items-center gap-2"><iconify-icon icon="ic:outline-phone"></iconify-icon> SĐT</span>
                            <span class="font-medium text-admin-heading" x-text="affiliate.phone"></span>
                        </div>
                        
                        <div class="pt-3 mt-3 border-t border-gray-50 flex gap-3">
                            <button @click="openModal(affiliate)" class="flex-1 py-2.5 bg-[#4318FF]/10 text-[#4318FF] font-bold text-sm rounded-xl flex items-center justify-center gap-2 hover:bg-[#4318FF]/20 transition-colors">
                                <iconify-icon icon="ic:outline-visibility" class="text-lg"></iconify-icon> Xem hồ sơ
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

    </div>

    <!-- Review Modal / Slide-over -->
    <div x-show="modalOpen" class="fixed inset-0 z-[100] flex items-center justify-center lg:justify-end p-4 sm:p-6 lg:p-0" style="display: none;">
        <!-- Backdrop -->
        <div x-show="modalOpen" x-transition.opacity class="absolute inset-0 bg-[#151D48]/60 backdrop-blur-sm" @click="closeModal()"></div>
        
        <!-- Panel -->
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95 lg:opacity-100 lg:translate-y-0 lg:translate-x-full lg:scale-100"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100 lg:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100 lg:translate-x-0"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95 lg:opacity-100 lg:translate-y-0 lg:translate-x-full lg:scale-100"
             class="relative w-full max-w-lg lg:max-w-md xl:max-w-lg bg-white rounded-[2rem] lg:rounded-none lg:rounded-l-[2rem] shadow-2xl overflow-hidden flex flex-col max-h-[85vh] lg:max-h-full lg:h-full">
            
            <!-- Header -->
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white z-10">
                <h3 class="text-lg font-bold text-admin-heading">Chi tiết hồ sơ</h3>
                <button @click="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 hover:bg-gray-100 text-admin-body transition-colors">
                    <iconify-icon icon="ic:round-close" class="text-xl"></iconify-icon>
                </button>
            </div>

            <!-- Body -->
            <div class="p-5 overflow-y-auto flex-1 custom-scrollbar" x-if="selectedAffiliate">
                <!-- Applicant Profile Card -->
                <div class="bg-[#F4F7FE] rounded-[1.5rem] p-4 sm:p-5 mb-6">
                    <div class="flex flex-col items-center mb-4 pb-4 border-b border-gray-200/60">
                        <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center text-[#4318FF] font-bold text-3xl mb-3" x-text="selectedAffiliate?.name.charAt(0)"></div>
                        <h4 class="font-bold text-admin-heading text-lg" x-text="selectedAffiliate?.name"></h4>
                        <div :class="selectedAffiliate?.statusClass" class="px-3 py-1 rounded-full text-xs font-bold mt-2">
                            <span x-text="selectedAffiliate?.status"></span>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-admin-body text-sm font-medium">Email</span>
                            <span class="font-bold text-admin-heading text-sm" x-text="selectedAffiliate?.email"></span>
                        </div>
                        <div class="flex justify-between items-center" x-show="selectedAffiliate?.phone">
                            <span class="text-admin-body text-sm font-medium">SĐT</span>
                            <span class="font-bold text-admin-heading text-sm" x-text="selectedAffiliate?.phone"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-admin-body text-sm font-medium">Kênh</span>
                            <span class="font-bold text-admin-heading text-sm flex items-center gap-1" x-html="selectedAffiliate?.platformIcon + ' ' + selectedAffiliate?.platform"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-admin-body text-sm font-medium">Tương tác</span>
                            <span class="font-bold text-[#4318FF] text-sm" x-text="selectedAffiliate?.followers + ' Followers'"></span>
                        </div>
                    </div>
                </div>

                <!-- Notes / Experience -->
                <div class="mb-6">
                    <h5 class="text-sm font-bold text-admin-heading mb-2">Giới thiệu & Kinh nghiệm</h5>
                    <p class="text-sm text-admin-body leading-relaxed bg-gray-50 p-4 rounded-2xl border border-gray-100" x-text="selectedAffiliate?.experience"></p>
                </div>

                <!-- Internal Notes -->
                <div>
                    <label class="block text-sm font-bold text-admin-heading mb-2">Ghi chú của Admin</label>
                    <textarea class="w-full bg-white border border-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-[#4318FF] focus:border-transparent transition-all text-sm text-admin-body placeholder-gray-400 min-h-[100px] resize-none" placeholder="Nhập ghi chú hoặc lý do từ chối..."></textarea>
                </div>
            </div>

            <!-- Footer -->
            <div class="p-4 sm:p-5 bg-gray-50 border-t border-gray-100 flex gap-3 mt-auto">
                <button @click="closeModal()" class="flex-1 bg-white border border-[#EE5D50] text-[#EE5D50] py-2.5 sm:py-3 rounded-2xl font-bold text-sm hover:bg-[#EE5D50] hover:text-white transition-colors shadow-sm">
                    Từ chối
                </button>
                <button class="flex-1 bg-[#05CD99] py-3 rounded-2xl text-white font-bold text-sm hover:bg-[#05CD99]/90 transition-colors shadow-lg shadow-[#05CD99]/20 flex items-center justify-center gap-2">
                    <iconify-icon icon="ic:round-check-circle" class="text-lg"></iconify-icon> Duyệt hồ sơ
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('affiliateManagement', () => ({
        modalOpen: false,
        selectedAffiliate: null,
        affiliates: [
            {
                id: 1,
                selected: false,
                name: 'Hoàng Nhật Minh',
                time: 'Hôm nay, 14:50',
                email: 'nhatminh.tiktok@gmail.com',
                phone: '+84 901 234 567',
                platform: 'TikTok',
                platformIcon: '<iconify-icon icon="ic:baseline-tiktok" class="text-lg text-black"></iconify-icon>',
                followers: '150.5K',
                experience: 'Chào anh/chị, em là reviewer công nghệ trên TikTok. Đã từng hợp tác làm affiliate cho CapCut Pro và đạt doanh thu 20tr/tháng. Em muốn đăng ký bán gói Locket Gold qua link bio của kênh.',
                status: 'Chờ duyệt',
                statusClass: 'bg-[#FFF4E5] text-[#FFB547]'
            },
            {
                id: 2,
                selected: true,
                name: 'Nguyễn Thúy Quỳnh',
                time: 'Hôm qua, 11:43',
                email: 'quynhnguyen.ig@gmail.com',
                phone: '+84 987 654 321',
                platform: 'Instagram',
                platformIcon: '<iconify-icon icon="mdi:instagram" class="text-lg text-pink-500"></iconify-icon>',
                followers: '45.2K',
                experience: 'Mình là sinh viên năm 3, có tệp follow đa số là Gen Z dùng Locket rất nhiều. Mình muốn làm CTV bán tài khoản Locket Gold cho các bạn trong trường và trên Insta.',
                status: 'Chờ duyệt',
                statusClass: 'bg-[#FFF4E5] text-[#FFB547]'
            },
            {
                id: 3,
                selected: false,
                name: 'Trần Văn Cường',
                time: '12/05/2026, 09:10',
                email: 'cuongtran.fb@gmail.com',
                phone: '+84 912 345 678',
                platform: 'Facebook',
                platformIcon: '<iconify-icon icon="ic:baseline-facebook" class="text-lg text-blue-600"></iconify-icon>',
                followers: '12K',
                experience: 'Mình là admin group "Cộng đồng Locket Vietnam" với hơn 50k thành viên. Rất mong được hợp tác để phân phối Locket Gold chính hãng cho anh em trong group.',
                status: 'Đã duyệt',
                statusClass: 'bg-[#E5F8ED] text-[#05CD99]'
            },
            {
                id: 4,
                selected: false,
                name: 'Phạm Linh Nga',
                time: '11/05/2026, 08:24',
                email: 'linhnga.kol@gmail.com',
                phone: '+84 933 444 555',
                platform: 'YouTube',
                platformIcon: '<iconify-icon icon="mdi:youtube" class="text-lg text-red-600"></iconify-icon>',
                followers: '230K',
                experience: 'Chào team, mình thường làm video hướng dẫn chụp ảnh và app trên điện thoại. Mình muốn giới thiệu tính năng Locket Gold trong video sắp tới và gắn link affiliate.',
                status: 'Từ chối',
                statusClass: 'bg-[#FFEBEB] text-[#EE5D50]'
            }
        ],
        openModal(affiliate) {
            this.selectedAffiliate = affiliate;
            this.modalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeModal() {
            this.modalOpen = false;
            setTimeout(() => {
                this.selectedAffiliate = null;
                document.body.style.overflow = '';
            }, 300);
        }
    }))
})
</script>
@endpush
@endsection
