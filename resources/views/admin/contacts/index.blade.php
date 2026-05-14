@extends('layouts.admin')

@section('title', 'Yêu cầu hỗ trợ - Horizon UI')
@section('page_title', 'Hỗ trợ')

@section('content')
<div class="bg-white rounded-3xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-xl font-bold text-admin-heading">Tin nhắn hỗ trợ</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[11px] font-bold text-admin-body uppercase tracking-wider border-b border-gray-50">
                    <th class="px-6 py-4">Người gửi</th>
                    <th class="px-6 py-4">Chủ đề</th>
                    <th class="px-6 py-4">Nội dung</th>
                    <th class="px-6 py-4">Thời gian</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($contacts ?? [] as $contact)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-admin-heading">{{ $contact->name }}</span>
                            <span class="text-[10px] text-admin-body">{{ $contact->email }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-admin-heading">{{ $contact->subject }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs text-admin-body truncate max-w-md">{{ $contact->message }}</p>
                    </td>
                    <td class="px-6 py-4 text-xs text-admin-body">
                        {{ $contact->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="w-8 h-8 bg-admin-primary/10 text-admin-primary rounded-lg flex items-center justify-center hover:bg-admin-primary hover:text-white transition-all">
                            <iconify-icon icon="ic:round-reply"></iconify-icon>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <p class="text-sm text-admin-body">Không có tin nhắn nào.</p>
                    </td>
                </tr>
                @endempty
            </tbody>
        </table>
    </div>
</div>
@endsection
