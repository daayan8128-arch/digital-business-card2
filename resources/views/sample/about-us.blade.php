@extends('mainsample.maintemplate')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    @endpush
    <div class="scrollable-content">
        {{-- Optimized Hero Banner Section with Reduced Spacing --}}
        <section class="hero-banner-section">
            <style>
                .scrollable-content {
                    height: 100vh;
                    overflow-y: auto;
                    overflow-x: hidden;
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                }

                .scrollable-content::-webkit-scrollbar {
                    display: none;
                }

                @media (max-width: 768px) {

                    .about-section,
                    .content-section,
                    .hero-banner-section {
                        max-width: 95% !important;
                        margin: 10px auto !important;
                        padding: 15px !important;
                        border-radius: 6px !important;
                    }

                    /* Founder / Business Card छोटा करो */
                    .founder-card {
                        width: 90% !important;
                        margin: 0 auto;
                        padding: 15px 20px !important;
                        font-size: 14px !important;
                    }

                    .sidebar {
                        width: 100% !important;
                        text-align: center !important;
                    }

                    .hero-container {
                        height: 45vh !important;
                        min-height: 250px !important;
                    }

                    .slide-title {
                        font-size: 1.8rem !important;
                    }

                    .slide-subtitle {
                        font-size: 0.9rem !important;
                    }
                }

                /* Add this style */
                /* .scrollable-content {
                                scrollbar-width: none;
                                -ms-overflow-style: none;
                            }

                            .scrollable-content::-webkit-scrollbar {
                                display: none;
                            } */

                .scrollable-content {
                    height: 1000px;
                    /* Set your desired height */
                    /* Optional: for nice look */
                    background: #e0e5ec;
                    border-radius: 8px;
                    box-sizing: border-box;
                }

                .hero-banner-section {
                    margin: 0 0 20px 0;
                    padding: 20px 10px;
                    box-sizing: border-box;
                    width: 90%;
                    position: relative;
                    background: #e0e5ec;
                    isolation: isolate;
                    overflow: visible;
                    border-radius: 8px;
                    margin-left: 40px;
                }

                .hero-banner-section * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                .hero-wrapper {
                    max-width: 1200px;
                    margin: 0 auto;
                    position: relative;
                    z-index: 1;
                }

                .hero-container {
                    position: relative;
                    width: 100%;
                    height: 65vh;
                    max-height: 500px;
                    min-height: 350px;
                    overflow: hidden;
                    background: #000;
                    cursor: grab;
                    user-select: none;
                    display: block;
                    line-height: 0;
                    border-radius: 20px;
                    box-shadow:
                        0 20px 40px -10px rgba(0, 0, 0, 0.2),
                        0 0 0 1px rgba(255, 255, 255, 0.1),
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
                    backdrop-filter: blur(8px);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                }

                .hero-container:active {
                    cursor: grabbing;
                }

                .hero-container::before {
                    content: '';
                    position: absolute;
                    top: -2px;
                    left: -2px;
                    right: -2px;
                    bottom: -2px;
                    background: linear-gradient(45deg,
                            #007bff, #00d4ff, #0056b3, #007bff);
                    border-radius: 22px;
                    z-index: -1;
                    opacity: 0.6;
                    animation: borderGlow 3s ease-in-out infinite alternate;
                }

                @keyframes borderGlow {
                    0% {
                        opacity: 0.3;
                    }

                    100% {
                        opacity: 0.8;
                    }
                }

                .hero-slider {
                    display: flex;
                    width: 500%;
                    height: 100%;
                    transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                    line-height: 0;
                }

                .hero-slide {
                    width: 20%;
                    height: 100%;
                    position: relative;
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    flex-shrink: 0;
                    display: block;
                    filter: brightness(0.9) contrast(1.1);
                }

                .hero-slide::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(135deg,
                            rgba(0, 123, 255, 0.1) 0%,
                            rgba(0, 0, 0, 0.4) 50%,
                            rgba(0, 0, 0, 0.7) 100%);
                    z-index: 1;
                }

                .slide-content {
                    position: absolute;
                    bottom: 12%;
                    left: 40px;
                    color: white;
                    z-index: 2;
                    animation: slideInUp 1s ease-out;
                    max-width: 65%;
                    transform-origin: left bottom;
                }

                @keyframes slideInUp {
                    0% {
                        opacity: 0;
                        transform: translateY(50px) scale(0.9);
                    }

                    100% {
                        opacity: 1;
                        transform: translateY(0) scale(1);
                    }
                }

                .slide-title {
                    font-size: 3rem;
                    font-weight: 800;
                    margin-bottom: 0.8rem;
                    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
                    line-height: 1.1;
                    background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 50%, #bbdefb 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    letter-spacing: -0.02em;
                    position: relative;
                }

                .slide-title::after {
                    content: '';
                    position: absolute;
                    bottom: -8px;
                    left: 0;
                    width: 70px;
                    height: 3px;
                    background: linear-gradient(90deg, #007bff, #00d4ff);
                    border-radius: 2px;
                    box-shadow: 0 0 15px rgba(0, 123, 255, 0.5);
                }

                .slide-subtitle {
                    font-size: 1.1rem;
                    opacity: 0.95;
                    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
                    line-height: 1.5;
                    color: #f8fafc;
                    font-weight: 400;
                    letter-spacing: 0.01em;
                }

                .hero-nav {
                    position: absolute;
                    top: 50%;
                    transform: translateY(-50%);
                    background: rgba(255, 255, 255, 0.1);
                    border: 2px solid rgba(255, 255, 255, 0.2);
                    color: white;
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    z-index: 5;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.3rem;
                    backdrop-filter: blur(15px);
                    box-shadow:
                        0 6px 20px rgba(0, 0, 0, 0.2),
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
                    font-weight: bold;
                }

                .hero-nav:hover {
                    background: rgba(255, 255, 255, 0.2);
                    border-color: rgba(255, 255, 255, 0.5);
                    transform: translateY(-50%) scale(1.1);
                    box-shadow:
                        0 8px 25px rgba(0, 0, 0, 0.3),
                        0 0 20px rgba(0, 123, 255, 0.2);
                    color: #007bff;
                }

                .hero-prev {
                    left: 20px;
                }

                .hero-next {
                    right: 20px;
                }

                .hero-indicators {
                    position: absolute;
                    bottom: 20px;
                    left: 50%;
                    transform: translateX(-50%);
                    display: flex;
                    gap: 12px;
                    z-index: 5;
                    background: rgba(0, 0, 0, 0.3);
                    padding: 8px 16px;
                    border-radius: 20px;
                    backdrop-filter: blur(15px);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                }

                .indicator {
                    width: 10px;
                    height: 10px;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.4);
                    cursor: pointer;
                    transition: all 0.3s ease;
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    position: relative;
                    overflow: hidden;
                }

                .indicator::before {
                    content: '';
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 0;
                    height: 0;
                    background: radial-gradient(circle, #007bff, #00d4ff);
                    border-radius: 50%;
                    transform: translate(-50%, -50%);
                    transition: all 0.3s ease;
                }

                .indicator.active {
                    background: linear-gradient(45deg, #007bff, #00d4ff);
                    transform: scale(1.2);
                    box-shadow:
                        0 0 15px rgba(0, 123, 255, 0.5),
                        0 0 30px rgba(0, 123, 255, 0.2);
                    border-color: rgba(255, 255, 255, 0.7);
                }

                .indicator.active::before {
                    width: 100%;
                    height: 100%;
                }

                .hero-progress {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    height: 3px;
                    background: linear-gradient(90deg, #007bff 0%, #00d4ff 50%, #0056b3 100%);
                    transition: width 0.1s linear;
                    z-index: 2;
                    box-shadow:
                        0 0 10px rgba(0, 123, 255, 0.5),
                        0 -1px 5px rgba(0, 123, 255, 0.2);
                    border-radius: 0 0 20px 20px;
                    position: relative;
                }

                .hero-progress::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                    animation: shimmer 2s infinite;
                }

                @keyframes shimmer {
                    0% {
                        transform: translateX(-100%);
                    }

                    100% {
                        transform: translateX(100%);
                    }
                }

                /* Responsive Adjustments */
                @media (max-width: 1024px) {
                    .hero-banner-section {
                        padding: 15px 10px 25px 10px;
                    }

                    .hero-container {
                        height: 55vh;
                        max-height: 450px;
                        border-radius: 18px;
                    }

                    .slide-title {
                        font-size: 2.5rem;
                    }

                    .slide-content {
                        left: 35px;
                        max-width: 70%;
                    }
                }

                @media (max-width: 768px) {
                    .hero-banner-section {
                        padding: 10px 5px 20px 5px;
                    }

                    .hero-container {
                        height: 50vh;
                        max-height: 400px;
                        min-height: 300px;
                        border-radius: 16px;
                    }

                    .slide-title {
                        font-size: 2.2rem;
                    }

                    .slide-subtitle {
                        font-size: 1rem;
                    }

                    .slide-content {
                        left: 30px;
                        bottom: 10%;
                        max-width: 75%;
                    }

                    .hero-nav {
                        width: 45px;
                        height: 45px;
                        font-size: 1.2rem;
                    }

                    .hero-indicators {
                        gap: 10px;
                        padding: 6px 14px;
                    }
                }

                @media (max-width: 480px) {
                    .hero-banner-section {
                        padding: 8px 5px 15px 5px;
                    }

                    .hero-container {
                        height: 45vh;
                        max-height: 350px;
                        min-height: 250px;
                        border-radius: 14px;
                    }

                    .slide-title {
                        font-size: 1.8rem;
                    }

                    .slide-subtitle {
                        font-size: 0.9rem;
                    }

                    .slide-content {
                        left: 20px;
                        bottom: 8%;
                        max-width: 80%;
                    }

                    .hero-nav {
                        width: 40px;
                        height: 40px;
                        font-size: 1.1rem;
                    }

                    .hero-indicators {
                        bottom: 15px;
                        gap: 8px;
                        padding: 5px 12px;
                    }

                    .indicator {
                        width: 8px;
                        height: 8px;
                    }
                }

                /* Dark mode support */
                @media (prefers-color-scheme: dark) {
                    .hero-banner-section {
                        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
                    }
                }

                /* Reduced motion support */
                @media (prefers-reduced-motion: reduce) {
                    .hero-slider {
                        transition: none;
                    }

                    .slide-content {
                        animation: none;
                    }

                    .hero-nav {
                        transition: none;
                    }

                    .indicator {
                        transition: none;
                    }

                    @keyframes borderGlow,
                    @keyframes shimmer {

                        0%,
                        100% {
                            opacity: 0.5;
                        }
                    }
                }
            </style>

            <div class="hero-wrapper">
                <div class="hero-container" id="heroContainer">
                    <div class="hero-slider" id="heroSlider">
                        <div class="hero-slide"
                            style="background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                            <div class="slide-content">
                                <h1 class="slide-title">Modern Office Spaces</h1>
                                <p class="slide-subtitle">Creating productive work environments that inspire innovation and
                                    foster collaboration among teams worldwide</p>
                            </div>
                        </div>

                        <div class="hero-slide"
                            style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                            <div class="slide-content">
                                <h1 class="slide-title">Innovation Hub</h1>
                                <p class="slide-subtitle">Where groundbreaking ideas come to life through cutting-edge
                                    technology and creative thinking</p>
                            </div>
                        </div>

                        <div class="hero-slide"
                            style="background-image: url('https://images.unsplash.com/photo-1497366811353-6870744d04b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                            <div class="slide-content">
                                <h1 class="slide-title">Creative Solutions</h1>
                                <p class="slide-subtitle">Transforming business challenges into opportunities through
                                    innovative
                                    design and strategic thinking</p>
                            </div>
                        </div>

                        <div class="hero-slide"
                            style="background-image: url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                            <div class="slide-content">
                                <h1 class="slide-title">Future Ready</h1>
                                <p class="slide-subtitle">Building tomorrow's workspace today with sustainable practices and
                                    forward-thinking solutions</p>
                            </div>
                        </div>

                        <div class="hero-slide"
                            style="background-image: url('https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
                            <div class="slide-content">
                                <h1 class="slide-title">Digital Excellence</h1>
                                <p class="slide-subtitle">Leading the digital transformation with advanced technology and
                                    seamless user experiences</p>
                            </div>
                        </div>
                    </div>

                    <button class="hero-nav hero-prev" id="prevBtn" aria-label="Previous slide">‹</button>
                    <button class="hero-nav hero-next" id="nextBtn" aria-label="Next slide">›</button>

                    <div class="hero-indicators" id="indicators">
                        <span class="indicator active" data-slide="0" aria-label="Slide 1"></span>
                        <span class="indicator" data-slide="1" aria-label="Slide 2"></span>
                        <span class="indicator" data-slide="2" aria-label="Slide 3"></span>
                        <span class="indicator" data-slide="3" aria-label="Slide 4"></span>
                        <span class="indicator" data-slide="4" aria-label="Slide 5"></span>
                    </div>

                    <div class="hero-progress" id="progressBar"></div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    class EnhancedHeroBanner {
                        constructor() {
                            this.slider = document.getElementById('heroSlider');
                            this.container = document.getElementById('heroContainer');
                            this.prevBtn = document.getElementById('prevBtn');
                            this.nextBtn = document.getElementById('nextBtn');
                            this.indicators = document.querySelectorAll('.indicator');
                            this.progressBar = document.getElementById('progressBar');

                            this.currentSlide = 0;
                            this.totalSlides = 5;
                            this.autoSlideInterval = null;
                            this.autoSlideDelay = 6000;
                            this.progressInterval = null;
                            this.progressValue = 0;

                            this.isDragging = false;
                            this.startX = 0;
                            this.currentX = 0;
                            this.threshold = 80;
                            this.isAnimating = false;
                            this.isHovered = false;

                            this.init();
                        }

                        init() {
                            this.setupEventListeners();
                            this.updateSlide();
                            this.preloadImages();

                            setTimeout(() => {
                                this.startAutoSlide();
                            }, 2000);
                        }

                        preloadImages() {
                            const slides = this.container.querySelectorAll('.hero-slide');
                            slides.forEach(slide => {
                                const bgImage = slide.style.backgroundImage;
                                if (bgImage) {
                                    const imageUrl = bgImage.slice(5, -2);
                                    const img = new Image();
                                    img.src = imageUrl;
                                }
                            });
                        }

                        setupEventListeners() {
                            this.prevBtn.addEventListener('click', (e) => {
                                e.preventDefault();
                                e.stopPropagation();
                                this.prevSlide();
                            });

                            this.nextBtn.addEventListener('click', (e) => {
                                e.preventDefault();
                                e.stopPropagation();
                                this.nextSlide();
                            });

                            this.indicators.forEach((indicator, index) => {
                                indicator.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    this.goToSlide(index);
                                });
                            });

                            this.container.addEventListener('mousedown', (e) => {
                                e.stopPropagation();
                                this.startDrag(e);
                            });
                            this.container.addEventListener('mousemove', (e) => {
                                e.stopPropagation();
                                this.drag(e);
                            });
                            this.container.addEventListener('mouseup', (e) => {
                                e.stopPropagation();
                                this.endDrag();
                            });
                            this.container.addEventListener('mouseleave', (e) => {
                                e.stopPropagation();
                                this.endDrag();
                            });

                            this.container.addEventListener('touchstart', (e) => {
                                e.stopPropagation();
                                this.startDrag(e);
                            }, { passive: false });
                            this.container.addEventListener('touchmove', (e) => {
                                e.stopPropagation();
                                this.drag(e);
                            }, { passive: false });
                            this.container.addEventListener('touchend', (e) => {
                                e.stopPropagation();
                                this.endDrag();
                            });

                            this.container.addEventListener('mouseenter', () => {
                                this.isHovered = true;
                                this.pauseAutoSlide();
                            });

                            this.container.addEventListener('mouseleave', () => {
                                this.isHovered = false;
                                this.resumeAutoSlide();
                            });

                            this.container.addEventListener('keydown', (e) => {
                                if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    this.prevSlide();
                                }
                                if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    this.nextSlide();
                                }
                                if (e.key === 'Home') {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    this.goToSlide(0);
                                }
                                if (e.key === 'End') {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    this.goToSlide(this.totalSlides - 1);
                                }
                            });

                            document.addEventListener('visibilitychange', () => {
                                if (document.hidden) {
                                    this.pauseAutoSlide();
                                } else if (!this.isHovered) {
                                    this.resumeAutoSlide();
                                }
                            });

                            window.addEventListener('focus', () => {
                                if (!this.isHovered) this.resumeAutoSlide();
                            });

                            window.addEventListener('blur', () => {
                                this.pauseAutoSlide();
                            });
                        }

                        startDrag(e) {
                            if (this.isAnimating) return;

                            this.isDragging = true;
                            this.startX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
                            this.currentX = this.startX;
                            this.container.style.cursor = 'grabbing';
                            this.pauseAutoSlide();

                            if (e.type.includes('touch')) {
                                e.preventDefault();
                            }
                        }

                        drag(e) {
                            if (!this.isDragging || this.isAnimating) return;

                            this.currentX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;

                            if (e.type.includes('touch')) {
                                e.preventDefault();
                            }
                        }

                        endDrag() {
                            if (!this.isDragging) return;

                            this.isDragging = false;
                            this.container.style.cursor = 'grab';

                            const deltaX = this.currentX - this.startX;

                            if (Math.abs(deltaX) > this.threshold) {
                                if (deltaX > 0) {
                                    this.prevSlide();
                                } else {
                                    this.nextSlide();
                                }
                            }

                            setTimeout(() => {
                                if (!this.isHovered) this.resumeAutoSlide();
                            }, 500);
                        }

                        updateSlide() {
                            if (this.isAnimating) return;

                            this.isAnimating = true;
                            const translateX = -this.currentSlide * 20;
                            this.slider.style.transform = `translateX(${translateX}%)`;
                            this.updateIndicators();

                            setTimeout(() => {
                                this.isAnimating = false;
                            }, 800);
                        }

                        updateIndicators() {
                            this.indicators.forEach((indicator, index) => {
                                indicator.classList.toggle('active', index === this.currentSlide);
                            });
                        }

                        nextSlide() {
                            if (this.isAnimating) return;

                            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                            this.updateSlide();
                            this.resetProgress();
                        }

                        prevSlide() {
                            if (this.isAnimating) return;

                            this.currentSlide = this.currentSlide === 0 ? this.totalSlides - 1 : this.currentSlide - 1;
                            this.updateSlide();
                            this.resetProgress();
                        }

                        goToSlide(index) {
                            if (this.isAnimating || index === this.currentSlide) return;

                            this.currentSlide = index;
                            this.updateSlide();
                            this.resetProgress();
                        }

                        startAutoSlide() {
                            this.clearAutoSlide();
                            this.autoSlideInterval = setInterval(() => {
                                if (!this.isDragging && !this.isAnimating && !document.hidden && !this.isHovered) {
                                    this.nextSlide();
                                }
                            }, this.autoSlideDelay);
                            this.startProgress();
                        }

                        pauseAutoSlide() {
                            this.clearAutoSlide();
                            this.pauseProgress();
                        }

                        resumeAutoSlide() {
                            if (!this.isDragging && !document.hidden && !this.isHovered) {
                                setTimeout(() => {
                                    this.startAutoSlide();
                                }, 300);
                            }
                        }

                        clearAutoSlide() {
                            if (this.autoSlideInterval) {
                                clearInterval(this.autoSlideInterval);
                                this.autoSlideInterval = null;
                            }
                        }

                        startProgress() {
                            this.progressValue = 0;
                            this.pauseProgress();

                            this.progressInterval = setInterval(() => {
                                if (!this.isDragging && !document.hidden && !this.isHovered) {
                                    this.progressValue += (100 / (this.autoSlideDelay / 50));
                                    if (this.progressValue >= 100) {
                                        this.progressValue = 100;
                                    }
                                    this.progressBar.style.width = this.progressValue + '%';
                                }
                            }, 50);
                        }

                        pauseProgress() {
                            if (this.progressInterval) {
                                clearInterval(this.progressInterval);
                                this.progressInterval = null;
                            }
                        }

                        resetProgress() {
                            this.progressValue = 0;
                            this.progressBar.style.width = '0%';
                            this.pauseProgress();

                            setTimeout(() => {
                                if (this.autoSlideInterval) {
                                    this.startProgress();
                                }
                            }, 200);
                        }
                    }

                    if (document.getElementById('heroContainer')) {
                        new EnhancedHeroBanner();
                    }
                });
            </script>
        </section>


        {{-- Additional content sections --}}
        <style>
            .content-section {
                padding: 20px 10px;
                background: #e0e5ec;
                border-radius: 8px;
                box-sizing: border-box;
                isolation: isolate;
            }

            .content-wrapper {
                max-width: 1200px;
                margin: 0 auto;
                width: 100%;
            }
        </style>
        <section class="content-section">

            <section class="about-section">
                <div class="container">
                    <h1>ABOUT US</h1>

                    <div class="about-content">
                        <p>Shree Gayatri Impression is a full-service printing and design solutions provider with over two
                            decades of experience in the industry. We combine traditional craftsmanship with cutting-edge
                            technology to deliver exceptional print products that make your brand stand out.</p>

                        <p>Since our founding in 2003, we have been empowering businesses across Gujarat with innovative
                            printing solutions, serving clients from diverse sectors including corporate, education,
                            healthcare, retail, and government organizations.</p>
                    </div>

                    <h2>A company that brings your vision to life</h2>

                    <div class="vision-content">
                        <p>We believe successful companies need a collaborator who delivers excellent design thinking
                            solutions aligned with the vision of the organization. We win you by providing the right design
                            - Print recommendation, which can take your brand to new heights</p>



                        <div class="mission-statement">
                            <p>Creating productive work environments that inspire innovation and foster collaboration among
                                teams worldwide</p>
                        </div>

                    </div>

                    <style>
                        .about-section {

                            max-width: 1200px;
                            margin: 10px 30px;
                            padding: 40px 20px;
                            font-family: 'Arial', sans-serif;
                            color: #333;
                            line-height: 1.6;
                            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
                            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                            border-radius: 10px;
                        }

                        .about-section h1 {
                            font-size: 32px;
                            color: #2c3e50;
                            margin-bottom: 25px;
                            text-align: center;
                            text-transform: uppercase;
                            position: relative;
                            padding-bottom: 10px;
                        }

                        .about-section h1::after {
                            content: '';
                            position: absolute;
                            bottom: 0;
                            left: 50%;
                            transform: translateX(-50%);
                            width: 100px;
                            height: 3px;
                            background: linear-gradient(90deg, #007bff, #00d4ff);
                        }

                        .about-section h2 {
                            font-size: 24px;
                            color: #2c3e50;
                            margin: 35px 0 20px;
                            padding-bottom: 8px;
                            border-bottom: 2px solid #eaeaea;
                            position: relative;
                        }

                        .about-section h2::after {
                            content: '';
                            position: absolute;
                            bottom: -2px;
                            left: 0;
                            width: 100px;
                            height: 2px;
                            background: linear-gradient(90deg, #007bff, #00d4ff);
                        }

                        .about-content,
                        .vision-content {
                            margin-bottom: 35px;
                        }

                        .about-section p {
                            margin-bottom: 18px;
                            text-align: justify;
                            font-size: 16px;
                            color: #555;
                        }

                        .founder-section {
                            margin: 30px 0;
                            text-align: center;
                        }

                        .founder-card {
                            display: inline-block;
                            padding: 20px 40px;
                            border: 2px solid #007bff;
                            border-radius: 8px;
                            background: rgba(0, 123, 255, 0.05);
                        }

                        .founder-card h3 {
                            font-size: 20px;
                            color: #2c3e50;
                            margin-bottom: 5px;
                        }

                        .founder-card p {
                            font-size: 16px;
                            color: #007bff;
                            font-weight: 500;
                            margin: 0;
                        }

                        .mission-statement {
                            font-style: italic;
                            font-size: 18px;
                            text-align: center;
                            margin: 30px 0;
                            color: #555;
                            padding: 15px;
                            background: #f8f9fa;
                            border-left: 4px solid #007bff;
                        }

                        .combination-section {
                            margin: 30px 0;
                        }

                        .combination-section h3 {
                            font-size: 18px;
                            color: #2c3e50;
                            margin-bottom: 15px;
                            text-align: center;
                        }

                        .combination-list {
                            display: flex;
                            justify-content: center;
                            gap: 20px;
                            list-style: none;
                            padding: 0;
                            flex-wrap: wrap;
                        }

                        .combination-list li {
                            padding: 10px 20px;
                            background: #f8f9fa;
                            border-radius: 5px;
                            font-weight: 600;
                            color: #007bff;
                        }

                        .quick-links {
                            margin-top: 40px;
                            padding-top: 20px;
                            border-top: 1px solid #eee;
                        }

                        .quick-links h3 {
                            font-size: 20px;
                            color: #2c3e50;
                            margin-bottom: 15px;
                        }

                        .quick-links ul {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 15px;
                            list-style: none;
                            padding: 0;
                        }

                        .quick-links li {
                            padding: 8px 15px;
                            background: #f8f9fa;
                            border-radius: 5px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        }

                        .quick-links li:hover {
                            background: #007bff;
                            color: white;
                        }

                        @media (max-width: 768px) {
                            .about-section {
                                padding: 30px 15px;
                                margin: 30px auto;
                            }

                            .about-section h1 {
                                font-size: 28px;
                            }

                            .about-section h2 {
                                font-size: 22px;
                                margin: 30px 0 15px;
                            }

                            .about-section p {
                                font-size: 15px;
                            }

                            .founder-card {
                                padding: 15px 30px;
                            }

                            .mission-statement {
                                font-size: 16px;
                            }

                            .combination-list {
                                gap: 10px;
                            }

                            .combination-list li {
                                padding: 8px 15px;
                                font-size: 14px;
                            }

                            .quick-links ul {
                                gap: 10px;
                            }

                            .quick-links li {
                                padding: 6px 12px;
                                font-size: 14px;
                            }
                        }

                        @media (max-width: 480px) {
                            .about-section {
                                padding: 25px 10px;
                                margin: 25px auto;
                            }

                            .about-section h1 {
                                font-size: 24px;
                            }

                            .about-section h2 {
                                font-size: 20px;
                            }

                            .combination-list {
                                flex-direction: column;
                                align-items: center;
                                gap: 8px;
                            }

                            .quick-links ul {
                                flex-direction: column;
                                gap: 8px;
                            }
                        }
                    </style>
            </section>
            <section class="proud-associate-section">
                <style>
                    .proud-associate-section {
                        background: whitesmoke;
                        padding: 40px 20px;
                        max-width: 735px;
                        margin: 30px auto;
                        border-radius: 8px;
                        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
                        overflow: hidden;
                    }

                    .section-title {
                        text-align: center;
                        font-size: 2rem;
                        color: #2c3e50;
                        margin-bottom: 30px;
                        position: relative;
                        padding-bottom: 10px;
                    }

                    .section-title::after {
                        content: '';
                        position: absolute;
                        bottom: 0;
                        left: 50%;
                        transform: translateX(-50%);
                        width: 80px;
                        height: 3px;
                        background: linear-gradient(90deg, #007bff, #00d4ff);
                    }

                    .logos-container {
                        position: relative;
                        width: 100%;
                        overflow: hidden;
                        padding: 20px 0;
                        cursor: grab;
                    }

                    .logos-container:active {
                        cursor: grabbing;
                    }

                    .logos-scroll {
                        display: flex;
                        gap: 40px;
                        align-items: center;
                        padding: 0 20px;
                        user-select: none;
                        width: max-content;
                        transform: translateX(0);
                    }

                    .logo-item {
                        flex-shrink: 0;
                        width: 150px;
                        height: 100px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #ffffff;
                        border-radius: 8px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                        transition: all 0.3s ease;
                        padding: 15px;
                    }

                    .logo-item img {
                        max-width: 100%;
                        max-height: 100%;
                        object-fit: contain;
                        filter: grayscale(30%);
                        transition: filter 0.3s ease;
                    }

                    .logo-item:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                    }

                    .logo-item:hover img {
                        filter: grayscale(0%);
                    }

                    @media (max-width: 768px) {
                        .section-title {
                            font-size: 1.5rem;
                        }

                        .logo-item {
                            width: 120px;
                            height: 80px;
                        }

                        .logos-scroll {
                            gap: 30px;
                        }
                    }

                    @media (max-width: 480px) {
                        .proud-associate-section {
                            padding: 30px 15px;
                        }

                        .section-title {
                            font-size: 1.3rem;
                        }

                        .logo-item {
                            width: 100px;
                            height: 70px;
                            padding: 10px;
                        }
                    }
                </style>

                <h2 class="section-title">Our Valued Partners</h2>

                <div class="logos-container" id="logosContainer">
                    <div class="logos-scroll" id="logosScroll">
                        <!-- First set of logos -->
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1200px-Google_%22G%22_Logo.svg.png"
                                alt="Google" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Microsoft_logo.svg/1200px-Microsoft_logo.svg.png"
                                alt="Microsoft" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/1200px-Amazon_logo.svg.png"
                                alt="Amazon" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Apple_logo_black.svg/1200px-Apple_logo_black.svg.png"
                                alt="Apple" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Tesla_Motors.svg/1200px-Tesla_Motors.svg.png"
                                alt="Tesla" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Oracle_logo.svg/1200px-Oracle_logo.svg.png"
                                alt="Oracle" loading="lazy">
                        </div>

                        <!-- Duplicate set for seamless loop -->
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1200px-Google_%22G%22_Logo.svg.png"
                                alt="Google" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Microsoft_logo.svg/1200px-Microsoft_logo.svg.png"
                                alt="Microsoft" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/1200px-Amazon_logo.svg.png"
                                alt="Amazon" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Apple_logo_black.svg/1200px-Apple_logo_black.svg.png"
                                alt="Apple" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Tesla_Motors.svg/1200px-Tesla_Motors.svg.png"
                                alt="Tesla" loading="lazy">
                        </div>
                        <div class="logo-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Oracle_logo.svg/1200px-Oracle_logo.svg.png"
                                alt="Oracle" loading="lazy">
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const container = document.getElementById('logosContainer');
                        const scroll = document.getElementById('logosScroll');
                        let isDown = false;
                        let startX;
                        let scrollLeft;
                        let animationId;
                        let position = 0;
                        let isHovered = false;
                        const speed = 1;
                        const logos = document.querySelectorAll('.logo-item');
                        const logoWidth = logos[0].offsetWidth + 40; // width + gap

                        // Auto-scroll animation
                        function autoScroll() {
                            if (!isHovered && !isDown) {
                                position -= speed;

                                // Reset position when scrolled all logos
                                if (-position >= logoWidth * (logos.length / 2)) {
                                    position = 0;
                                }

                                scroll.style.transform = `translateX(${position}px)`;
                            }
                            animationId = requestAnimationFrame(autoScroll);
                        }

                        // Start auto-scroll
                        autoScroll();

                        // Mouse enter - pause auto-scroll
                        container.addEventListener('mouseenter', () => {
                            isHovered = true;
                        });

                        // Mouse leave - resume auto-scroll
                        container.addEventListener('mouseleave', () => {
                            isHovered = false;
                        });

                        // Mouse down - prepare for drag
                        container.addEventListener('mousedown', (e) => {
                            isDown = true;
                            startX = e.pageX - container.offsetLeft;
                            scrollLeft = position;
                            container.style.cursor = 'grabbing';
                        });

                        // Mouse leave - end drag
                        container.addEventListener('mouseleave', () => {
                            isDown = false;
                        });

                        // Mouse up - end drag
                        container.addEventListener('mouseup', () => {
                            isDown = false;
                            container.style.cursor = 'grab';
                        });

                        // Mouse move - handle drag
                        container.addEventListener('mousemove', (e) => {
                            if (!isDown) return;
                            e.preventDefault();
                            const x = e.pageX - container.offsetLeft;
                            const walk = (x - startX) * 2; // scroll-fast
                            position = scrollLeft - walk;
                            scroll.style.transform = `translateX(${position}px)`;
                        });

                        // Touch events for mobile
                        container.addEventListener('touchstart', (e) => {
                            isDown = true;
                            startX = e.touches[0].pageX - container.offsetLeft;
                            scrollLeft = position;
                            isHovered = true;
                        }, { passive: false });

                        container.addEventListener('touchmove', (e) => {
                            if (!isDown) return;
                            e.preventDefault();
                            const x = e.touches[0].pageX - container.offsetLeft;
                            const walk = (x - startX) * 2;
                            position = scrollLeft - walk;
                            scroll.style.transform = `translateX(${position}px)`;
                        }, { passive: false });

                        container.addEventListener('touchend', () => {
                            isDown = false;
                            isHovered = false;
                        });

                        // Clean up animation on unmount
                        window.addEventListener('beforeunload', () => {
                            cancelAnimationFrame(animationId);
                        });
                    });
                </script>
            </section>
            <section class="testimonials-section">
                <style>
                    .testimonials-section {
                        background: #e0e5ec;
                        padding: 4rem 1rem;
                        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                    }

                    .testimonials-container {
                        max-width: 735px;
                        margin: 0 auto;
                    }

                    .section-header {
                        text-align: center;
                        margin-bottom: 3rem;
                    }

                    .section-subtitle {
                        color: #007bff;
                        font-size: 0.9rem;
                        font-weight: 600;
                        margin-bottom: 0.5rem;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                    }

                    .section-title {
                        color: #1e293b;
                        font-size: 2rem;
                        font-weight: 700;
                        margin-bottom: 1rem;
                        line-height: 1.3;
                    }

                    .testimonials-slider {
                        position: relative;
                        overflow: hidden;
                        border-radius: 12px;
                        background: white;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                    }

                    .testimonials-track {
                        display: flex;
                        transition: transform 0.4s ease;
                    }

                    .testimonial-card {
                        flex: 0 0 100%;
                        padding: 2.5rem;
                        box-sizing: border-box;
                    }

                    .rating {
                        color: #ffc107;
                        font-size: 1.1rem;
                        margin-bottom: 1.2rem;
                    }

                    .testimonial-text {
                        color: #475569;
                        font-size: 1.05rem;
                        line-height: 1.7;
                        margin-bottom: 1.8rem;
                        font-weight: 400;
                    }

                    .client-info {
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                    }

                    .client-avatar {
                        width: 3.5rem;
                        height: 3.5rem;
                        border-radius: 50%;
                        overflow: hidden;
                        border: 2px solid rgba(0, 123, 255, 0.1);
                    }

                    .client-avatar img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .client-details h4 {
                        color: #1e293b;
                        font-size: 1rem;
                        font-weight: 600;
                        margin-bottom: 0.2rem;
                    }

                    .client-details p {
                        color: #64748b;
                        font-size: 0.85rem;
                    }

                    .slider-nav {
                        display: flex;
                        justify-content: center;
                        margin-top: 2rem;
                        gap: 0.5rem;
                    }

                    .slider-dot {
                        width: 10px;
                        height: 10px;
                        border-radius: 50%;
                        background: #cbd5e1;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .slider-dot.active {
                        background: #007bff;
                        transform: scale(1.2);
                    }

                    @media (max-width: 768px) {
                        .testimonials-section {
                            padding: 3rem 1rem;
                        }

                        .section-title {
                            font-size: 1.7rem;
                        }

                        .testimonial-card {
                            padding: 2rem 1.5rem;
                        }

                        .testimonial-text {
                            font-size: 1rem;
                        }
                    }

                    @media (max-width: 480px) {
                        .section-title {
                            font-size: 1.5rem;
                        }

                        .testimonial-card {
                            padding: 1.8rem 1.2rem;
                        }

                        .client-avatar {
                            width: 3rem;
                            height: 3rem;
                        }
                    }
                </style>

                <div class="testimonials-container">
                    <div class="section-header">
                        <p class="section-subtitle">Client Feedback</p>
                        <h2 class="section-title">What Our Clients Say</h2>
                    </div>

                    <div class="testimonials-slider" id="testimonialsSlider">
                        <div class="testimonials-track" id="testimonialsTrack">
                            <!-- Testimonial 1 -->
                            <div class="testimonial-card">
                                <div class="rating">★★★★★</div>
                                <p class="testimonial-text">
                                    "Working with this team transformed our digital presence. Their technical expertise
                                    and creative solutions delivered a platform that increased our customer engagement
                                    by 150% within the first month."
                                </p>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Sarah Johnson"
                                            loading="lazy">
                                    </div>
                                    <div class="client-details">
                                        <h4>Sarah Johnson</h4>
                                        <p>Marketing Director, TechNova</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 2 -->
                            <div class="testimonial-card">
                                <div class="rating">★★★★★</div>
                                <p class="testimonial-text">
                                    "The team delivered our e-commerce platform two weeks ahead of schedule with
                                    flawless functionality. Their attention to detail and post-launch support has been
                                    exceptional."
                                </p>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen"
                                            loading="lazy">
                                    </div>
                                    <div class="client-details">
                                        <h4>Michael Chen</h4>
                                        <p>CEO, UrbanStyle</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 3 -->
                            <div class="testimonial-card">
                                <div class="rating">★★★★☆</div>
                                <p class="testimonial-text">
                                    "As a startup, we needed a partner who could understand our vision and execute
                                    quickly. They not only delivered but provided strategic insights that shaped our
                                    product roadmap."
                                </p>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Priya Patel"
                                            loading="lazy">
                                    </div>
                                    <div class="client-details">
                                        <h4>Priya Patel</h4>
                                        <p>Founder, GreenStart</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 4 -->
                            <div class="testimonial-card">
                                <div class="rating">★★★★★</div>
                                <p class="testimonial-text">
                                    "Their mobile app development expertise helped us reach new customers and increase our
                                    sales by 80%. The team was professional, responsive, and delivered beyond our
                                    expectations."
                                </p>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="David Wilson"
                                            loading="lazy">
                                    </div>
                                    <div class="client-details">
                                        <h4>David Wilson</h4>
                                        <p>CTO, RetailPlus</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 5 -->
                            <div class="testimonial-card">
                                <div class="rating">★★★★☆</div>
                                <p class="testimonial-text">
                                    "The website redesign project was completed on time and within budget. Their team
                                    communicated clearly throughout the process and implemented all our feedback promptly."
                                </p>
                                <div class="client-info">
                                    <div class="client-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Emily Rodriguez"
                                            loading="lazy">
                                    </div>
                                    <div class="client-details">
                                        <h4>Emily Rodriguez</h4>
                                        <p>Digital Manager, HealthFirst</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slider-nav" id="sliderDots">
                        <!-- Dots will be added by JavaScript -->
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const track = document.getElementById('testimonialsTrack');
                        const slides = document.querySelectorAll('.testimonial-card');
                        const dotsContainer = document.getElementById('sliderDots');
                        let autoScrollInterval;
                        let currentIndex = 0;
                        const slideCount = slides.length;

                        // Create dots
                        function createDots() {
                            dotsContainer.innerHTML = '';
                            for (let i = 0; i < slideCount; i++) {
                                const dot = document.createElement('span');
                                dot.classList.add('slider-dot');
                                if (i === 0) dot.classList.add('active');
                                dot.addEventListener('click', () => goToSlide(i));
                                dotsContainer.appendChild(dot);
                            }
                        }

                        // Update slider position
                        function updateSlider() {
                            track.style.transform = `translateX(-${currentIndex * 100}%)`;

                            // Update dots
                            document.querySelectorAll('.slider-dot').forEach((dot, index) => {
                                dot.classList.toggle('active', index === currentIndex);
                            });
                        }

                        // Go to specific slide
                        function goToSlide(index) {
                            currentIndex = index;
                            updateSlider();
                            resetAutoScroll();
                        }

                        // Next slide
                        function nextSlide() {
                            currentIndex = (currentIndex < slideCount - 1) ? currentIndex + 1 : 0;
                            updateSlider();
                        }

                        // Start auto-scroll
                        function startAutoScroll() {
                            autoScrollInterval = setInterval(nextSlide, 4000);
                        }

                        // Reset auto-scroll timer
                        function resetAutoScroll() {
                            clearInterval(autoScrollInterval);
                            startAutoScroll();
                        }

                        // Initialize
                        createDots();
                        startAutoScroll();

                        // Pause on hover
                        const slider = document.getElementById('testimonialsSlider');
                        slider.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
                        slider.addEventListener('mouseleave', startAutoScroll);
                    });
                </script>
            </section>
            <section class="client-showcase-section">
                <style>
                    .client-showcase-section {
                        background: whitesmoke;
                        padding: 40px 20px;
                        max-width: 735px;
                        margin: 30px auto;
                        border-radius: 8px;
                        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
                        overflow: hidden;
                    }

                    .section-title {
                        text-align: center;
                        font-size: 2rem;
                        color: #2c3e50;
                        margin-bottom: 30px;
                        position: relative;
                        padding-bottom: 10px;
                    }

                    .section-title::after {
                        content: '';
                        position: absolute;
                        bottom: 0;
                        left: 50%;
                        transform: translateX(-50%);
                        width: 80px;
                        height: 3px;
                        background: linear-gradient(90deg, #007bff, #00d4ff);
                    }

                    .clients-container {
                        position: relative;
                        width: 100%;
                        overflow-x: auto;
                        padding: 20px 0;
                        cursor: grab;
                        scrollbar-width: none;
                        /* Hide scrollbar for Firefox */
                        -ms-overflow-style: none;
                        /* Hide scrollbar for IE/Edge */
                    }

                    .clients-container::-webkit-scrollbar {
                        display: none;
                        /* Hide scrollbar for Chrome/Safari */
                    }

                    .clients-container:active {
                        cursor: grabbing;
                    }

                    .clients-scroll {
                        display: flex;
                        gap: 40px;
                        align-items: center;
                        padding: 0 20px;
                        user-select: none;
                        width: max-content;
                    }

                    .client-item {
                        flex-shrink: 0;
                        width: 150px;
                        height: 100px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #ffffff;
                        border-radius: 8px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                        transition: all 0.3s ease;
                        padding: 15px;
                    }

                    .client-item img {
                        max-width: 100%;
                        max-height: 100%;
                        object-fit: contain;
                        filter: grayscale(30%);
                        transition: filter 0.3s ease;
                    }

                    .client-item:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                    }

                    .client-item:hover img {
                        filter: grayscale(0%);
                    }

                    .scroll-indicator {
                        text-align: center;
                        margin-top: 15px;
                        font-size: 0.9rem;
                        color: #6c757d;
                    }

                    @media (max-width: 768px) {
                        .section-title {
                            font-size: 1.5rem;
                        }

                        .client-item {
                            width: 120px;
                            height: 80px;
                        }

                        .clients-scroll {
                            gap: 30px;
                        }
                    }

                    @media (max-width: 480px) {
                        .client-showcase-section {
                            padding: 30px 15px;
                        }

                        .section-title {
                            font-size: 1.3rem;
                        }

                        .client-item {
                            width: 100px;
                            height: 70px;
                            padding: 10px;
                        }
                    }
                </style>

                <h2 class="section-title">Our Valued Clients</h2>

                <div class="clients-container" id="clientsContainer">
                    <div class="clients-scroll" id="clientsScroll">
                        <!-- Client logos -->
                        <div class="client-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/1200px-Google_%22G%22_Logo.svg.png"
                                alt="Google" loading="lazy">
                        </div>
                        <div class="client-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Microsoft_logo.svg/1200px-Microsoft_logo.svg.png"
                                alt="Microsoft" loading="lazy">
                        </div>
                        <div class="client-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/1200px-Amazon_logo.svg.png"
                                alt="Amazon" loading="lazy">
                        </div>
                        <div class="client-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Apple_logo_black.svg/1200px-Apple_logo_black.svg.png"
                                alt="Apple" loading="lazy">
                        </div>
                        <div class="client-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Tesla_Motors.svg/1200px-Tesla_Motors.svg.png"
                                alt="Tesla" loading="lazy">
                        </div>
                        <div class="client-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Oracle_logo.svg/1200px-Oracle_logo.svg.png"
                                alt="Oracle" loading="lazy">
                        </div>
                        <div class="client-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Samsung_Logo.svg/1200px-Samsung_Logo.svg.png"
                                alt="Samsung" loading="lazy">
                        </div>
                        <div class="client-item">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/HP_logo_2012.svg/1200px-HP_logo_2012.svg.png"
                                alt="HP" loading="lazy">
                        </div>
                    </div>
                </div>


                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const container = document.getElementById('clientsContainer');
                        const scroll = document.getElementById('clientsScroll');
                        let isDown = false;
                        let startX;
                        let scrollLeft;

                        // Mouse down - prepare for drag
                        container.addEventListener('mousedown', (e) => {
                            isDown = true;
                            startX = e.pageX - container.offsetLeft;
                            scrollLeft = container.scrollLeft;
                            container.style.cursor = 'grabbing';
                        });

                        // Mouse leave - end drag
                        container.addEventListener('mouseleave', () => {
                            isDown = false;
                        });

                        // Mouse up - end drag
                        container.addEventListener('mouseup', () => {
                            isDown = false;
                            container.style.cursor = 'grab';
                        });

                        // Mouse move - handle drag
                        container.addEventListener('mousemove', (e) => {
                            if (!isDown) return;
                            e.preventDefault();
                            const x = e.pageX - container.offsetLeft;
                            const walk = (x - startX) * 2; // scroll speed multiplier
                            container.scrollLeft = scrollLeft - walk;
                        });

                        // Touch events for mobile
                        container.addEventListener('touchstart', (e) => {
                            isDown = true;
                            startX = e.touches[0].pageX - container.offsetLeft;
                            scrollLeft = container.scrollLeft;
                        }, { passive: false });

                        container.addEventListener('touchmove', (e) => {
                            if (!isDown) return;
                            e.preventDefault();
                            const x = e.touches[0].pageX - container.offsetLeft;
                            const walk = (x - startX) * 2;
                            container.scrollLeft = scrollLeft - walk;
                        }, { passive: false });

                        container.addEventListener('touchend', () => {
                            isDown = false;
                        });
                    });
                </script>
            </section>
        </section>


    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Optimized Hero Banner initialized successfully');
        });
    </script>
@endpush