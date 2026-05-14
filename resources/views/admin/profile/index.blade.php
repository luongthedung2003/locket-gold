@extends('layouts.admin')

@section('title', 'Trang cá nhân - Locket Gold')
@section('page_title', 'Trang cá nhân')

@section('content')
<div class="w-full pb-8">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
        
        <!-- Left Column -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Profile Card -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 flex flex-col items-center text-center">
                
                <!-- Avatar with soft glow/shadow -->
                <div class="relative mb-6">
                    <div class="w-48 h-48 rounded-full p-2 bg-white shadow-[0_10px_40px_-10px_rgba(67,24,255,0.2)]">
                        <img src="{{ asset('assets/admin/horizon/avatars/avatar1.png') }}" alt="Profile" class="w-full h-full rounded-full object-cover">
                    </div>
                </div>

                <!-- Rating Badge -->
                <div class="bg-[#05CD99] text-white rounded-full px-4 py-1.5 font-bold text-sm inline-flex items-center gap-1.5 mb-8 shadow-md shadow-[#05CD99]/20">
                    <iconify-icon icon="ic:round-star" class="text-lg"></iconify-icon> 5.0
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-4 mb-8">
                    <button class="w-14 h-14 rounded-2xl bg-[#E1E9F8] text-[#4318FF] flex items-center justify-center hover:bg-[#4318FF] hover:text-white transition-colors duration-300 shadow-sm">
                        <iconify-icon icon="ic:outline-videocam" class="text-2xl"></iconify-icon>
                    </button>
                    <button class="w-14 h-14 rounded-2xl bg-[#E1E9F8] text-[#4318FF] flex items-center justify-center hover:bg-[#4318FF] hover:text-white transition-colors duration-300 shadow-sm">
                        <iconify-icon icon="ic:outline-chat-bubble-outline" class="text-2xl"></iconify-icon>
                    </button>
                    <button class="w-14 h-14 rounded-2xl bg-[#E1E9F8] text-[#4318FF] flex items-center justify-center hover:bg-[#4318FF] hover:text-white transition-colors duration-300 shadow-sm">
                        <iconify-icon icon="ic:outline-call" class="text-2xl"></iconify-icon>
                    </button>
                </div>

                <!-- Role / Salary Info -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-admin-heading">Quản trị viên</h3>
                    <p class="text-sm font-medium text-admin-body mt-1">Toàn thời gian</p>
                </div>

                <!-- Primary Action -->
                <button class="w-full bg-[#4318FF] hover:bg-opacity-90 text-white rounded-full py-3.5 font-bold text-sm transition-colors shadow-lg shadow-[#4318FF]/20">
                    Chỉnh sửa hồ sơ
                </button>
            </div>

            <!-- Office Card -->
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-admin-heading text-lg">Văn phòng</h4>
                    <span class="text-xs font-medium text-admin-body">24 hình ảnh</span>
                </div>
                <!-- Placeholder Image -->
                <div class="w-full h-40 bg-gray-100 rounded-[1.5rem] overflow-hidden relative group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=800" alt="Office" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors"></div>
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div class="lg:col-span-8 bg-white rounded-[2rem] p-8 lg:p-10 shadow-sm border border-gray-100">
            
            <!-- Header Info -->
            <div class="mb-10">
                <h1 class="text-3xl lg:text-4xl font-bold text-admin-heading mb-2">Nguyễn Trần Phúc</h1>
                <p class="text-base text-admin-body font-medium">Giám đốc điều hành LocketGold, Chuyên gia Phát triển Phần mềm</p>
            </div>

            <!-- Location & Map -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div>
                    <h4 class="font-bold text-admin-heading text-lg flex items-center gap-2 mb-4">
                        <iconify-icon icon="ic:outline-location-on" class="text-2xl text-admin-body"></iconify-icon> Đà Nẵng, VN
                    </h4>
                    <div class="text-sm font-medium text-admin-body space-y-2 pl-8">
                        <p>Tòa nhà Software Park, 02 Quang Trung</p>
                        <p>Hải Châu, Đà Nẵng 550000</p>
                        <p class="pt-2">(+84) 901 234 567</p>
                    </div>
                </div>
                
                <!-- Interactive Map -->
                <div class="relative h-48 md:h-full bg-gray-50 rounded-[1.5rem] overflow-hidden border border-gray-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122691.5647035542!2d108.13611132640277!3d16.071727763785465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c792252a13%3A0x1df0cb4b86727e06!2zxJDDoCBO4bq1bmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1714013444211!5m2!1svi!2s" width="100%" height="100%" style="border:0; min-height: 200px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full h-full"></iframe>
                </div>
            </div>

            <div class="space-y-8">
                <!-- Specialities -->
                <div>
                    <h4 class="font-bold text-admin-heading text-lg mb-4">Kỹ năng chuyên môn</h4>
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-gray-50 border border-gray-100 text-admin-body hover:text-admin-heading hover:bg-gray-100 transition-colors px-4 py-2 rounded-full text-sm font-bold cursor-default">Phát triển Sản phẩm</span>
                        <span class="bg-gray-50 border border-gray-100 text-admin-body hover:text-admin-heading hover:bg-gray-100 transition-colors px-4 py-2 rounded-full text-sm font-bold cursor-default">Quản lý Dự án</span>
                        <span class="bg-gray-50 border border-gray-100 text-admin-body hover:text-admin-heading hover:bg-gray-100 transition-colors px-4 py-2 rounded-full text-sm font-bold cursor-default">Thiết kế UI/UX</span>
                    </div>
                </div>

                <!-- Issues (Roles) -->
                <div>
                    <h4 class="font-bold text-admin-heading text-lg mb-4">Vai trò quản lý</h4>
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-[#F4F7FE] text-[#4318FF] px-4 py-2 rounded-full text-sm font-bold cursor-default">CEO</span>
                        <span class="bg-[#F4F7FE] text-[#4318FF] px-4 py-2 rounded-full text-sm font-bold cursor-default">Tech Lead</span>
                        <span class="bg-[#F4F7FE] text-[#4318FF] px-4 py-2 rounded-full text-sm font-bold cursor-default">Vận hành Hệ thống</span>
                        <span class="bg-[#F4F7FE] text-[#4318FF] px-4 py-2 rounded-full text-sm font-bold cursor-default">Marketing</span>
                    </div>
                </div>

                <!-- Qualifications & Experience -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-bold text-admin-heading text-lg mb-3">Bằng cấp & Chứng chỉ</h4>
                        <p class="text-sm font-medium text-admin-body">
                            <strong class="text-admin-heading">Chứng chỉ:</strong> AWS Certified Solutions Architect / 2024
                        </p>
                    </div>
                    <div>
                        <h4 class="font-bold text-admin-heading text-lg mb-3">Kinh nghiệm làm việc</h4>
                        <p class="text-sm font-medium text-admin-body">
                            10 năm / Hơn 50+ dự án phần mềm lớn nhỏ
                        </p>
                    </div>
                </div>

                <!-- About -->
                <div>
                    <h4 class="font-bold text-admin-heading text-lg mb-4">Giới thiệu bản thân</h4>
                    <div class="text-sm text-admin-body font-medium leading-loose space-y-4">
                        <p>
                            Với hơn 10 năm kinh nghiệm trong lĩnh vực phát triển phần mềm và quản lý sản phẩm, tôi luôn khao khát xây dựng những hệ thống mang lại giá trị thực tiễn cao cho người dùng. Tại LocketGold, mục tiêu của tôi không chỉ là cung cấp dịch vụ nâng cấp tài khoản một cách nhanh chóng, an toàn, mà còn là kiến tạo một hệ sinh thái chăm sóc khách hàng toàn diện.
                        </p>
                        <p>
                            Khi bạn cảm thấy quá tải với việc vận hành hệ thống hoặc cần một chiến lược công nghệ vững chắc, đó là lúc tôi và đội ngũ có thể bước vào để giải quyết vấn đề. Sự ổn định của sản phẩm và sự hài lòng của bạn là ưu tiên hàng đầu của chúng tôi.
                        </p>
                    </div>
                    
                    <button class="text-[#4318FF] font-bold text-sm mt-4 flex items-center gap-1 hover:underline">
                        Xem thêm <iconify-icon icon="ic:round-expand-more" class="text-lg"></iconify-icon>
                    </button>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
