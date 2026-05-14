@extends('layouts.admin')

@section('title', 'Horizon UI - Dashboard')
@section('page_title', 'Main Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-6">
        <!-- Total Users -->
        <div class="bg-white p-4 rounded-3xl flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 bg-[#F4F7FE] rounded-full flex items-center justify-center">
                <iconify-icon icon="ic:round-people" class="text-admin-primary text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-xs font-medium text-admin-body">Người dùng</p>
                <p class="text-xl font-bold text-admin-heading">{{ number_format($stats['total_users']) }}</p>
            </div>
        </div>

        <!-- Total Activations -->
        <div class="bg-white p-4 rounded-3xl flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 bg-[#F4F7FE] rounded-full flex items-center justify-center text-admin-primary">
                <iconify-icon icon="ic:round-bolt" class="text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-xs font-medium text-admin-body">Kích hoạt</p>
                <p class="text-xl font-bold text-admin-heading">{{ number_format($stats['total_activations']) }}</p>
            </div>
        </div>

        <!-- Total Contacts -->
        <div class="bg-white p-4 rounded-3xl shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-[#F4F7FE] rounded-full flex items-center justify-center text-admin-primary">
                <iconify-icon icon="ic:round-message" class="text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-xs font-medium text-admin-body">Yêu cầu hỗ trợ</p>
                <p class="text-xl font-bold text-admin-heading">{{ number_format($stats['total_contacts']) }}</p>
            </div>
        </div>

        <!-- Total Posts -->
        <div class="bg-white p-4 rounded-3xl flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 bg-gradient-to-br from-[#4481EB] to-[#04BEFE] rounded-full flex items-center justify-center text-white">
                <iconify-icon icon="ic:round-article" class="text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-xs font-medium text-admin-body">Bài viết</p>
                <p class="text-xl font-bold text-admin-heading">{{ number_format($stats['total_posts']) }}</p>
            </div>
        </div>

        <!-- Total Comments -->
        <div class="bg-white p-4 rounded-3xl flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 bg-[#F4F7FE] rounded-full flex items-center justify-center text-admin-primary">
                <iconify-icon icon="ic:round-comment" class="text-2xl"></iconify-icon>
            </div>
            <div>
                <p class="text-xs font-medium text-admin-body">Bình luận</p>
                <p class="text-xl font-bold text-admin-heading">{{ number_format($stats['total_comments']) }}</p>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Total Spent -->
        <div class="bg-white p-6 rounded-3xl shadow-sm">
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-center gap-2 px-3 py-2 bg-[#F4F7FE] rounded-lg cursor-pointer">
                    <iconify-icon icon="ic:round-calendar-today" class="text-admin-body"></iconify-icon>
                    <span class="text-xs font-bold text-admin-body">Jan 2024</span>
                </div>
                <div class="w-10 h-10 bg-[#F4F7FE] rounded-xl flex items-center justify-center text-admin-primary cursor-pointer">
                    <iconify-icon icon="ic:round-bar-chart" class="text-2xl"></iconify-icon>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-6 sm:gap-10">
                <div class="shrink-0">
                    <p class="text-3xl font-bold text-admin-heading mb-1">$37.5K</p>
                    <div class="flex items-center gap-2 mb-4">
                        <p class="text-sm font-medium text-admin-body">Total Spent</p>
                        <span class="text-xs font-bold text-admin-success">+2.45%</span>
                    </div>
                    <div class="flex items-center gap-2 text-admin-success">
                        <iconify-icon icon="ic:round-check-circle" class="text-xl"></iconify-icon>
                        <span class="text-sm font-bold">On track</span>
                    </div>
                </div>
                <div id="spentChart" class="h-64 flex-1"></div>
            </div>
        </div>

        <!-- Weekly Revenue -->
        <div class="bg-white p-6 rounded-3xl shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold text-admin-heading">Weekly Revenue</h3>
                <div class="w-10 h-10 bg-[#F4F7FE] rounded-xl flex items-center justify-center text-admin-primary cursor-pointer">
                    <iconify-icon icon="ic:round-bar-chart" class="text-2xl"></iconify-icon>
                </div>
            </div>
            <div id="revenueChart" class="h-64 w-full"></div>
        </div>
    </div>

    <!-- Bottom Row: Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activations -->
        <div class="bg-white p-6 rounded-3xl shadow-sm overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-admin-heading">Kích hoạt gần đây</h3>
                <a href="{{ route('admin.activations') }}" class="text-sm font-bold text-admin-primary">Xem tất cả</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs font-bold text-admin-body uppercase tracking-wider border-b border-gray-100">
                            <th class="pb-4">Người dùng</th>
                            <th class="pb-4">Gói</th>
                            <th class="pb-4">Thời gian</th>
                            <th class="pb-4">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($stats['recent_activations'] as $act)
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-admin-primary/10 rounded-full flex items-center justify-center text-admin-primary font-bold text-xs">
                                        {{ substr($act->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-admin-heading">{{ $act->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="py-4 text-sm font-medium text-admin-body">{{ $act->plan->name ?? 'N/A' }}</td>
                            <td class="py-4 text-sm text-admin-body">{{ $act->created_at->diffForHumans() }}</td>
                            <td class="py-4">
                                <span class="px-2 py-1 bg-admin-success/10 text-admin-success text-[10px] font-bold rounded-md uppercase">Hoàn tất</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-sm text-admin-body">Chưa có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Contacts -->
        <div class="bg-white p-6 rounded-3xl shadow-sm overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-admin-heading">Yêu cầu hỗ trợ mới</h3>
                <a href="{{ route('admin.contacts') }}" class="text-sm font-bold text-admin-primary">Xem tất cả</a>
            </div>
            <div class="space-y-4">
                @forelse($stats['recent_contacts'] as $contact)
                <div class="p-4 bg-[#F4F7FE] rounded-2xl flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-admin-primary shadow-sm">
                            <iconify-icon icon="ic:round-email" class="text-xl"></iconify-icon>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-admin-heading">{{ $contact->name }}</p>
                            <p class="text-xs text-admin-body truncate max-w-[200px]">{{ $contact->subject }}</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-admin-body">{{ $contact->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <div class="py-8 text-center text-sm text-admin-body">Không có tin nhắn mới</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Spent Chart
        const spentChart = echarts.init(document.getElementById('spentChart'));
        spentChart.setOption({
            color: ['#4318FF', '#6AD2FF'],
            tooltip: { trigger: 'axis', backgroundColor: '#11047A', textStyle: { color: '#fff' }, borderRadius: 12, borderWidth: 0 },
            grid: { top: 10, bottom: 20, left: 0, right: 10, containLabel: true },
            xAxis: {
                type: 'category',
                data: ['SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB'],
                axisLine: { show: false },
                axisTick: { show: false },
                axisLabel: { color: '#A3AED0', fontWeight: 500 }
            },
            yAxis: { type: 'value', show: false },
            series: [
                { name: 'Spent', type: 'line', smooth: true, showSymbol: false, data: [50, 40, 60, 55, 70, 65], lineStyle: { width: 4 } },
                { name: 'Income', type: 'line', smooth: true, showSymbol: false, data: [30, 25, 35, 30, 45, 40], lineStyle: { width: 4 } }
            ]
        });

        // Revenue Chart
        const revenueChart = echarts.init(document.getElementById('revenueChart'));
        revenueChart.setOption({
            color: ['#4318FF', '#6AD2FF', '#E9EDF7'],
            tooltip: { trigger: 'axis' },
            grid: { top: 10, bottom: 20, left: 0, right: 0, containLabel: true },
            xAxis: {
                type: 'category',
                data: ['17', '18', '19', '20', '21', '22', '23', '24', '25'],
                axisLine: { show: false },
                axisTick: { show: false },
                axisLabel: { color: '#A3AED0' }
            },
            yAxis: { type: 'value', show: false },
            series: [
                { name: 'A', type: 'bar', stack: 'total', barWidth: 12, data: [40, 30, 45, 35, 40, 30, 35, 40, 30], itemStyle: { borderRadius: [0, 0, 4, 4] } },
                { name: 'B', type: 'bar', stack: 'total', barWidth: 12, data: [30, 40, 35, 45, 30, 25, 30, 35, 40] },
                { name: 'C', type: 'bar', stack: 'total', barWidth: 12, data: [20, 25, 15, 20, 25, 30, 25, 20, 25], itemStyle: { borderRadius: [4, 4, 0, 0] } }
            ]
        });

        // Traffic Chart
        const trafficChart = echarts.init(document.getElementById('trafficChart'));
        trafficChart.setOption({
            color: ['#4318FF'],
            grid: { top: 0, bottom: 0, left: 0, right: 0 },
            xAxis: { type: 'category', show: false, data: ['1', '2', '3', '4', '5', '6', '7'] },
            yAxis: { type: 'value', show: false },
            series: [{ type: 'bar', barWidth: '40%', data: [50, 70, 40, 80, 60, 90, 70], itemStyle: { borderRadius: [4, 4, 0, 0] } }]
        });

        // Pie Chart
        const pieChart = echarts.init(document.getElementById('pieChart'));
        pieChart.setOption({
            color: ['#4318FF', '#6AD2FF', '#EFF4FB'],
            series: [{
                type: 'pie',
                radius: ['60%', '90%'],
                avoidLabelOverlap: false,
                label: { show: false },
                data: [
                    { value: 63, name: 'Your files' },
                    { value: 25, name: 'System' },
                    { value: 12, name: 'Other' }
                ]
            }]
        });

        window.addEventListener('resize', function() {
            spentChart.resize();
            revenueChart.resize();
            trafficChart.resize();
            pieChart.resize();
        });
    });
</script>
@endpush
@endsection
