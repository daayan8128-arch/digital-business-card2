@extends('webTemplate.maintemplate')
@php
    $user = Auth::user();
@endphp

@if($user && $user->access === 'block')
    <div class="alert alert-danger">
        Your account is blocked. Contact admin.
    </div>
@endif

@section('content')
    <!-- @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    @endpush -->
    <div class="scrollable-content">
        {{-- Optimized Hero Banner Section with Reduced Spacing --}}
        @if(!empty($heropage) && count($heropage) > 0)
            <section class="hero-banner-section">


                <div class="hero-wrapper">
                    <div class="hero-container" id="heroContainer">
                        <div class="hero-slider" id="heroSlider">
                            @foreach($heropage as $index => $slide)
                                @if(!empty($slide->heroimage))
                                    <div class="hero-slide"
                                        style="background-image: url('{{ asset('uploads/' . basename($slide->heroimage)) }}')">
                                        @if(!empty($slide->title) || !empty($slide->subtitle))
                                            <div class="slide-content">
                                                @if(!empty($slide->title))
                                                    <h1 class="slide-title">{{ $slide->title }}</h1>
                                                @endif
                                                @if(!empty($slide->subtitle))
                                                    <p class="slide-subtitle">{{ $slide->subtitle }}</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                @endif
                            @endforeach


                        </div>

                        <button class="hero-nav hero-prev" id="prevBtn" aria-label="Previous slide">‹</button>
                        <button class="hero-nav hero-next" id="nextBtn" aria-label="Next slide">›</button>

                        <div class="hero-indicators" id="indicators">
                            @foreach($heropage as $index => $slide)
                                <span class="indicator {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"
                                    aria-label="Slide {{ $index + 1 }}"></span>
                            @endforeach
                        </div>

                        <div class="hero-progress" id="progressBar"></div>
                    </div>
                </div>


            </section>
        @endif

        {{-- Additional content sections --}}

        <section class="content-section">
            <style>
                .about-content p,
                .vision-content p,
                .mission-statement p {
                    word-break: break-word !important;
                    overflow-wrap: break-word !important;
                    white-space: normal !important;
                }

                /* Empty State Styles for About Us Only */
                .about-empty-state {
                    text-align: center;
                    padding: 60px 20px;
                    background: white;
                    border-radius: 8px;
                    margin: 20px 25px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                    border-left: 4px solid #4f46e5;
                }

                .about-empty-icon {
                    font-size: 50px;
                    color: #a5b4fc;
                    margin-bottom: 15px;
                }

                .about-empty-title {
                    font-size: 22px;
                    color: #374151;
                    margin-bottom: 10px;
                    font-weight: 600;
                }

                .about-empty-text {
                    color: #6b7280;
                    font-size: 16px;
                    max-width: 1100px;


                    line-height: 1.6;
                }
            </style>

            <section class="content-section">
                {{-- About Section --}}
                @if(
                        !empty($about_us->about_content) ||
                        !empty($about_us->about_content2) ||
                        !empty($about_us->vision_title) ||
                        !empty($about_us->vision_content) ||
                        !empty($about_us->company_goal)
                    )
                    <section class="about-section">
                        <div class="container">
                            <h1>ABOUT US</h1>
                            <div class="about-content">
                                @if(!empty($about_us->about_content))
                                    <p>{{ $about_us->about_content }}</p>
                                @endif
                                @if(!empty($about_us->about_content2))
                                    <p>{{ $about_us->about_content2 }}</p>
                                @endif
                            </div>

                            @if(!empty($about_us->vision_title) || !empty($about_us->vision_content))
                                <h2>{{ $about_us->vision_title ?? 'Our Vision' }}</h2>
                                <div class="vision-content">
                                    @if(!empty($about_us->vision_content))
                                        <p>{{ $about_us->vision_content }}</p>
                                    @endif

                                    @if(!empty($about_us->company_goal))
                                        <div class="mission-statement">
                                            <p>{{ $about_us->company_goal }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </section>
                @else
                    <div class="about-empty-state">
                        <i class="fas fa-info-circle about-empty-icon"></i>
                        <h3 class="about-empty-title">About Us Content Coming Soon</h3>
                        <p class="about-empty-text">
                            We're currently preparing detailed information about our company,
                            mission, and vision. Please check back later to learn more about us.
                        </p>
                    </div>
                @endif
            </section>
            @if($partners->isNotEmpty())
                <section class="proud-associate-section">


                    <h2 class="section-title">Our Valued Partners</h2>

                    <div class="logos-container" id="logosContainer">
                        <div class="logos-scroll" id="logosScroll">
                            <!-- First set of logos -->
                            @foreach ($partners as $partner)
                                <div class="logo-item">
                                    <img src="{{ asset('uploads/' . $partner->company_logo) }}" alt="Partner Logo" loading="lazy">

                                </div>
                            @endforeach
                            <!-- Duplicate set for seamless loop -->
                            @foreach ($partners as $partner)
                                <div class="logo-item">
                                    <img src="{{ asset('uploads/' . $partner->company_logo) }}" alt="Partner Logo" loading="lazy">
                                </div>
                            @endforeach
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
                                position = scrollLeft + walk;
                                scroll.style.transform = `translateX(${position}px)`;
                            });

                            // Touch events for mobile
                            container.addEventListener('touchstart', (e) => {
                                isDown = true;
                                startX = e.touches[0].pageX - container.offsetLeft;
                                scrollLeft = position;
                                isHovered = true;
                            }, {
                                passive: false
                            });

                            container.addEventListener('touchmove', (e) => {
                                if (!isDown) return;
                                e.preventDefault();
                                const x = e.touches[0].pageX - container.offsetLeft;
                                const walk = (x - startX) * 2;
                                position = scrollLeft + walk;
                                scroll.style.transform = `translateX(${position}px)`;
                            }, {
                                passive: false
                            });

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
            @endif
            </section>
            <section class="testimonials-section">
                <style>
                    .testimonials-section * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }

                    .testimonials-section {
                        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                        background: #e0e5ec;
                        padding: 4rem 1rem;
                    }

                    .testimonials-container {
                        max-width: 735px;
                        margin: 0 auto;
                        padding: 0 15px;
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

                    .feedback-cta {
                        text-align: center;
                        margin-top: 2.5rem;
                        padding: 20px;
                        background: white;
                        border-radius: 12px;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                    }

                    .feedback-btn {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 12px 30px;
                        border: none;
                        border-radius: 8px;
                        font-size: 1rem;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        text-decoration: none;
                        display: inline-block;
                        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
                    }

                    .feedback-btn:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
                    }

                    /* Feedback Form Styles */
                    .feedback-overlay {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.5);
                        display: none;
                        justify-content: center;
                        align-items: center;
                        z-index: 1000;
                        backdrop-filter: blur(5px);
                    }

                    .feedback-modal {
                        background: white;
                        border-radius: 16px;
                        width: 90%;
                        max-width: 600px;
                        max-height: 90vh;
                        overflow-y: auto;
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
                        animation: modalSlideIn 0.3s ease-out;
                    }

                    @keyframes modalSlideIn {
                        from {
                            opacity: 0;
                            transform: scale(0.9) translateY(-20px);
                        }

                        to {
                            opacity: 1;
                            transform: scale(1) translateY(0);
                        }
                    }

                    .modal-header {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 2rem;
                        border-radius: 16px 16px 0 0;
                        position: relative;
                    }

                    .modal-header h2 {
                        font-size: 1.8rem;
                        font-weight: 700;
                        margin-bottom: 0.5rem;
                        text-align: center;
                    }

                    .modal-header p {
                        opacity: 0.9;
                        font-size: 0.95rem;
                        text-align: center;
                    }

                    .close-btn {
                        position: absolute;
                        top: 1rem;
                        right: 1rem;
                        background: rgba(255, 255, 255, 0.2);
                        border: none;
                        color: white;
                        font-size: 1.5rem;
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        transition: background 0.3s;
                    }

                    .close-btn:hover {
                        background: rgba(255, 255, 255, 0.3);
                    }

                    .feedback-form {
                        padding: 2rem;
                    }

                    .form-group {
                        margin-bottom: 1.5rem;
                    }

                    .form-group label {
                        display: block;
                        margin-bottom: 0.5rem;
                        font-weight: 600;
                        color: #1e293b;
                        font-size: 0.95rem;
                    }

                    .star-rating {
                        display: flex;
                        gap: 5px;
                        margin-bottom: 1rem;
                        font-size: 2rem;
                    }

                    .star {
                        color: #e2e8f0;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    }

                    .star:hover,
                    .star.selected {
                        color: #ffc107;
                        transform: scale(1.1);
                    }

                    .form-input {
                        width: 100%;
                        padding: 12px 16px;
                        border: 2px solid #e2e8f0;
                        border-radius: 8px;
                        font-size: 1rem;
                        transition: border-color 0.3s;
                        font-family: inherit;
                    }

                    .form-input:focus {
                        outline: none;
                        border-color: #007bff;
                        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
                    }

                    .form-textarea {
                        min-height: 120px;
                        resize: vertical;
                    }

                    .submit-btn {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 14px 28px;
                        border: none;
                        border-radius: 8px;
                        font-size: 1rem;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        width: 100%;
                        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
                    }

                    .submit-btn:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
                    }

                    .submit-btn:disabled {
                        opacity: 0.6;
                        cursor: not-allowed;
                        transform: none;
                    }

                    .profile-upload-container {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 1rem;
                    }

                    .profile-preview {
                        width: 80px;
                        height: 80px;
                        border-radius: 50%;
                        border: 3px dashed #cbd5e1;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        overflow: hidden;
                        transition: all 0.3s ease;
                        cursor: pointer;
                        background: #f8fafc;
                    }

                    .profile-preview:hover {
                        border-color: #007bff;
                        background: #f0f9ff;
                    }

                    .profile-preview.has-image {
                        border-style: solid;
                        border-color: #007bff;
                    }

                    .profile-placeholder {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 0.5rem;
                        color: #64748b;
                        text-align: center;
                    }

                    .profile-placeholder span {
                        font-size: 0.75rem;
                        font-weight: 500;
                    }

                    .profile-img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        border-radius: 50%;
                    }

                    .upload-btn {
                        background: #f1f5f9;
                        color: #475569;
                        border: 2px solid #e2e8f0;
                        padding: 8px 16px;
                        border-radius: 6px;
                        font-size: 0.9rem;
                        font-weight: 500;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .upload-btn:hover {
                        background: #e2e8f0;
                        border-color: #cbd5e1;
                    }

                    .remove-btn {
                        background: #fee2e2;
                        color: #dc2626;
                        border: 2px solid #fecaca;
                        padding: 6px 12px;
                        border-radius: 6px;
                        font-size: 0.85rem;
                        font-weight: 500;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .remove-btn:hover {
                        background: #fecaca;
                        border-color: #fca5a5;
                    }

                    .no-feedback-message {
                        text-align: center;
                        padding: 3rem;
                        color: #64748b;
                        font-style: italic;
                    }

                    .form-error {
                        color: #dc2626;
                        font-size: 0.85rem;
                        margin-top: 0.5rem;
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

                        .feedback-modal {
                            width: 95%;
                            margin: 1rem;
                        }

                        .modal-header,
                        .feedback-form {
                            padding: 1.5rem;
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
                            @php $publishedFeedbacks = $feedbacks->where('status', 'publics'); @endphp

                            @if($publishedFeedbacks->count() > 0)
                                @foreach($publishedFeedbacks as $feedback)
                                    <div class="testimonial-card">
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                {!! $i <= $feedback->rating ? '★' : '☆' !!}
                                            @endfor
                                        </div>
                                        <p class="testimonial-text">"{{ $feedback->feedback }}"</p>
                                        <div class="client-info">
                                            <div class="client-avatar">
                                                @if($feedback->profile_image)
                                                    <img src="{{ asset('uploads/' . $feedback->profile_image) }}"
                                                        alt="{{ $feedback->name }}"
                                                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($feedback->name) }}&background=random'">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($feedback->name) }}&background=random"
                                                        alt="{{ $feedback->name }}">
                                                @endif
                                            </div>
                                            <div class="client-details">
                                                <h4>{{ $feedback->name }}</h4>
                                                <p>{{ $feedback->position }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="testimonial-card">
                                    <div class="no-feedback-message">
                                        <p>No published feedback yet. Be the first to share your experience!</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($publishedFeedbacks->count() > 1)
                        <div class="slider-nav" id="sliderDots"></div>
                    @endif

                    <div class="feedback-cta">
                        <button class="feedback-btn" onclick="openFeedbackModal()">
                            Give Your Feedback
                        </button>
                    </div>
                </div>

                <!-- Feedback Modal -->
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="feedback-overlay" id="feedbackOverlay">
                    <div class="feedback-modal">
                        <div class="modal-header">
                            <button class="close-btn" onclick="closeFeedbackModal()">&times;</button>
                            <h2>Share Your Experience</h2>
                            <p>We'd love to hear about your experience working with us</p>
                        </div>

                        <form class="feedback-form" onsubmit="submitFeedback(event)" id="feedbackForm"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Rate Your Experience:</label>
                                <div class="star-rating" id="starRating">
                                    <span class="star" data-rating="1">★</span>
                                    <span class="star" data-rating="2">★</span>
                                    <span class="star" data-rating="3">★</span>
                                    <span class="star" data-rating="4">★</span>
                                    <span class="star" data-rating="5">★</span>
                                </div>
                                <input type="hidden" id="selectedRating" name="rating" required>
                                <div class="form-error" id="ratingError"></div>
                            </div>

                            <!-- ✅ Fix: name changed to match controller -->
                            <div class="form-group">
                                <label for="profilePicture">Profile Picture:</label>
                                <div class="profile-upload-container">
                                    <div class="profile-preview" id="profilePreview">
                                        <div class="profile-placeholder">
                                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <span>Upload Photo</span>
                                        </div>
                                    </div>
                                    <input type="file" id="profilePicture" name="profilePicture" accept="image/*"
                                        style="display: none;">
                                    <button type="button" class="upload-btn"
                                        onclick="document.getElementById('profilePicture').click()">
                                        Choose Photo
                                    </button>
                                    <button type="button" class="remove-btn" id="removePhotoBtn"
                                        onclick="removeProfilePicture()" style="display: none;">
                                        Remove
                                    </button>
                                </div>
                                <div class="form-error" id="imageError"></div>
                            </div>

                            <div class="form-group">
                                <label for="clientName">Your Name:</label>
                                <input type="text" id="clientName" name="name" class="form-input"
                                    placeholder="Enter your name" required>
                                <div class="form-error" id="nameError"></div>
                            </div>

                            <div class="form-group">
                                <label for="clientPosition">Your Position & Company:</label>
                                <input type="text" id="clientPosition" name="position" class="form-input"
                                    placeholder="e.g., CEO, ABC Company">
                                <div class="form-error" id="positionError"></div>
                            </div>

                            <div class="form-group">
                                <label for="feedbackText">Your Feedback:</label>
                                <textarea id="feedbackText" name="feedback" class="form-input form-textarea"
                                    placeholder="Tell us about your experience working with us..." required></textarea>
                                <div class="form-error" id="feedbackError"></div>
                            </div>

                            <button type="submit" class="submit-btn" id="submitBtn">
                                Submit Feedback
                            </button>
                        </form>
                    </div>
                </div>
                <script>
                    // ------------------ Modal Functions (Global Accessible) ------------------
                    function openFeedbackModal() {
                        document.getElementById('feedbackOverlay').style.display = 'flex';
                    }

                    function closeFeedbackModal() {
                        document.getElementById('feedbackOverlay').style.display = 'none';
                        document.getElementById('feedbackForm').reset();
                        resetStarRating();
                        document.getElementById('profilePreview').innerHTML = `
                <div class="profile-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                              stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="7" r="4"
                                stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span>Upload Photo</span>
                </div>
            `;
                        document.getElementById('removePhotoBtn').style.display = 'none';
                    }

                    // ------------------ Star Rating Functions ------------------
                    let selectedRating = 0;

                    function updateStarRating(rating) {
                        document.querySelectorAll('#starRating .star').forEach(star => {
                            star.classList.toggle('selected', parseInt(star.dataset.rating) <= rating);
                        });
                        document.getElementById('selectedRating').value = rating;
                    }

                    function resetStarRating() {
                        selectedRating = 0;
                        document.querySelectorAll('#starRating .star').forEach(star => {
                            star.classList.remove('selected');
                        });
                        document.getElementById('selectedRating').value = '';
                    }

                    // ------------------ Remove Profile Image ------------------
                    function removeProfilePicture() {
                        const input = document.getElementById('profilePicture');
                        const preview = document.getElementById('profilePreview');
                        const removeBtn = document.getElementById('removePhotoBtn');

                        input.value = '';
                        preview.innerHTML = `
                <div class="profile-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                              stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="7" r="4"
                                stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span>Upload Photo</span>
                </div>
            `;
                        removeBtn.style.display = 'none';
                    }

                    // ------------------ Submit Feedback ------------------
                    function submitFeedback(event) {
                        event.preventDefault();

                        document.querySelectorAll('.form-error').forEach(el => el.textContent = '');

                        const submitBtn = document.getElementById('submitBtn');
                        const form = document.getElementById('feedbackForm');
                        const formData = new FormData(form);

                        if (selectedRating === 0) {
                            document.getElementById('ratingError').textContent = 'Please select a rating before submitting.';
                            return;
                        }

                        formData.append('rating', selectedRating);

                        submitBtn.disabled = true;
                        submitBtn.textContent = 'Submitting...';

                        const username = "{{ $user->username }}";

                        fetch(`/${username}/submit-feedback`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData
                        })
                            .then(response => {
                                if (!response.ok) return response.json().then(err => { throw err; });
                                return response.json();
                            })
                            .then(data => {
                                alert(data.message || 'Thank you for your feedback! It will be visible once approved.');
                                closeFeedbackModal();
                                window.location.reload();
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                if (error.errors) {
                                    Object.keys(error.errors).forEach(key => {
                                        const errorElement = document.getElementById(key + 'Error');
                                        if (errorElement) {
                                            errorElement.textContent = error.errors[key][0];
                                        }
                                    });
                                } else {
                                    alert('Error: ' + (error.message || 'Something went wrong.'));
                                }
                            })
                            .finally(() => {
                                submitBtn.disabled = false;
                                submitBtn.textContent = 'Submit Feedback';
                            });
                    }

                    // ------------------ DOMContentLoaded ------------------
                    document.addEventListener('DOMContentLoaded', function () {
                        // Slider Logic
                        let currentIndex = 0;
                        const track = document.getElementById('testimonialsTrack');
                        const cards = document.querySelectorAll('.testimonial-card');
                        const dotsContainer = document.getElementById('sliderDots');

                        if (cards.length > 1 && dotsContainer) {
                            cards.forEach((_, index) => {
                                const dot = document.createElement('div');
                                dot.className = 'slider-dot' + (index === 0 ? ' active' : '');
                                dot.addEventListener('click', () => moveSlider(index));
                                dotsContainer.appendChild(dot);
                            });
                        }

                        function moveSlider(index) {
                            currentIndex = index;
                            const offset = -index * 100;
                            track.style.transform = `translateX(${offset}%)`;

                            document.querySelectorAll('.slider-dot').forEach((dot, i) => {
                                dot.classList.toggle('active', i === index);
                            });
                        }

                        if (cards.length > 1) {
                            setInterval(() => {
                                currentIndex = (currentIndex + 1) % cards.length;
                                moveSlider(currentIndex);
                            }, 5000);
                        }

                        // Star rating click
                        document.querySelectorAll('#starRating .star').forEach(star => {
                            star.addEventListener('click', function () {
                                selectedRating = parseInt(this.dataset.rating);
                                updateStarRating(selectedRating);
                            });
                        });

                        // Image Upload Preview
                        document.getElementById('profilePicture').addEventListener('change', function (e) {
                            const file = e.target.files[0];
                            const preview = document.getElementById('profilePreview');
                            const removeBtn = document.getElementById('removePhotoBtn');
                            const errorDiv = document.getElementById('imageError');

                            errorDiv.textContent = '';

                            if (file) {
                                if (!file.type.startsWith('image/')) {
                                    errorDiv.textContent = 'Please select a valid image file';
                                    e.target.value = '';
                                    return;
                                }
                                if (file.size > 5 * 1024 * 1024) {
                                    errorDiv.textContent = 'Image size should be less than 5MB';
                                    e.target.value = '';
                                    return;
                                }

                                const reader = new FileReader();
                                reader.onload = function (event) {
                                    preview.innerHTML = `<img src="${event.target.result}" alt="Preview">`;
                                    removeBtn.style.display = 'inline-block';
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        // Drag/Swipe slider
                        let isMouseDown = false;
                        let startX = 0;
                        const threshold = 50;

                        track.addEventListener('mousedown', function (e) {
                            isMouseDown = true;
                            startX = e.clientX;
                            e.preventDefault();
                        });

                        track.addEventListener('mouseup', function (e) {
                            if (!isMouseDown) return;
                            let diffX = e.clientX - startX;

                            if (diffX > threshold && currentIndex > 0) {
                                moveSlider(currentIndex - 1);
                            } else if (diffX < -threshold && currentIndex < cards.length - 1) {
                                moveSlider(currentIndex + 1);
                            }

                            isMouseDown = false;
                        });

                        track.addEventListener('touchstart', function (e) {
                            startX = e.touches[0].clientX;
                        });

                        track.addEventListener('touchend', function (e) {
                            let endX = e.changedTouches[0].clientX;
                            let diffX = endX - startX;

                            if (diffX > threshold && currentIndex > 0) {
                                moveSlider(currentIndex - 1);
                            } else if (diffX < -threshold && currentIndex < cards.length - 1) {
                                moveSlider(currentIndex + 1);
                            }
                        });
                    });
                </script>


            </section>

            @if($clients->isNotEmpty())
                <section class="client-showcase-section">
                    <style>
                        .client-showcase-section {
                            background: whitesmoke;
                            padding: 40px 20px;
                            max-width: 735px;
                            margin: 30px 30px;
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
                            @foreach ($clients as $index => $client)
                                <div class="client-item">
                                    <img src="{{ asset('uploads/' . $client->client_company_logo) }}" alt="Client Logo"
                                        loading="lazy">
                                </div>
                            @endforeach

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
                            }, {
                                passive: false
                            });

                            container.addEventListener('touchmove', (e) => {
                                if (!isDown) return;
                                e.preventDefault();
                                const x = e.touches[0].pageX - container.offsetLeft;
                                const walk = (x - startX) * 2;
                                container.scrollLeft = scrollLeft - walk;
                            }, {
                                passive: false
                            });

                            container.addEventListener('touchend', () => {
                                isDown = false;
                            });
                        });
                    </script>
                </section>
            @endif
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