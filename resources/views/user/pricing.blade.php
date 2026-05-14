@extends('layouts.app')

@section('title', 'Bảng giá Locket Gold')

@section('content')
<div class="section-wrap">
  <div class="section-header">
    <h2>Bảng giá các gói nâng cấp</h2>
  </div>

  <div class="downloads-grid">

    @foreach($plans as $index => $plan)
    <div class="mini-plan-card">
      <div class="mpc-details-overlay">
        <div class="mpc-story-indicators">
          @foreach($plans as $i => $p)
          <div class="mpc-indicator {{ $i == $index ? 'active' : '' }}"></div>
          @endforeach
        </div>
        <img src="{{ asset('images/hero' . (($index % 3) + 1) . '.png') }}" class="mpc-details-bg" alt="{{ $plan->name }}">
        
        <div class="mpc-details-glass">
          <div class="mpc-tags">
            @if($plan->features)
                @foreach($plan->features as $feature)
                    <span class="mpc-tag">{{ $feature }}</span>
                @endforeach
            @endif
          </div>
          <h3 class="mpc-story-title">{{ $plan->name }}</h3>
          <p class="mpc-story-price">{{ number_format($plan->price, 0, ',', '.') }}đ</p>
          <p class="mpc-story-desc">
            {{ $plan->description }}
          </p>
        </div>

        <div class="mpc-story-actions">
          <button class="mpc-circle-btn mcb-fav">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
          </button>
          <button class="mpc-circle-btn mcb-main" onclick="window.location='{{ route('checkout', $plan->id) }}'">
             <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12v10H4V12"/><path d="M2 7h20v5H2z"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
          </button>
          <button class="mpc-circle-btn mcb-close" onclick="closeDetails(this)">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
      </div>

      <div class="mpc-image">
         <img src="{{ asset('images/hero' . (($index % 3) + 1) . '.png') }}" alt="{{ $plan->name }}">
      </div>
      <div class="mpc-body">
        <h4 class="mpc-title">{{ $plan->name }} <span class="verified-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.79L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z"/></svg></span></h4>
        <p class="mpc-desc">{{ Str::limit($plan->description, 60) }}</p>
        <div class="mpc-stats">
          <div class="mpc-stat-item">
            <span class="mpc-stat-val">{{ number_format($plan->price / 1000, 0) }}k</span>
            <span class="mpc-stat-label">Giá</span>
          </div>
          <div class="mpc-stat-item">
            <span class="mpc-stat-val">{{ rand(100, 5000) }}</span>
            <span class="mpc-stat-label">User</span>
          </div>
          <div class="mpc-stat-item">
            <span class="mpc-stat-val">iOS</span>
            <span class="mpc-stat-label">HĐH</span>
          </div>
        </div>
        <div class="mpc-footer">
          <a href="{{ route('checkout', $plan->id) }}" class="mpc-btn-main">Đăng ký +</a>
          <div class="mpc-btn-icon" onclick="showDetails(this)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
@endsection

@push('scripts')
<script>
  function showDetails(btn) {
    const card = btn.closest('.mini-plan-card');
    card.querySelector('.mpc-details-overlay').classList.add('active');
  }
  function closeDetails(btn) {
    const overlay = btn.closest('.mpc-details-overlay');
    overlay.classList.remove('active');
  }
</script>
@endpush
