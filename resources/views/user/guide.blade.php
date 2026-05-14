@extends('layouts.app')

@section('title', 'Hướng dẫn sử dụng - Locket Gold')

@section('content')
<div class="guide-container">
    
    <!-- ─── STORIES BAR (Full-screen Video Stories) ─── -->
    <div class="guide-stories">
        @php
            $stories = [
                ['name' => 'Cài đặt', 'icon' => 'hero1.png', 'video' => 'story_caidat.mp4'],
                ['name' => 'Thanh toán', 'icon' => 'hero2.png', 'video' => 'story_thanhtoan.mp4'],
                ['name' => 'Gia hạn', 'icon' => 'hero3.png', 'video' => 'story_giahan.mp4'],
                ['name' => 'Mẹo hay', 'icon' => 'hero1.png', 'video' => 'story_meohay.mp4'],
                ['name' => 'Hỗ trợ', 'icon' => 'hero2.png', 'video' => 'story_hotro.mp4'],
                ['name' => 'Bảo hành', 'icon' => 'hero3.png', 'video' => 'story_baohanh.mp4'],
                ['name' => 'ID Apple', 'icon' => 'hero1.png', 'video' => 'story_appleid.mp4'],
                ['name' => 'Lỗi app', 'icon' => 'hero2.png', 'video' => 'story_loiapp.mp4'],
                ['name' => 'Khuyến mãi', 'icon' => 'hero3.png', 'video' => 'story_khuyenmai.mp4'],
                ['name' => 'Review', 'icon' => 'hero1.png', 'video' => 'story_review.mp4'],
            ];
        @endphp
        @foreach($stories as $index => $story)
        <div class="story-item" onclick="openStory('{{ asset('videos/' . $story['video']) }}', '{{ $story['name'] }}')">
            <div class="story-circle {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('images/' . $story['icon']) }}" alt="{{ $story['name'] }}">
            </div>
            <span>{{ $story['name'] }}</span>
        </div>
        @endforeach
    </div>

    <!-- ─── FEED SECTION ─── -->
    <div class="guide-feed">
        
        @foreach($guides as $guide)
        <div class="guide-post glass-card" data-post-id="{{ $guide->id }}">
            <div class="post-header">
                <div class="post-user">
                    <div class="user-avatar">LG</div>
                    <div class="user-meta">
                        <span class="user-name">Locket Gold Team <svg width="12" height="12" viewBox="0 0 24 24" fill="#3a3aff"><path d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.79L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z"/></svg></span>
                        <span class="post-time">{{ $guide->created_at->diffForHumans() }} • {{ $guide->category }}</span>
                    </div>
                </div>
                <button class="post-more"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg></button>
            </div>

            <div class="post-content">
                @if($guide->video_url)
                <div class="video-wrapper">
                    <img src="{{ asset('images/' . ($guide->image ?? 'hero1.png')) }}" class="content-thumb" alt="{{ $guide->title }}">
                    <div class="play-overlay" onclick="openVideoModal('{{ $guide->video_url }}')">
                        <div class="play-btn-circle">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                @else
                <img src="{{ asset('images/' . ($guide->image ?? 'hero1.png')) }}" class="content-thumb" alt="{{ $guide->title }}">
                @endif
            </div>

            <div class="post-footer">
                <div class="post-actions">
                    <div class="actions-left">
                        <button class="action-btn btn-like" onclick="toggleLike(this)">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="heart-icon"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        </button>
                        <button class="action-btn btn-comment" onclick="openCommentSheet({{ $guide->id }})"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></button>
                        <button class="action-btn"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polyline points="22 2 15 22 11 13 2 9 22 2"/></svg></button>
                    </div>
                    <button class="action-btn"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg></button>
                </div>
                <div class="post-stats">
                    <span class="likes-count">{{ rand(500, 5000) }}</span> lượt thích
                </div>
                <div class="post-caption">
                    <span class="caption-user">LocketGold</span> {{ $guide->excerpt }}
                </div>
                
                <!-- Comment Preview (Show 2 earliest) -->
                <div class="comment-list-preview">
                    @php $earliestComments = $guide->comments->sortBy('created_at')->take(2); @endphp
                    @foreach($earliestComments as $comment)
                    <div class="comment-item-mini">
                        <span class="c-user">{{ $comment->user->name ?? 'Người dùng' }}</span>
                        <span class="c-text">{{ $comment->content }}</span>
                    </div>
                    @endforeach
                </div>

                @if($guide->comments->count() > 2)
                <div class="post-comments-preview" onclick="openCommentSheet({{ $guide->id }})">Xem tất cả {{ $guide->comments->count() }} bình luận</div>
                @elseif($guide->comments->count() > 0)
                <div class="post-comments-preview" onclick="openCommentSheet({{ $guide->id }})">Thêm bình luận...</div>
                @else
                <div class="post-comments-preview" onclick="openCommentSheet({{ $guide->id }})">Hãy là người đầu tiên bình luận...</div>
                @endif
            </div>

            <!-- ─── IN-POST COMMENT OVERLAY (Contextual) ─── -->
            <div id="comment-overlay-{{ $guide->id }}" class="comment-overlay">
                <div class="overlay-header">
                    <h3>Bình luận</h3>
                    <button class="overlay-close" onclick="closeCommentOverlay({{ $guide->id }})">&times;</button>
                </div>
                <div class="overlay-content">
                    <div class="sheet-comments-list">
                        @foreach($guide->comments->sortBy('created_at') as $comment)
                        <div class="sheet-comment-item">
                            <div class="sc-avatar">{{ $comment->user ? substr($comment->user->name, 0, 1) : 'U' }}</div>
                            <div class="sc-body">
                                <div class="sc-user">{{ $comment->user->name ?? 'Người dùng' }} <span class="sc-time">{{ $comment->created_at->diffForHumans() }}</span></div>
                                <div class="sc-text">{{ $comment->content }}</div>
                                <div class="sc-actions">Trả lời</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="sheet-input-area">
                    @auth
                    <form action="{{ route('guide.comment', $guide->id) }}" method="POST" class="sheet-form">
                        @csrf
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=e50914&color=fff" class="sheet-user-avatar">
                        <input type="text" name="content" placeholder="Bình luận cho LocketGold..." required>
                        <button type="submit">Đăng</button>
                    </form>
                    @else
                    <p class="sheet-login-hint">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.</p>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>

<!-- ─── FULL SCREEN STORY MODAL ─── -->
<div id="storyModal" class="story-modal">
    <div class="story-progress-container">
        <div id="storyProgress" class="story-progress-fill"></div>
    </div>
    <div class="story-header-overlay">
        <div class="story-user-info">
            <div class="story-avatar">LG</div>
            <span id="storyTitle" class="story-user-name"></span>
        </div>
        <button class="story-close" onclick="closeStory()">&times;</button>
    </div>
    <video id="storyVideo" class="story-video-content" playsinline></video>
</div>

<!-- Video Modal (Existing Feed Video) -->
<div id="videoModal" class="video-modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeVideoModal()">&times;</span>
        <iframe id="videoFrame" width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<style>
/* ─── IN-POST COMMENT OVERLAY STYLES (Desktop Fix) ─── */
.guide-post { position: relative; } /* Important for absolute positioning */

.comment-overlay {
    position: absolute;
    top: 40%;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    z-index: 1000;
    display: none;
    flex-direction: column;
    border-radius: 0 0 16px 16px;
    overflow: hidden;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
    animation: slideUpIn 0.3s cubic-bezier(0.32, 0.72, 0, 1);
}
html:not(.light) .comment-overlay { background: #121212; border: 1px solid rgba(255,255,255,0.05); }

@keyframes slideUpIn {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.comment-overlay.show { display: flex; }

.overlay-header { 
    padding: 12px 16px; 
    border-bottom: 1px solid rgba(0,0,0,0.05); 
    display: flex; 
    justify-content: center; 
    position: relative; 
}
html:not(.light) .overlay-header { border-bottom-color: rgba(255,255,255,0.05); }
.overlay-header h3 { font-size: 0.95rem; font-weight: 700; color: var(--text-primary); }
.overlay-close { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; font-size: 1.4rem; color: var(--text-muted); cursor: pointer; }

.overlay-content { 
    flex: 1; 
    overflow-y: auto; 
    padding: 15px; 
    scrollbar-width: none; /* Firefox */
}
.overlay-content::-webkit-scrollbar { 
    display: none; /* Safari and Chrome */
}

/* Mobile Adaptation (standard bottom sheet) */
@media (max-width: 768px) {
    .comment-overlay {
        position: fixed;
        inset: auto 0 0 0;
        height: 70vh;
        border-radius: 20px 20px 0 0;
        z-index: 1000000;
        box-shadow: 0 -10px 40px rgba(0,0,0,0.2);
    }
}

/* Comment UI Shared */
.sheet-comment-item { display: flex; gap: 10px; margin-bottom: 15px; align-items: flex-start; }
.sc-avatar { width: 28px; height: 28px; border-radius: 50%; background: #e50914; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 10px; flex-shrink: 0; }
.sc-body { flex: 1; }
.sc-user { font-size: 0.85rem; font-weight: 600; color: var(--text-primary); display: flex; align-items: center; gap: 4px; white-space: nowrap; }
.sc-time { font-weight: 400; color: var(--text-muted); margin-left: 6px; font-size: 0.7rem; }
.sc-text { font-size: 0.82rem; color: var(--text-primary); line-height: 1.4; }
.sc-actions { font-size: 0.7rem; color: var(--text-muted); font-weight: 700; margin-top: 6px; cursor: pointer; }

.sheet-input-area { padding: 12px 15px; border-top: 1px solid rgba(0,0,0,0.05); background: inherit; }
.sheet-form { display: flex; align-items: center; gap: 10px; }
.sheet-user-avatar { width: 28px; height: 28px; border-radius: 50%; }
.sheet-form input { flex: 1; background: none; border: none; color: var(--text-primary); font-size: 0.82rem; outline: none; }
.sheet-form button { background: none; border: none; color: #3a3aff; font-weight: 700; font-size: 0.82rem; cursor: pointer; }
.sheet-login-hint { font-size: 0.8rem; color: var(--text-muted); text-align: center; }

/* ─── STORY MODAL STYLES ─── */
.story-modal { position: fixed; inset: 0; background: #000; z-index: 3000000; display: none; flex-direction: column; align-items: center; justify-content: center; }
.story-video-content { width: 100%; height: 100%; object-fit: contain; }
.story-header-overlay { position: absolute; top: 0; left: 0; right: 0; padding: 40px 20px 20px; background: linear-gradient(to bottom, rgba(0,0,0,0.6), transparent); display: flex; justify-content: space-between; align-items: center; z-index: 10; }
.story-user-info { display: flex; align-items: center; gap: 10px; }
.story-avatar { width: 32px; height: 32px; border-radius: 50%; background: #e50914; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; border: 2px solid #fff; }
.story-user-name { color: #fff; font-weight: 700; font-size: 0.9rem; }
.story-close { background: none; border: none; color: #fff; font-size: 2.5rem; cursor: pointer; line-height: 1; }
.story-progress-container { position: absolute; top: 20px; left: 10px; right: 10px; height: 2px; background: rgba(255,255,255,0.3); border-radius: 10px; z-index: 11; overflow: hidden; }
.story-progress-fill { width: 0%; height: 100%; background: #fff; transition: width 0.1s linear; }

/* Existing UI Elements */
.video-modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.9); z-index: 2000000; align-items: center; justify-content: center; }
.modal-content { width: 90%; max-width: 800px; aspect-ratio: 16/9; position: relative; }
.close-modal { position: absolute; top: -40px; right: 0; color: white; font-size: 30px; cursor: pointer; }

.guide-container { max-width: 600px; margin: 0 auto; padding: 0 20px 50px; }
.guide-stories { display: flex; gap: 15px; overflow-x: auto; padding: 10px 5px 20px; scrollbar-width: none; }
.story-item { display: flex; flex-direction: column; align-items: center; gap: 6px; min-width: 75px; cursor: pointer; }
.story-circle { width: 66px; height: 66px; border-radius: 50%; padding: 3px; background: var(--bg-card); border: 2px solid var(--border); }
.story-circle.active { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); border: none; }
.story-circle img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 2px solid var(--bg-body); }
.story-item span { font-size: 0.75rem; color: var(--text-secondary); max-width: 70px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.guide-feed { display: flex; flex-direction: column; gap: 20px; }
.guide-post { border-radius: 16px; overflow: hidden; border: 1px solid var(--border); }
.post-header { display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; }
.post-user { display: flex; align-items: center; gap: 10px; }
.user-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--accent-dim); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold; color: var(--accent); }
.user-meta { display: flex; flex-direction: column; }
.user-name { font-size: 0.88rem; font-weight: 700; color: var(--text-primary); display: flex; align-items: center; gap: 5px; white-space: nowrap; line-height: 1.2; }
.post-time { font-size: 0.72rem; color: var(--text-muted); }
.post-content { position: relative; width: 100%; background: #000; cursor: pointer; }
.content-thumb { width: 100%; display: block; aspect-ratio: 1/1; object-fit: cover; }
.play-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.1); }
.play-btn-circle { width: 60px; height: 60px; border-radius: 50%; background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); display: flex; align-items: center; justify-content: center; }
.post-footer { padding: 12px 14px 16px; }
.post-actions { display: flex; justify-content: space-between; margin-bottom: 10px; }
.actions-left { display: flex; gap: 16px; }
.action-btn { background: none; border: none; color: var(--text-primary); cursor: pointer; padding: 0; }
.heart-icon { fill: none; stroke: currentColor; stroke-width: 2; transition: all 0.2s; }
.action-btn.liked .heart-icon { fill: #ff2d55; stroke: #ff2d55; }

/* Comments Preview UI */
.comment-list-preview { margin-top: 10px; }
.comment-item-mini { font-size: 0.78rem; margin-bottom: 4px; line-height: 1.3; display: flex; gap: 6px; }
.comment-item-mini .c-user { font-weight: 700; color: var(--text-primary); }
.comment-item-mini .c-text { color: var(--text-muted); font-weight: 400; }
.post-comments-preview { font-size: 0.82rem; color: var(--text-muted); cursor: pointer; margin-top: 6px; transition: color 0.2s; }
.post-comments-preview:hover { color: var(--text-primary); }

@media (min-width: 1024px) {
    .guide-container { max-width: 1100px; }
    .guide-feed { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .guide-stories { justify-content: center; margin-bottom: 25px; }
}
</style>

<script>
function openStory(videoUrl, title) {
    const modal = document.getElementById('storyModal');
    const video = document.getElementById('storyVideo');
    const titleEl = document.getElementById('storyTitle');
    const progress = document.getElementById('storyProgress');

    titleEl.innerText = title;
    video.src = videoUrl;
    modal.style.display = 'flex';
    video.play();

    video.ontimeupdate = () => {
        const pct = (video.currentTime / video.duration) * 100;
        progress.style.width = pct + '%';
    };
    video.onended = () => closeStory();
}

function closeStory() {
    const modal = document.getElementById('storyModal');
    const video = document.getElementById('storyVideo');
    video.pause();
    video.src = '';
    modal.style.display = 'none';
}

function openCommentSheet(postId) {
    const overlay = document.getElementById(`comment-overlay-${postId}`);
    overlay.classList.add('show');
    if (window.innerWidth <= 768) {
        document.body.style.overflow = 'hidden';
    }
}

function closeCommentOverlay(postId) {
    const overlay = document.getElementById(`comment-overlay-${postId}`);
    overlay.classList.remove('show');
    document.body.style.overflow = '';
}

function openVideoModal(url) {
    const modal = document.getElementById('videoModal');
    const frame = document.getElementById('videoFrame');
    frame.src = url;
    modal.style.display = 'flex';
}

function closeVideoModal() {
    const modal = document.getElementById('videoModal');
    const frame = document.getElementById('videoFrame');
    frame.src = '';
    modal.style.display = 'none';
}

function toggleLike(btn) {
    btn.classList.toggle('liked');
    const likesCountEl = btn.closest('.post-footer').querySelector('.likes-count');
    let currentLikes = parseInt(likesCountEl.innerText.replace(',', ''));
    likesCountEl.innerText = (btn.classList.contains('liked') ? currentLikes + 1 : currentLikes - 1).toLocaleString();
}
</script>
@endsection
