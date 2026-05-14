@extends('layouts.admin')

@section('title', 'Quản lý Kích hoạt - Horizon UI')
@section('page_title', 'Kích hoạt')

@section('content')
<div class="bg-white rounded-3xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-xl font-bold text-admin-heading">Danh sách kích hoạt</h3>
        <div class="flex gap-2">
            <button class="bg-[#F4F7FE] text-admin-body px-4 py-2 rounded-xl text-xs font-bold hover:bg-gray-100">Export CSV</button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[11px] font-bold text-admin-body uppercase tracking-wider border-b border-gray-50">
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Người dùng</th>
                    <th class="px-6 py-4">Gói</th>
                    <th class="px-6 py-4">Username Locket</th>
                    <th class="px-6 py-4">Trạng thái</th>
                    <th class="px-6 py-4">Thời gian</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($activations ?? [] as $act)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-sm text-admin-body">#{{ $act->id }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-admin-primary/10 rounded-full flex items-center justify-center text-admin-primary font-bold text-xs">
                                {{ substr($act->user->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-admin-heading">{{ $act->user->name ?? 'Unknown' }}</span>
                                <span class="text-[10px] text-admin-body">{{ $act->user->email ?? '' }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-admin-heading">{{ $act->plan->name ?? 'N/A' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-mono text-admin-primary font-bold">{{ $act->locket_username ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-amber-100 text-amber-600',
                                'processing' => 'bg-blue-100 text-blue-600',
                                'completed' => 'bg-green-100 text-green-600',
                                'failed' => 'bg-red-100 text-red-600',
                            ];
                            $statusClass = $statusClasses[$act->status] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <span class="px-2.5 py-1 {{ $statusClass }} text-[10px] font-bold rounded-lg uppercase">
                            {{ $act->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs text-admin-body">
                        {{ $act->created_at->format('H:i d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-admin-body hover:text-admin-primary transition-colors">
                            <iconify-icon icon="ic:round-more-horiz" class="text-xl"></iconify-icon>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-2">
                            <iconify-icon icon="ic:round-inbox" class="text-4xl text-gray-200"></iconify-icon>
                            <p class="text-sm text-admin-body">Chưa có yêu cầu kích hoạt nào.</p>
                        </div>
                    </td>
                </tr>
                @endempty
            </tbody>
        </table>
    </div>
</div>
@endsection
