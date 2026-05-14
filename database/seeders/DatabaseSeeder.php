<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Plan;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Tạo tài khoản Admin mặc định
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@locketgold.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Tạo các gói Locket Gold mặc định
        Plan::create([
            'name' => 'Gói Gold 1 Tháng',
            'price' => 49000,
            'description' => 'Trải nghiệm đầy đủ tính năng Gold trong vòng 30 ngày.',
            'features' => ['Video dài từ 3s - 60s', 'Tùy chỉnh Icon ứng dụng', 'Badge vàng chính chủ', 'Bảo hành 1 đổi 1'],
        ]);

        Plan::create([
            'name' => 'Gói Gold 1 Năm',
            'price' => 189000,
            'description' => 'Gói tiết kiệm được yêu thích nhất cho người dùng trung thành.',
            'features' => ['Full tính năng Gold 12 tháng', 'Icon Premium giới hạn', 'Hỗ trợ kích hoạt nhanh', 'Bảo hành trọn thời hạn'],
        ]);

        Plan::create([
            'name' => 'Gói Gold Vĩnh Viễn',
            'price' => 450000,
            'description' => 'Sở hữu trọn đời các đặc quyền cao cấp nhất của Locket.',
            'features' => ['Full đặc quyền vĩnh viễn', 'Mở khóa mọi tính năng tương lai', 'Hỗ trợ ưu tiên 24/7', 'Badge Gold giới hạn độc quyền'],
        ]);

        // Tạo các bài viết mẫu
        Post::create([
            'title' => 'Locket Gold là gì? Tại sao nên nâng cấp ngay hôm nay?',
            'image' => 'hero1.png',
            'excerpt' => 'Khám phá tất cả các tính năng độc quyền mà bản Locket miễn phí không bao giờ có được.',
            'content' => '<p>Locket Gold là phiên bản trả phí cao cấp của ứng dụng Locket, mang lại sự tự do và sáng tạo không giới hạn cho người dùng...</p>',
            'category' => 'Tin tức',
        ]);

        Post::create([
            'title' => 'Hướng dẫn 3 bước kích hoạt Locket Gold cực nhanh',
            'image' => 'hero2.png',
            'excerpt' => 'Chỉ mất chưa đầy 5 phút để bạn sở hữu huy hiệu vàng và các tính năng Premium.',
            'content' => '<p>Bước 1: Chọn gói cước phù hợp. Bước 2: Thanh toán qua mã QR. Bước 3: Nhập mã kích hoạt và tận hưởng...</p>',
            'category' => 'Hướng dẫn',
        ]);
    }
}
