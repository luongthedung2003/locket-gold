@extends('layouts.app')

@section('title', 'Trang chủ - Locket Gold')

@section('content')
<!-- Hero Slider (Dynamic from Posts) -->
<div class="hero">
  <div class="hero-slider">
    @foreach($posts as $post)
    <div class="hero-slide-item">
        <img src="{{ asset('images/' . ($post->image ?? 'hero1.png')) }}" class="hero-slide" alt="{{ $post->title }}">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-tags">
                <span class="hero-tag">{{ $post->category }}</span>
            </div>
            <h1 class="hero-title">{{ $post->title }}</h1>
            <p class="hero-desc">{{ $post->excerpt }}</p>
            <div class="hero-actions">
              <button class="btn-primary" onclick="window.location='{{ route('activation') }}'">
                <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                Kích hoạt ngay
              </button>
              <button class="btn-secondary" onclick="window.location='{{ route('pricing') }}'">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Xem bảng giá
              </button>
            </div>
        </div>
    </div>
    @endforeach
  </div>
  
  <div class="hero-nav">
    <button class="nav-arrow" id="heroPrev">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <button class="nav-arrow" id="heroNext">
      <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
    </button>
  </div>
</div>

<!-- Popular Plans (Dynamic from Plans) -->
<div class="section-wrap">
  <div class="section-header">
    <h2>Gói nâng cấp phổ biến</h2>
    <button class="see-all" onclick="window.location='{{ route('pricing') }}'">Tất cả gói</button>
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
          <button class="mpc-circle-btn mcb-main" onclick="window.location='{{ route('activation') }}'">
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
        <p class="mpc-desc">{{ Str::limit($plan->description, 50) }}</p>
        <div class="mpc-stats">
          <div class="mpc-stat-item">
            <span class="mpc-stat-val">{{ number_format($plan->price / 1000, 0) }}k</span>
            <span class="mpc-stat-label">Giá</span>
          </div>
          <div class="mpc-stat-item">
            <span class="mpc-stat-val">{{ rand(500, 2000) }}</span>
            <span class="mpc-stat-label">User</span>
          </div>
          <div class="mpc-stat-item">
            <span class="mpc-stat-val">iOS</span>
            <span class="mpc-stat-label">HĐH</span>
          </div>
        </div>
        <div class="mpc-footer">
          <a href="{{ route('activation') }}" class="mpc-btn-main">Đăng ký +</a>
          <div class="mpc-btn-icon" onclick="showDetails(this)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>

<style>
/* CSS cho Slider mượt mà hơn */
.hero-slider {
    display: flex;
    width: {{ count($posts) > 0 ? count($posts) * 100 : 100 }}%;
    transition: transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1);
}
.hero-slide-item {
    width: {{ count($posts) > 0 ? 100 / count($posts) : 100 }}%;
    position: relative;
    height: 100%;
}
.hero-slide {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.hero-content {
    position: absolute;
    bottom: 10%;
    left: 5%;
    z-index: 10;
    max-width: 600px;
}
.hero-tags { margin-bottom: 15px; }
.hero-tag {
    background: #e50914;
    color: white;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 800;
    text-transform: uppercase;
}
.hero-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 4rem;
    color: white;
    line-height: 1;
    margin-bottom: 15px;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
}
.hero-desc {
    color: rgba(255,255,255,0.9);
    font-size: 1.1rem;
    margin-bottom: 25px;
    font-weight: 500;
}
</style>
@endsection

@push('scripts')
<script>
  let heroIdx = 0;
  const heroCount = {{ count($posts) }};
  const heroSlider = document.querySelector('.hero-slider');

  function updateHero(idx) {
    if (heroSlider && heroCount > 0) {
        heroSlider.style.transform = `translateX(-${idx * (100 / heroCount)}%)`;
    }
  }

  document.getElementById('heroPrev').addEventListener('click', () => {
    heroIdx = (heroIdx - 1 + heroCount) % heroCount;
    updateHero(heroIdx);
  });
  document.getElementById('heroNext').addEventListener('click', () => {
    heroIdx = (heroIdx + 1) % heroCount;
    updateHero(heroIdx);
  });

  // Tự động lướt sau mỗi 5 giây
  setInterval(() => {
    heroIdx = (heroIdx + 1) % heroCount;
    updateHero(heroIdx);
  }, 5000);

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
