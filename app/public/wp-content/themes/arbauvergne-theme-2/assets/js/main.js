/**
 * Arb'Auvergne - Main JS
 * 
 * @package Arbauvergne
 */

document.addEventListener('DOMContentLoaded', function() {

    // ============================================
    // Menu mobile
    // ============================================
    const burger = document.getElementById('burger');
    const nav = document.getElementById('nav');
    const header = document.getElementById('header');

    if (burger && nav) {
        burger.addEventListener('click', function() {
            const isOpen = nav.classList.toggle('nav--open');
            burger.classList.toggle('header__burger--open');
            burger.setAttribute('aria-expanded', isOpen);
            document.body.classList.toggle('no-scroll', isOpen);
        });

        // Fermer le menu au clic sur un lien
        nav.querySelectorAll('.nav__link').forEach(function(link) {
            link.addEventListener('click', function() {
                nav.classList.remove('nav--open');
                burger.classList.remove('header__burger--open');
                burger.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('no-scroll');
            });
        });
    }

    // ============================================
    // Header sticky au scroll
    // ============================================
    if (header) {
        let lastScroll = 0;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                header.classList.add('header--scrolled');
            } else {
                header.classList.remove('header--scrolled');
            }

            lastScroll = currentScroll;
        }, { passive: true });
    }

    // ============================================
    // Smooth scroll pour les ancres
    // ============================================
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ============================================
    // Lazy load des images (fallback natif)
    // ============================================
    if ('loading' in HTMLImageElement.prototype) {
        document.querySelectorAll('img[loading="lazy"]').forEach(function(img) {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    }

    // ============================================
    // Animation au scroll (Intersection Observer)
    // ============================================
    const animatedElements = document.querySelectorAll('.service-card, .testimonial-card, .stats__item');

    if (animatedElements.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        animatedElements.forEach(function(el) {
            observer.observe(el);
        });
    }

    // ============================================
    // Dropdown menu desktop
    // ============================================
    const dropdowns = document.querySelectorAll('.nav__item--dropdown');

    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('mouseenter', function() {
            this.querySelector('.nav__dropdown').classList.add('nav__dropdown--open');
        });
        dropdown.addEventListener('mouseleave', function() {
            this.querySelector('.nav__dropdown').classList.remove('nav__dropdown--open');
        });
    });

});
