@extends('mainsample.maintemplate')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush

    <!-- <style>
                    .content-section {
                        padding: 20px 10px;
                        background: #e0e5ec !important;
                        border-radius: 8px;
                        box-sizing: border-box;
                        isolation: isolate;
                    }

                    .content-wrapper {
                        max-width: 1400px;
                        /* Increased max-width */
                        margin: 0 auto;
                        width: 100%;
                    }

                    /* Portfolio Modal Styles */
                    .portfolio-modal {
                        display: none;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.8);
                        z-index: 1000;
                        overflow-y: auto;
                        padding: 20px;
                    }

                    .modal-content {
                        background: white;
                        max-width: 1000px;
                        /* Larger modal */
                        margin: 50px auto;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
                        position: relative;
                    }

                    .close-modal {
                        position: absolute;
                        top: 20px;
                        right: 20px;
                        font-size: 2rem;
                        color: #fff;
                        cursor: pointer;
                        background: rgba(0, 0, 0, 0.5);
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        z-index: 10;
                    }

                    .modal-image {
                        height: 500px;
                        /* Taller image */
                        background-size: cover;
                        background-position: center;
                        position: relative;
                    }

                    .modal-body {
                        padding: 40px;
                        /* More padding */
                    }

                    .modal-category {
                        display: inline-block;
                        background: #eff6ff;
                        color: #1e40af;
                        padding: 8px 16px;
                        border-radius: 20px;
                        font-size: 0.9rem;
                        font-weight: 600;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        margin-bottom: 20px;
                    }

                    .modal-title {
                        font-size: 2.5rem;
                        /* Larger title */
                        font-weight: 700;
                        color: #1e293b;
                        margin-bottom: 25px;
                    }

                    .modal-description {
                        color: #64748b;
                        font-size: 1.2rem;
                        /* Larger text */
                        line-height: 1.8;
                        margin-bottom: 40px;
                    }

                    .modal-details {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 30px;
                        margin-bottom: 40px;
                    }

                    .detail-item h4 {
                        font-size: 1.2rem;
                        color: #1e293b;
                        margin-bottom: 15px;
                        font-weight: 600;
                    }

                    .detail-item p {
                        color: #64748b;
                        font-size: 1.1rem;
                    }

                    @media (max-width: 992px) {
                        .modal-content {
                            margin: 30px auto;
                        }

                        .modal-image {
                            height: 350px;
                        }

                        .modal-title {
                            font-size: 2rem;
                        }
                    }

                    @media (max-width: 768px) {
                        .modal-content {
                            margin: 20px auto;
                        }

                        .modal-image {
                            height: 250px;
                        }

                        .modal-body {
                            padding: 30px;
                        }

                        .modal-title {
                            font-size: 1.8rem;
                        }

                        .modal-details {
                            grid-template-columns: 1fr;
                        }
                    }
                </style> -->
    <div class="scrollable-content">
        <section class="content-section">
            <section class="social-entrepreneurship-section">
                <div class="container">
                    <div class="header">
                        <h1>Social Entrepreneurship</h1>
                        <div class="header-line"></div>
                    </div>

                    <div class="articles-container">
                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Youth Leaders Address CLIMATE CRISIS Through Innovation</h3>
                                <p class="article-description">Young entrepreneurs are developing sustainable solutions to
                                    combat climate change through innovative technologies and community-based initiatives
                                    that create lasting environmental impact.</p>
                                <div class="article-meta">Published 2 days ago • Climate Action</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">New Project Boosts COMMUNITY LIVING Standards in Rural Areas</h3>
                                <p class="article-description">A groundbreaking social enterprise initiative focuses on
                                    improving living conditions and economic opportunities in underserved rural communities
                                    through sustainable development programs.</p>
                                <div class="article-meta">Published 4 days ago • Community Development</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1556761175-4b46a572b786?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Social Impact Startups TRANSFORM Healthcare Access</h3>
                                <p class="article-description">Innovative healthcare startups are revolutionizing medical
                                    access in underserved communities through technology-driven solutions and collaborative
                                    partnerships with local organizations.</p>
                                <div class="article-meta">Published 1 week ago • Healthcare Innovation</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Education Initiative EMPOWERS Women Entrepreneurs</h3>
                                <p class="article-description">A comprehensive education program designed to support women
                                    entrepreneurs in developing countries, providing skills training, mentorship, and access
                                    to funding opportunities.</p>
                                <div class="article-meta">Published 1 week ago • Women Empowerment</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Tech Solutions Bridge DIGITAL DIVIDE in Remote Communities</h3>
                                <p class="article-description">Cutting-edge technology initiatives are connecting remote
                                    communities to digital resources, creating new opportunities for education, commerce,
                                    and social development.</p>
                                <div class="article-meta">Published 2 weeks ago • Digital Inclusion</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Sustainable Agriculture Project FEEDS Thousands</h3>
                                <p class="article-description">An innovative agricultural social enterprise is tackling food
                                    security challenges by implementing sustainable farming practices and creating local
                                    food distribution networks.</p>
                                <div class="article-meta">Published 2 weeks ago • Food Security</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1521791136064-7986c2920216?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Microfinance Platform SUPPORTS Small Business Growth</h3>
                                <p class="article-description">A revolutionary microfinance platform is providing accessible
                                    financial services to small business owners, enabling economic growth and poverty
                                    reduction in developing regions.</p>
                                <div class="article-meta">Published 3 weeks ago • Microfinance</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Clean Water Initiative TRANSFORMS Lives in Africa</h3>
                                <p class="article-description">Social entrepreneurs are implementing innovative water
                                    purification systems in rural African communities, providing access to clean drinking
                                    water and reducing waterborne diseases significantly.</p>
                                <div class="article-meta">Published 3 weeks ago • Water Access</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1497486751825-1233686d5d80?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Vocational Training EMPOWERS Youth in Urban Slums</h3>
                                <p class="article-description">A comprehensive skills development program is providing
                                    vocational training to underprivileged youth in urban areas, creating pathways to
                                    sustainable employment and breaking cycles of poverty.</p>
                                <div class="article-meta">Published 1 month ago • Skills Development</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Renewable Energy POWERS Remote Villages</h3>
                                <p class="article-description">Solar-powered microgrids are bringing electricity to off-grid
                                    communities, enabling students to study after dark, powering healthcare facilities, and
                                    supporting local businesses in remote areas.</p>
                                <div class="article-meta">Published 1 month ago • Renewable Energy</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Mental Health App REACHES Underserved Communities</h3>
                                <p class="article-description">A mobile mental health platform is providing accessible
                                    counseling and therapy services to communities with limited mental healthcare resources,
                                    breaking down barriers to psychological support.</p>
                                <div class="article-meta">Published 1 month ago • Mental Health</div>
                            </div>
                        </div>

                        <div class="article-card">
                            <div class="article-image"
                                style="background-image: url('https://images.unsplash.com/photo-1594608661623-aa0bd6eea8d1?w=400&h=300&fit=crop');">
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">Waste Management REVOLUTION Creates Green Jobs</h3>
                                <p class="article-description">An innovative waste-to-resource social enterprise is tackling
                                    urban pollution while creating employment opportunities, transforming waste management
                                    into a sustainable economic model.</p>
                                <div class="article-meta">Published 5 weeks ago • Environmental Impact</div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    @media (max-width: 480px) {
                        .social-entrepreneurship-section {
                            margin: 0 !important;
                            padding: 5px !important;
                        }

                        .social-entrepreneurship-section .container {
                            padding: 0 !important;
                            margin: 0 auto !important;
                            max-width: 100% !important;
                        }

                        .social-entrepreneurship-section .card {
                            margin: 10px 0 !important;
                            width: 100% !important;
                        }
                    }

                    .social-entrepreneurship-section * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }

                    .social-entrepreneurship-section {
                        font-family: 'Arial', sans-serif;
                        background: var(--bg-color);
                        min-height: 100vh;
                        padding: 20px;
                        margin: 0 30px;
                    }

                    .social-entrepreneurship-section .container {
                        max-width: 1200px;
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
                        font-size: 24px;
                        font-weight: 700;
                        color: #2c3e50;
                        margin-bottom: 8px;
                    }

                    .social-entrepreneurship-section .header-line {
                        width: 325px;
                        height: 3px;
                        margin: auto;
                        background: linear-gradient(90deg, #3498db, #2980b9);
                        border-radius: 2px;
                    }

                    .social-entrepreneurship-section .articles-container {
                        padding: 0 25px 30px;

                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 20px;
                    }

                    .social-entrepreneurship-section .article-card {
                        background: #f8f9fa;
                        border-radius: 12px;
                        overflow: hidden;
                        transition: all 0.3s ease;
                        border: 1px solid #e9ecef;
                        /* cursor: pointer; */
                    }

                    .social-entrepreneurship-section .article-card:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
                        border-color: #3498db;
                    }

                    .social-entrepreneurship-section .article-image {
                        width: 100%;
                        height: 140px;
                        background-size: cover;
                        background-position: center;
                        position: relative;
                    }

                    .social-entrepreneurship-section .article-content {
                        padding: 15px;
                    }

                    .social-entrepreneurship-section .article-title {
                        font-size: 14px;
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
                        font-size: 12px;
                        color: #7f8c8d;
                        line-height: 1.4;
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }

                    .social-entrepreneurship-section .article-meta {
                        font-size: 11px;
                        color: #95a5a6;
                        margin-top: 8px;
                        padding-top: 8px;
                        border-top: 1px solid #ecf0f1;
                    }

                    /* Custom scrollbar */
                    .social-entrepreneurship-section .articles-container::-webkit-scrollbar {
                        width: 4px;
                    }

                    .social-entrepreneurship-section .articles-container::-webkit-scrollbar-track {
                        background: #f1f1f1;
                        border-radius: 2px;
                    }

                    .social-entrepreneurship-section .articles-container::-webkit-scrollbar-thumb {
                        background: #3498db;
                        border-radius: 2px;
                    }

                    .social-entrepreneurship-section .articles-container::-webkit-scrollbar-thumb:hover {
                        background: #2980b9;
                    }

                    @media (max-width: 768px) {
                        .social-entrepreneurship-section .articles-container {
                            grid-template-columns: 1fr;
                        }
                    }

                    @media (max-width: 480px) {
                        .social-entrepreneurship-section .container {
                            margin: 10px;
                            max-width: none;
                        }

                        .social-entrepreneurship-section .articles-container {
                            padding: 0 20px 25px;
                        }

                        .social-entrepreneurship-section .article-content {
                            padding: 12px;
                        }
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Add click functionality to article cards
                        document.querySelectorAll('.social-entrepreneurship-section .article-card').forEach(card => {
                            card.addEventListener('click', function (e) {
                                e.preventDefault();

                                // Add a click animation
                                // this.style.transform = 'scale(0.98)';
                                // setTimeout(() => {
                                //     this.style.transform = 'translateY(-2px)';
                                // }, 150);

                                // Get the article title
                                //const articleTitle = this.querySelector('.article-title').textContent;

                                // Show an alert (you can replace this with actual navigation)
                                // setTimeout(() => {
                                //     alert(`Opening article: ${articleTitle}`);
                                // }, 200);
                            });
                        });

                        // Add smooth scrolling behavior
                        const articlesContainer = document.querySelector('.social-entrepreneurship-section .articles-container');

                        // Add loading animation on scroll
                        if (articlesContainer) {
                            articlesContainer.addEventListener('scroll', function () {
                                const scrollTop = this.scrollTop;
                                const scrollHeight = this.scrollHeight;
                                const clientHeight = this.clientHeight;

                                if (scrollTop + clientHeight >= scrollHeight - 10) {
                                    // Near bottom - could load more articles
                                    console.log('Near bottom of articles');
                                }
                            });
                        }
                    });
                </script>
            </section>

        </section>
    </div>
@endsection