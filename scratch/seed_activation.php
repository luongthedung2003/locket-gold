<?php
use App\Models\User;
use App\Models\Activation;
use App\Models\Plan;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = User::all();
if ($users->isEmpty()) {
    echo "No users found!";
    exit;
}

$plan = Plan::first();
if (!$plan) {
    $plan = Plan::create([
        'name' => 'Locket Gold Premium',
        'price' => 59000,
        'description' => 'Gói nâng cấp 1 tháng',
        'features' => ['Video 60s', 'Badge Gold', 'Đổi Icon']
    ]);
}

foreach ($users as $user) {
    Activation::firstOrCreate(
        ['user_id' => $user->id, 'status' => 'pending'],
        [
            'plan_id' => $plan->id,
            'payment_status' => 'completed',
            'amount' => $plan->price,
            'payment_method' => 'manual'
        ]
    );
}

echo "Activation created successfully for " . $users->count() . " users.";
