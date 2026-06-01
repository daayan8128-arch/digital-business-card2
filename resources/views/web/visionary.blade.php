@extends('webTemplate.maintemplate')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush
    <style>
        /* Base Styles */
        .scrollable-content {
            scrollbar-width: none;
            -ms-overflow-style: none;
            width: 100%;
            box-sizing: border-box;
        }

        .scrollable-content::-webkit-scrollbar {
            display: none;
        }

        .content-section {
            display: flex;
            justify-content: center;
            width: 100%;
            padding: 20px 0;
            background: var(--bg-color);
            box-sizing: border-box;
        }

        .social-entrepreneurship-section {
            font-family: 'Arial', sans-serif;
            width: 100%;
            max-width: 1200px;
            /* Fixed width for laptop view */
            min-height: 100vh;
            margin-left: 20px;
            margin-right: 20px;
            padding: 20px;
            box-sizing: border-box;
        }

        .social-entrepreneurship-section .container {
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .social-entrepreneurship-section .header {
            padding: 30px 25px 20px;
            background: white;
        }

        .social-entrepreneurship-section .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .social-entrepreneurship-section .header-line {
            width: 325px;
            height: 3px;
            margin: 0 auto;
            background: linear-gradient(90deg, #3498db, #2980b9);
            border-radius: 2px;
        }

        .social-entrepreneurship-section .articles-container {
            padding: 0 25px 30px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            align-items: start;
            position: relative;
        }

        /* Empty State Styles (Fixed) */
        .empty-articles {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            width: 100%;
            min-height: 400px;
            /* yeh fix karega ki section collapse na ho */
            padding: 20px;
            text-align: center;
            box-sizing: border-box;
        }

        .empty-articles-icon {
            font-size: 3rem;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .empty-articles h3 {
            color: #334155;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .empty-articles p {
            color: #64748b;
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Article Card Styles */
        .social-entrepreneurship-section .article-card {
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .social-entrepreneurship-section .article-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #3498db;
        }

        .social-entrepreneurship-section .article-image {
            width: 100%;
            height: 180px;
            background-size: cover;
            background-position: center;
            position: relative;
            background-color: #e9ecef;
            /* Fallback background */
        }

        .social-entrepreneurship-section .article-content {
            padding: 20px;
        }

        .social-entrepreneurship-section .article-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.4;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .social-entrepreneurship-section .article-description {
            word-break: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;
            font-size: 14px;
            color: #7f8c8d;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Responsive Styles */
        @media (max-width: 1250px) {
            .social-entrepreneurship-section {
                width: 95%;
                max-width: 1200px;
            }
        }

        @media (max-width: 992px) {
            .social-entrepreneurship-section .header h1 {
                font-size: 24px;
            }

            .social-entrepreneurship-section .header-line {
                width: 250px;
            }
        }

        @media (max-width: 768px) {
            .social-entrepreneurship-section .articles-container {
                grid-template-columns: 1fr;
            }

            .social-entrepreneurship-section {
                padding: 15px;
            }

            .empty-articles-icon {
                font-size: 2.5rem;
            }

            .empty-articles h3 {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .social-entrepreneurship-section {
                padding: 10px;
            }

            .social-entrepreneurship-section .header {
                padding: 20px 15px 10px;
            }

            .social-entrepreneurship-section .header h1 {
                font-size: 20px;
            }

            .social-entrepreneurship-section .header-line {
                width: 200px;
                height: 2px;
            }

            .social-entrepreneurship-section .articles-container {
                padding: 0 15px 20px;
            }

            .social-entrepreneurship-section .article-content {
                padding: 15px;
            }

            .social-entrepreneurship-section .article-title {
                font-size: 15px;
            }

            .social-entrepreneurship-section .article-description {
                font-size: 13px;
            }
        }
    </style>

    <div class="scrollable-content">
        <section class="content-section">
            <section class="social-entrepreneurship-section">
                <div class="container">
                    <div class="header">
                        <h1>Social Entrepreneurship</h1>
                        <div class="header-line"></div>
                    </div>

                    <div class="articles-container">
                        @if(count($visionary) > 0)
                            @foreach ($visionary as $article)

                                                    <!-- for image full height use this code

                                .social-entrepreneurship-section .article-image {
                                    width: 100%;
                                    background-color: #e9ecef;
                                    text-align: center;
                                }

                                .social-entrepreneurship-section .article-image img {
                                    width: 100%;
                                    height: auto;   /* image proportion maintain karega */
                                    display: block;
                                    border-bottom: 1px solid #ddd; /* optional: niche ek halka border */
                                }
                                <div class="article-card">
                                    <div class="article-image">
                                        <img src="{{ $article->article_image ? asset('uploads/' . $article->article_image) : 'https://via.placeholder.com/600x400' }}" alt="{{ $article->article_title }}">
                                    </div>
                                    <div class="article-content">
                                        <h3 class="article-title">{{ $article->article_title }}</h3>
                                        <p class="article-description">{{ $article->article_description }}</p>
                                    </div>
                                </div> -->

                                                    <div class="article-card">
                                                        <div class="article-image"
                                                            style="background-image: url('{{ $article->article_image ? asset('uploads/' . $article->article_image) : 'https://via.placeholder.com/600x400' }}');">
                                                        </div>
                                                        <div class="article-content">
                                                            <h3 class="article-title">{{ $article->article_title }}</h3>
                                                            <p class="article-description">{{ $article->article_description }}</p>
                                                        </div>
                                                    </div>
                            @endforeach
                        @else
                            <div class="empty-articles">
                                <i class="fas fa-newspaper empty-articles-icon"></i>
                                <h3>No Articles Available</h3>
                                <p>We're currently updating our social entrepreneurship content. Please check back soon!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add click functionality to article cards
            document.querySelectorAll('.article-card').forEach(card => {
                card.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Add a click animation
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(-2px)';
                    }, 150);

                    // You can add actual navigation logic here
                    // For example:
                    // const articleId = this.dataset.articleId;
                    // window.location.href = `/articles/${articleId}`;
                });
            });

            // Add hover effects for article cards
            document.querySelectorAll('.article-card').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.borderColor = '#3498db';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.borderColor = '#e9ecef';
                });
            });
        });
    </script>
@endsection