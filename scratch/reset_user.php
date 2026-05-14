<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\User;
use App\Models\Activation;

$user = User::where('name', 'like', '%Xuân Mai%')->first();
if($user) {
    Activation::where('user_id', $user->id)->update([
        'status' => 'pending',
        'locket_username' => null,
        'dns_link' => null
    ]);
    echo "RESET_SUCCESS for " . $user->name;
} else {
    echo "USER_NOT_FOUND";
}
