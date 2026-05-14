import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // ─── Theme toggle is handled in app.blade.php inline ───

    // ─── Sidebar / Drawer Logic ───
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const sidebarClose = document.querySelector('.sidebar .btn-icon');

    function openSidebar() {
        if (!sidebar) return;
        sidebar.classList.add('open');
        if (overlay) overlay.classList.add('visible');
        if (hamburger) hamburger.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        if (!sidebar) return;
        sidebar.classList.remove('open');
        if (overlay) overlay.classList.remove('visible');
        if (hamburger) hamburger.classList.remove('open');
        document.body.style.overflow = '';
    }

    if (hamburger) {
        hamburger.addEventListener('click', () => {
            sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        });
    }
    
    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar when clicking links on mobile
    document.querySelectorAll('.sidebar-nav-item, .movie-item, .new-arrival').forEach(el => {
        el.addEventListener('click', () => {
            if (window.innerWidth <= 900) closeSidebar();
        });
    });
});

// ─── Global Plan Card Interactions ───
window.showDetails = function(btn) {
    const card = btn.closest('.mini-plan-card');
    if (!card) return;
    card.classList.add('show-details');
    if (window.innerWidth <= 600) {
        document.body.style.overflow = 'hidden';
    }
};

window.closeDetails = function(btn) {
    const card = btn.closest('.mini-plan-card');
    if (!card) return;
    card.classList.remove('show-details');
    document.body.style.overflow = '';
};
