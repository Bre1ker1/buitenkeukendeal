/**
 * script.js
 * Implementation of a smooth 3D tilt effect on hover for player cards.
 * No external libraries needed - Pure Vanilla JS for performance.
 */

document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('[data-tilt]');

    cards.forEach(card => {
        card.addEventListener('mousemove', handleMouseMove);
        card.addEventListener('mouseleave', handleMouseLeave);
        card.addEventListener('mouseenter', handleMouseEnter);
    });

    function handleMouseMove(e) {
        const card = this;
        const cardRect = card.getBoundingClientRect();

        // Calculate mouse position relative to card center (value between -1 and 1)
        const xVal = (e.clientX - cardRect.left) / cardRect.width;
        const yVal = (e.clientY - cardRect.top) / cardRect.height;

        const xOffset = -(xVal - 0.5) * 20; // max rotation degrees on X axis
        const yOffset = (yVal - 0.5) * 20;  // max rotation degrees on Y axis

        // Apply smooth 3D transform
        requestAnimationFrame(() => {
            card.style.transform = `perspective(1000px) rotateY(${xOffset}deg) rotateX(${yOffset}deg) translateY(-10px) scale(1.02)`;
        });
    }

    function handleMouseLeave() {
        const card = this;

        // Reset transform smoothly
        card.style.transition = 'transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        card.style.transform = `perspective(1000px) rotateY(0deg) rotateX(0deg) translateY(0px) scale(1)`;

        // Optional: add a subtle glow that fades out
        card.style.boxShadow = '';
        card.querySelector('.player-img').style.transform = 'scale(1)';
    }

    function handleMouseEnter() {
        const card = this;

        // Remove transition to allow smooth tracking of mouse
        card.style.transition = 'transform 0.1s ease-out';
    }

    // --- SENIOR EXTRAS: Scroll Reveal & Mobile Menu --- //

    // 1. Intersecion Observer for Scroll Reveal
    const revealElements = document.querySelectorAll('.reveal-on-scroll');
    const expandOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealOnScroll = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, expandOptions);

    revealElements.forEach(el => {
        revealOnScroll.observe(el);
    });

    // 2. Mobile Menu Toggle
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
});
