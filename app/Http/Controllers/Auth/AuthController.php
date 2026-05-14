<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('user.auth.login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['email' => 'Bạn không có quyền truy cập trang quản trị.'])->onlyInput('email');
            }
            
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập Admin thành công!');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập Admin không chính xác.',
        ])->onlyInput('email');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Ghi lại hoạt động đăng nhập
            Activity::create([
                'user_id' => Auth::id(),
                'type' => 'login',
                'title' => 'Đăng nhập hệ thống',
                'description' => 'Bạn vừa đăng nhập vào hệ thống Locket Gold.',
                'icon' => 'hero2.png',
                'progress' => 100
            ]);

            return redirect()->intended('/')->with('success', 'Chào mừng bạn đã quay trở lại!');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Ghi lại hoạt động đăng ký
        Activity::create([
            'user_id' => $user->id,
            'type' => 'register',
            'title' => 'Chào mừng thành viên mới!',
            'description' => 'Bạn vừa đăng ký tài khoản Locket Gold thành công.',
            'icon' => 'hero1.png',
            'progress' => 100
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Bạn đã đăng xuất thành công. Hẹn gặp lại!');
    }
}
