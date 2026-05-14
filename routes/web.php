<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ActivationController as UserActivationController;
use App\Http\Controllers\User\PricingController;
use App\Http\Controllers\User\SupportController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Controllers\User\GuideController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActivationController as AdminActivationController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\User\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/activation', [UserActivationController::class, 'index'])->name('activation');
Route::post('/activation/process', [UserActivationController::class, 'process'])->name('activation.process')->middleware('auth');

// Payment Routes
Route::middleware('auth')->group(function () {
    Route::get('/checkout/{plan_id}', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/status/{order_id}', [PaymentController::class, 'checkStatus'])->name('checkout.status');
});
Route::post('/webhook/sepay', [PaymentController::class, 'webhook'])->name('webhook.sepay');
Route::post('/sepay', [PaymentController::class, 'webhook']);

Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/support', [SupportController::class, 'index'])->name('support');
Route::get('/contact', [UserContactController::class, 'index'])->name('contact');
Route::get('/guide', [GuideController::class, 'index'])->name('guide');
Route::post('/guide/{post}/comment', [GuideController::class, 'storeComment'])->name('guide.comment')->middleware('auth');
use App\Http\Controllers\Auth\AuthController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.post');

    Route::middleware(['admin'])->group(function () {
        Route::post('/logout', function () {
            auth()->logout();
            return redirect()->route('admin.login')->with('success', 'Bạn đã đăng xuất khỏi hệ thống quản trị.');
        })->name('logout');
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/activations', [AdminActivationController::class, 'index'])->name('activations');
        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts');
        Route::get('/orders', function () {
            return view('admin.orders.index');
        })->name('orders');
        
        Route::get('/employees', function () {
            return view('admin.employees.index');
        })->name('employees');
        
        Route::get('/affiliates', function () {
            return view('admin.affiliates.index');
        })->name('affiliates');

        Route::get('/profile', function () {
            return view('admin.profile.index');
        })->name('profile');

        // Plans Management
        Route::resource('plans', \App\Http\Controllers\Admin\AdminPlanController::class);
    });
});
