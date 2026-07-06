(function () {
    'use strict';

    // ===== PRELOADER =====
    window.addEventListener('load', function () {
        var preloader = document.getElementById('preloader');
        if (preloader) {
            setTimeout(function () { preloader.classList.add('hidden'); }, 800);
        }
    });

    // ===== NAVBAR SCROLL =====
    var navbar = document.getElementById('mainNavbar');
    if (navbar) {
        window.addEventListener('scroll', function () {
            navbar.classList.toggle('scrolled', window.scrollY > 80);
        });
    }

    // ===== LANGUAGE DROPDOWN =====
    (function () {
        var t = document.getElementById('lang-toggle'),
            m = document.getElementById('lang-menu'),
            s = document.getElementById('lang-selector');
        if (!t || !m || !s) return;
        t.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            m.style.display = m.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function (e) {
            if (!s.contains(e.target) && m.style.display === 'block') m.style.display = 'none';
        });
    })();

    // ===== HERO SLIDER (Clean Crossfade) =====
    var slides = document.querySelectorAll('.hero-slide');
    var indicators = document.querySelectorAll('.slide-indicator');
    var currentSlide = 0, sliderInterval, sliderAnimating = false;

    function goToSlide(index) {
        if (index === currentSlide || sliderAnimating || slides.length < 2) return;
        sliderAnimating = true;
        var prev = slides[currentSlide], next = slides[index];
        next.style.opacity = '0';
        next.style.visibility = 'visible';
        next.style.zIndex = '2';
        next.classList.add('active');
        prev.classList.remove('active');
        prev.classList.add('fading-out');
        prev.style.zIndex = '1';
        requestAnimationFrame(function () { next.style.opacity = '1'; });
        setTimeout(function () {
            prev.style.opacity = '0';
            prev.style.visibility = 'hidden';
            prev.style.zIndex = '0';
            prev.classList.remove('fading-out');
            sliderAnimating = false;
        }, 1000);
        currentSlide = index;
        indicators.forEach(function (i) { i.classList.remove('active'); });
        if (indicators[currentSlide]) indicators[currentSlide].classList.add('active');
    }

    function nextHeroSlide() { goToSlide((currentSlide + 1) % slides.length); }
    function startSlider() { sliderInterval = setInterval(nextHeroSlide, 6000); }

    indicators.forEach(function (ind) {
        ind.addEventListener('click', function () {
            clearInterval(sliderInterval);
            goToSlide(parseInt(this.dataset.slide, 10));
            startSlider();
        });
    });

    if (slides.length > 0) startSlider();

    // ===== TRAINING TABS =====
    window.switchTrainingTab = function (el, tabId) {
        el.closest('.training-pills').querySelectorAll('.training-pill').forEach(function (p) { p.classList.remove('active'); });
        el.classList.add('active');
        el.closest('.row').querySelectorAll('.tab-pane').forEach(function (t) { t.classList.remove('active'); });
        var pane = document.getElementById(tabId);
        if (pane) pane.classList.add('active');
    };

    // ===== SCROLL REVEAL =====
    var revealObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) { if (entry.isIntersecting) entry.target.classList.add('visible'); });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal').forEach(function (el) { revealObserver.observe(el); });

    // ===== SUBTLE PARALLAX =====
    document.querySelectorAll('.hero-section, .page-hero').forEach(function (section) {
        section.addEventListener('mousemove', function (e) {
            var rect = section.getBoundingClientRect();
            var x = ((e.clientX - rect.left) / rect.width) - 0.5;
            var y = ((e.clientY - rect.top) / rect.height) - 0.5;
            var heroBg = section.querySelector('.page-hero-bg');
            if (heroBg) { heroBg.style.transform = 'scale(1.06) translate3d(' + (x * -16) + 'px,' + (y * -16) + 'px,0)'; }
            var heroImg = section.querySelector('.hero-slide.active img');
            if (heroImg) { heroImg.style.transform = 'scale(1.04) translate3d(' + (x * 10) + 'px,' + (y * 10) + 'px,0)'; }
        });
        section.addEventListener('mouseleave', function () {
            var heroBg = section.querySelector('.page-hero-bg');
            if (heroBg) { heroBg.style.transform = ''; }
            var heroImg = section.querySelector('.hero-slide.active img');
            if (heroImg) { heroImg.style.transform = ''; }
        });
    });

    // ===== CURSOR GLOW =====
    var cursorGlow = document.getElementById('cursorGlow');
    if (cursorGlow) {
        if (window.innerWidth > 1024) {
            document.addEventListener('mousemove', function (e) {
                cursorGlow.style.left = e.clientX + 'px';
                cursorGlow.style.top = e.clientY + 'px';
            });
        } else {
            cursorGlow.style.display = 'none';
        }
    }

    // ===== CONTACT FORM (client-side success message) =====
    window.handleContactSubmit = function (e) {
        e.preventDefault();
        var form = document.getElementById('contactForm');
        var success = document.getElementById('contactSuccess');
        if (form) form.style.display = 'none';
        if (success) success.style.display = 'block';
    };

})();
