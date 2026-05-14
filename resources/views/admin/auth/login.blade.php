@extends('layouts.admin')

@section('title', 'Sign In - Horizon UI')
@section('page_title', 'Sign In')

@section('content')
<div class="flex justify-center items-center w-full min-h-[calc(100vh-200px)]">
<div class="w-full max-w-[410px]">
    
    <!-- Google Login -->
    <button class="w-full bg-[#F4F7FE] py-4 rounded-2xl flex items-center justify-center gap-3 text-admin-heading font-bold text-sm hover:bg-gray-100 transition-colors mb-8">
        <iconify-icon icon="logos:google-icon" class="text-xl"></iconify-icon>
        Sign in with Google
    </button>

    <div class="flex items-center gap-4 mb-8">
        <div class="flex-1 h-px bg-gray-100"></div>
        <span class="text-admin-body text-sm font-medium">or</span>
        <div class="flex-1 h-px bg-gray-100"></div>
    </div>

    <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label for="email" class="block text-sm font-bold text-admin-heading mb-2">Email*</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-white border border-gray-200 rounded-2xl py-4 px-5 focus:ring-2 focus:ring-admin-primary focus:border-transparent outline-none transition-all placeholder-admin-body" placeholder="admin@locketgold.com" required>
        </div>

        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-bold text-admin-heading mb-2">Password*</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" name="password" class="w-full bg-white border border-gray-200 rounded-2xl py-4 px-5 focus:ring-2 focus:ring-admin-primary focus:border-transparent outline-none transition-all placeholder-admin-body" placeholder="Nhập mật khẩu" required>
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-5 flex items-center text-admin-body hover:text-admin-heading transition-colors">
                    <iconify-icon :icon="show ? 'ic:outline-visibility' : 'ic:outline-visibility-off'" class="text-2xl"></iconify-icon>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" name="remember" class="w-5 h-5 rounded border-gray-200 text-admin-primary focus:ring-admin-primary cursor-pointer">
                <span class="text-sm font-medium text-admin-heading">Ghi nhớ đăng nhập</span>
            </label>
            <a href="#" class="text-sm font-bold text-admin-primary hover:underline">Quên mật khẩu?</a>
        </div>

        <button type="submit" class="w-full bg-admin-primary py-4 rounded-2xl text-white font-bold hover:bg-opacity-90 transition-all shadow-lg shadow-admin-primary/20">
            Đăng nhập Admin
        </button>
    </form>



    
</div>
</div>
@endsection
