@extends('layouts.admin')

@section('title', 'Quản lý gói Locket - Locket UI')
@section('page_title', 'Gói Locket')

@push('layout_x_data')
x-data="planManager()"
@endpush

@push('page_actions')
<button @click="openAdd()" class="bg-admin-primary text-white px-5 py-2 rounded-2xl font-bold text-[11px] hover:scale-105 active:scale-95 transition-all flex items-center gap-2 shadow-lg shadow-admin-primary/20">
    <iconify-icon icon="ic:round-add-circle" class="text-lg"></iconify-icon>
    <span class="hidden sm:inline">Thêm gói mới</span>
</button>
@endpush

@section('content')
<div class="pb-12">
    <!-- Plans Grid - Forced 3 columns -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($plans as $index => $plan)
        <div class="bg-white rounded-[24px] overflow-hidden shadow-sm hover:shadow-xl hover:shadow-gray-200/40 transition-all duration-500 group border border-gray-50 flex flex-col h-full">
            <!-- Card Header: Pure Image -->
            <div class="relative h-36 overflow-hidden">
                <img src="{{ asset('images/hero' . (($index % 3) + 1) . '.png') }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
            </div>

            <!-- Card Body -->
            <div class="p-5 flex-1 flex flex-col">
                <div class="flex justify-between items-start mb-3">
                    <div class="space-y-0.5">
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="w-1.5 h-1.5 bg-admin-success rounded-full shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                            <span class="text-[9px] font-bold text-admin-success uppercase tracking-widest">Active</span>
                        </div>
                        <h4 class="text-lg font-bold text-admin-heading tracking-tight leading-tight">{{ $plan->name }}</h4>
                    </div>
                    <div class="bg-admin-primary/5 px-2.5 py-1.5 rounded-xl border border-admin-primary/10">
                        <span class="text-admin-primary font-bold text-xs">{{ number_format($plan->price, 0, ',', '.') }}đ</span>
                    </div>
                </div>

                <p class="text-admin-body text-[11px] leading-relaxed mb-4 line-clamp-2">
                    {{ $plan->description ?? 'Trải nghiệm trọn vẹn các tính năng cao cấp của Locket Gold.' }}
                </p>

                <div class="space-y-2 mb-6">
                    @if($plan->features)
                        @foreach(array_slice($plan->features, 0, 3) as $feature)
                        <div class="flex items-center gap-2.5">
                            <div class="w-4 h-4 rounded-full bg-admin-success/10 flex items-center justify-center text-admin-success">
                                <iconify-icon icon="ic:round-check" class="text-[10px]"></iconify-icon>
                            </div>
                            <span class="text-[11px] font-bold text-admin-heading/70">{{ $feature }}</span>
                        </div>
                        @endforeach
                    @endif
                </div>

                <!-- Footer Actions -->
                <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <button @click="openEdit({{ json_encode($plan) }})" class="w-9 h-9 bg-admin-primary/5 text-admin-primary rounded-xl flex items-center justify-center hover:bg-admin-primary hover:text-white transition-all duration-300">
                            <iconify-icon icon="ic:round-edit" class="text-lg"></iconify-icon>
                        </button>
                        <button @click="confirmDelete({{ $plan->id }})" class="w-9 h-9 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-300">
                            <iconify-icon icon="ic:round-delete-forever" class="text-lg"></iconify-icon>
                        </button>
                    </div>
                    <iconify-icon icon="ic:round-star" class="text-amber-400 text-xl opacity-10 group-hover:opacity-100 transition-opacity"></iconify-icon>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ─── UPSERT MODAL (Teleported to Body) ─── -->
    <template x-teleport="body">
        <div x-show="showModal" 
             class="fixed inset-0 flex items-center justify-center p-4"
             style="z-index: 999999; display: none;"
             x-cloak>
            
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-[#1B254B]/30 backdrop-blur-sm" 
                 @click="showModal = false" 
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100"></div>

            <!-- Modal Content -->
            <div class="relative bg-white w-[500px] max-w-full rounded-[24px] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] overflow-hidden mt-12"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-95 opacity-0 translate-y-8"
                 x-transition:enter-end="scale-100 opacity-100 translate-y-0"
                 @click.away="showModal = false">
                
                <div class="p-6">
                    <!-- Header -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="text-xl font-bold text-[#1B254B]" x-text="isEdit ? 'Chỉnh sửa gói' : 'Thêm gói mới'"></h3>
                            <button @click="showModal = false" class="text-[#A3AED0] hover:text-[#1B254B] transition-colors">
                                <iconify-icon icon="ic:round-close" class="text-2xl"></iconify-icon>
                            </button>
                        </div>
                        <p class="text-xs text-[#A3AED0] font-medium">Thiết lập các thông số cho gói dịch vụ Locket.</p>
                    </div>

                    <form :action="isEdit ? `/admin/plans/${planData.id}` : '/admin/plans'" method="POST" class="space-y-6">
                        @csrf
                        <template x-if="isEdit">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <!-- Section: Thông tin chung -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-[#1B254B] ml-1">Tên hiển thị</label>
                                <input type="text" name="name" x-model="planData.name" required placeholder="Tên gói" class="w-full bg-[#F4F7FE] border-none rounded-xl py-2.5 px-4 outline-none font-medium text-sm text-[#1B254B] focus:ring-2 focus:ring-admin-primary/20 transition-all">
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-[#1B254B] ml-1">Giá bán (VNĐ)</label>
                                <input type="number" name="price" x-model="planData.price" required placeholder="Giá" class="w-full bg-[#F4F7FE] border-none rounded-xl py-2.5 px-4 outline-none font-medium text-sm text-[#1B254B] focus:ring-2 focus:ring-admin-primary/20 transition-all">
                            </div>
                        </div>

                        <!-- Section: Đặc quyền -->
                        <div class="pt-5 border-t border-gray-50">
                            <div class="flex justify-between items-center mb-3 px-1">
                                <label class="text-xs font-bold text-[#1B254B]">Đặc quyền dịch vụ</label>
                                <button type="button" @click="addFeature()" class="text-[10px] font-bold text-admin-primary hover:underline uppercase tracking-widest">+ THÊM DÒNG</button>
                            </div>
                            
                            <div class="max-h-40 overflow-y-auto space-y-2 pr-2 custom-scrollbar">
                                <template x-for="(feature, index) in planData.features" :key="index">
                                    <div class="flex gap-2 items-center">
                                        <input type="text" name="features[]" x-model="planData.features[index]" required class="flex-1 bg-[#F4F7FE] border-none rounded-xl py-2 px-4 text-xs font-medium text-[#1B254B] outline-none focus:ring-2 focus:ring-admin-primary/20">
                                        <button type="button" @click="removeFeature(index)" class="text-[#A3AED0] hover:text-red-500 transition-colors">
                                            <iconify-icon icon="ic:round-delete-outline" class="text-lg"></iconify-icon>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Footer Buttons -->
                        <div class="pt-5 border-t border-gray-50 flex justify-end items-center gap-3">
                            <button type="button" @click="showModal = false" class="px-5 py-2 bg-white border border-gray-200 text-[#1B254B] rounded-xl font-bold text-xs hover:bg-gray-50 shadow-sm transition-all">Cancel</button>
                            <button type="submit" class="px-7 py-2 bg-admin-primary text-white rounded-xl font-bold text-xs shadow-lg shadow-admin-primary/20 hover:opacity-90 active:scale-95 transition-all">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <!-- ─── DELETE CONFIRMATION MODAL ─── -->
    <template x-teleport="body">
        <div x-show="showDeleteModal" 
             class="fixed inset-0 flex items-center justify-center p-4"
             style="z-index: 1000000; display: none;"
             x-cloak>
            
            <div class="absolute inset-0 bg-[#1B254B]/40 backdrop-blur-sm" @click="showDeleteModal = false"></div>

            <div class="relative bg-white w-[400px] max-w-full rounded-[28px] shadow-2xl p-8 text-center"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-90 opacity-0"
                 x-transition:enter-end="scale-100 opacity-100">
                
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-red-200" style="background-color: #FEF2F2; color: #DC2626;">
                    <iconify-icon icon="ic:round-warning-amber" class="text-4xl"></iconify-icon>
                </div>

                <h3 class="text-xl font-bold mb-2" style="color: #1B254B;">Xác nhận xóa gói?</h3>
                <p class="text-sm font-medium mb-8 leading-relaxed" style="color: #707EAE;">Hành động này sẽ xóa vĩnh viễn gói dịch vụ. Bạn có chắc chắn muốn tiếp tục?</p>

                <div class="flex flex-col gap-3">
                    <form :action="`/admin/plans/${deleteId}`" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-6 py-3.5 text-white rounded-2xl font-bold text-sm shadow-xl transition-all hover:opacity-90 active:scale-95" style="background-color: #DC2626; shadow-color: rgba(220, 38, 38, 0.2);">
                            Xác nhận xóa vĩnh viễn
                        </button>
                    </form>
                    <button @click="showDeleteModal = false" class="w-full px-6 py-3.5 rounded-2xl font-bold text-sm transition-all hover:bg-gray-100" style="background-color: #F4F7FE; color: #1B254B;">
                        Hủy bỏ, quay lại
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
    [x-cloak] { display: none !important; }
</style>

<script>
    function planManager() {
        return {
            showModal: false,
            showDeleteModal: false,
            isEdit: false,
            deleteId: null,
            planData: { id: '', name: '', price: '', description: '', features: [''] },
            openAdd() {
                this.isEdit = false;
                this.planData = { id: '', name: '', price: '', description: '', features: ['Kích hoạt nhanh', 'Bảo hành trọn đời'] };
                this.showModal = true;
            },
            openEdit(plan) {
                this.isEdit = true;
                this.planData = { 
                    id: plan.id, 
                    name: plan.name, 
                    price: Math.round(plan.price), 
                    description: plan.description, 
                    features: plan.features ? [...plan.features] : [''] 
                };
                this.showModal = true;
            },
            confirmDelete(id) {
                this.deleteId = id;
                this.showDeleteModal = true;
            },
            addFeature() { this.planData.features.push(''); },
            removeFeature(index) { this.planData.features.splice(index, 1); }
        }
    }
</script>
@endsection
