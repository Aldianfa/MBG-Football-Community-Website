/* ============================================
   MBG FC — Main JavaScript
   Vanilla JS, no dependencies
   ============================================ */

(function () {
    'use strict';

    /* ----------------------------------------
       THEME (Light / Dark)
    ---------------------------------------- */
    const html = document.documentElement;
    const btnTheme = document.getElementById('btn-theme');
    const THEME_KEY = 'mbgfc_theme';

    function applyTheme(theme) {
        html.setAttribute('data-theme', theme);
        localStorage.setItem(THEME_KEY, theme);
    }

    function initTheme() {
        const saved = localStorage.getItem(THEME_KEY);
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        applyTheme(saved ?? (prefersDark ? 'dark' : 'light'));
    }

    if (btnTheme) {
        btnTheme.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            applyTheme(current === 'dark' ? 'light' : 'dark');
        });
    }

    initTheme();

    /* ----------------------------------------
       MOBILE MENU
    ---------------------------------------- */
    const btnMenu = document.getElementById('btn-menu');
    const mobileNav = document.getElementById('mobile-nav');

    if (btnMenu && mobileNav) {
        btnMenu.addEventListener('click', () => {
            mobileNav.classList.toggle('open');
            const icon = btnMenu.querySelector('.material-symbols-outlined');
            if (icon) icon.textContent = mobileNav.classList.contains('open') ? 'close' : 'menu';
        });
    }

    /* ----------------------------------------
       ACTIVE NAV LINK
    ---------------------------------------- */
    function setActiveNav() {
        const path = window.location.pathname;
        document.querySelectorAll('.main-nav a, .mobile-nav a').forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href === path || (path === '/' && href === '/')) {
                link.classList.add('active');
            }
        });
    }
    setActiveNav();

    /* ----------------------------------------
       SCHEDULE FILTER TABS
    ---------------------------------------- */
    const filterTabs = document.querySelectorAll('.filter-tab');
    const eventCards = document.querySelectorAll('.event-card[data-type]');

    if (filterTabs.length && eventCards.length) {
        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                filterTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const filter = tab.dataset.filter;
                eventCards.forEach(card => {
                    const show = filter === 'all' || card.dataset.type === filter;
                    card.style.display = show ? '' : 'none';
                    card.style.animation = show ? 'fadeInUp 0.35s ease both' : '';
                });
            });
        });
    }

    /* ----------------------------------------
       GALLERY LIGHTBOX
    ---------------------------------------- */
    const lightbox = document.getElementById('lightbox');
    const lbImg = document.getElementById('lb-img');
    const lbCaption = document.getElementById('lb-caption');
    const lbClose = document.getElementById('lb-close');
    const lbPrev = document.getElementById('lb-prev');
    const lbNext = document.getElementById('lb-next');
    const galleryItems = Array.from(document.querySelectorAll('.gallery-item[data-src]'));

    let currentLbIndex = 0;

    function openLightbox(index) {
        if (!lightbox || !galleryItems.length) return;
        currentLbIndex = index;
        const item = galleryItems[index];
        lbImg.src = item.dataset.src;
        lbCaption.textContent = item.dataset.caption || '';
        lightbox.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        if (!lightbox) return;
        lightbox.classList.remove('open');
        document.body.style.overflow = '';
        lbImg.src = '';
    }

    function navigateLb(direction) {
        currentLbIndex = (currentLbIndex + direction + galleryItems.length) % galleryItems.length;
        openLightbox(currentLbIndex);
    }

    galleryItems.forEach((item, i) => {
        item.addEventListener('click', () => openLightbox(i));
    });

    if (lbClose) lbClose.addEventListener('click', closeLightbox);
    if (lbPrev) lbPrev.addEventListener('click', () => navigateLb(-1));
    if (lbNext) lbNext.addEventListener('click', () => navigateLb(1));

    if (lightbox) {
        lightbox.addEventListener('click', e => {
            if (e.target === lightbox) closeLightbox();
        });
    }

    document.addEventListener('keydown', e => {
        if (!lightbox?.classList.contains('open')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') navigateLb(-1);
        if (e.key === 'ArrowRight') navigateLb(1);
    });

    /* ----------------------------------------
       SCROLL REVEAL (lightweight IntersectionObserver)
    ---------------------------------------- */
    const revealEls = document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window && revealEls.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealEls.forEach(el => observer.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('revealed'));
    }

})();