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
            'name' => 'Gói 1 Tháng',
            'price' => 49000,
            'description' => 'Trải nghiệm đầy đủ tính năng trong 30 ngày',
            'features' => ['Video 3s - 60s', 'Đổi Icon ứng dụng', 'Badge vàng chính chủ'],
        ]);

        Plan::create([
            'name' => 'Gói 1 Năm',
            'price' => 199000,
            'description' => 'Tiết kiệm hơn với gói 12 tháng',
            'features' => ['Video 3s - 60s', 'Đổi Icon ứng dụng', 'Badge vàng chính chủ', 'Bảo hành trọn đời'],
        ]);

        Plan::create([
            'name' => 'Gói Vĩnh Viễn',
            'price' => 499000,
            'description' => 'Mua một lần, sử dụng mãi mãi',
            'features' => ['Full đặc quyền', 'Hỗ trợ ưu tiên 24/7', 'Badge Gold giới hạn'],
        ]);

        // Tạo các bài viết mẫu
        Post::create([
            'title' => 'Cách nâng cấp Locket Gold mới nhất 2026',
            'image' => 'hero1.png',
            'excerpt' => 'Hướng dẫn chi tiết từng bước để sở hữu các tính năng cao cấp của Locket chỉ trong 5 phút.',
            'content' => '<p>Locket Gold mang đến những trải nghiệm tuyệt vời như tải video dài, đổi icon ứng dụng...</p>',
            'category' => 'Hướng dẫn',
        ]);

        Post::create([
            'title' => 'Hướng dẫn kích hoạt Locket Gold bằng Video',
            'image' => 'hero1.png',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'excerpt' => 'Xem video để biết cách kích hoạt gói Locket Gold nhanh chóng và đơn giản nhất.',
            'content' => '<p>Trong video này, chúng tôi sẽ hướng dẫn bạn chi tiết cách thanh toán và kích hoạt...</p>',
            'category' => 'Hướng dẫn',
        ]);

        Post::create([
            'title' => 'Top 5 tính năng đáng giá nhất trên Locket Gold',
            'image' => 'hero2.png',
            'excerpt' => 'Tại sao hàng triệu người dùng đang săn đón gói nâng cấp Gold này? Hãy cùng khám phá.',
            'content' => '<p>Tính năng tải video dài từ 30s đến 60s là một trong những điểm cộng lớn nhất...</p>',
            'category' => 'Tin tức',
        ]);

        Post::create([
            'title' => 'Chính sách bảo hành và hỗ trợ tại LocketGold.com',
            'image' => 'hero3.png',
            'excerpt' => 'Chúng tôi cam kết bảo hành trọn đời cho các gói nâng cấp vĩnh viễn và hỗ trợ 24/7.',
            'content' => '<p>Sự hài lòng của khách hàng là ưu tiên hàng đầu của chúng tôi...</p>',
            'category' => 'Chính sách',
        ]);
    }
}
