@extends('mainsample.maintemplate')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush

    <style>
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
    </style>
    <div class="scrollable-content">

        <section class="content-section">
            <section id="portfolio-section">
                <style>
                    @media (max-width: 576px) {
                        .portfolio-container {
                            margin: 0 auto !important;
                            padding-left: 10px !important;
                            padding-right: 10px !important;
                            width: 100% !important;
                            box-sizing: border-box;
                        }

                        .portfolio-section {
                            padding-left: 10px !important;
                            padding-right: 10px !important;
                        }

                        .portfolio-header,
                        .portfolio-navigation,
                        .portfolio-stats-section,
                        .portfolio-footer {
                            padding-left: 10px !important;
                            padding-right: 10px !important;
                        }
                    }

                    .portfolio-container * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }

                    .portfolio-container {
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background: whitesmoke;
                        border-radius: 20px;
                        line-height: 1.6;
                        max-width: 1400px;
                        /* Wider container */
                        margin: 0 auto;
                        background: whitesmoke;
                        min-height: 100vh;
                        margin: 0 30px;
                    }

                    .portfolio-header {
                        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
                        color: white;
                        padding: 60px 40px;
                        border-radius: 20px;
                        /* More padding */
                        text-align: center;
                        position: relative;
                        overflow: hidden;
                    }

                    .portfolio-header::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
                        opacity: 0.3;
                    }

                    .portfolio-container h1 {
                        font-size: 3.5rem;
                        /* Larger heading */
                        margin-bottom: 20px;
                        font-weight: 700;
                        position: relative;
                        z-index: 1;
                    }

                    .portfolio-subtitle {
                        font-size: 1.4rem;
                        /* Larger subtitle */
                        opacity: 0.9;
                        position: relative;
                        z-index: 1;
                        font-weight: 300;
                        max-width: 800px;
                        margin: 0 auto;
                    }

                    .portfolio-navigation {
                        background: whitesmoke;
                        border-radius: 20px;
                        padding: 25px 40px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        position: sticky;
                        top: 0;
                        z-index: 100;
                    }

                    .portfolio-nav-container {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        flex-wrap: wrap;
                        gap: 20px;
                        max-width: 1200px;
                        margin: 0 auto;
                    }

                    .portfolio-logo {
                        font-size: 1.8rem;
                        /* Larger logo */
                        font-weight: 700;
                        color: #1e3a8a;
                    }

                    .portfolio-nav-links {
                        display: flex;
                        gap: 30px;
                        flex-wrap: wrap;
                    }

                    .portfolio-nav-link {
                        color: #64748b;
                        text-decoration: none;
                        font-weight: 500;
                        text-transform: uppercase;
                        font-size: 1rem;
                        /* Larger nav text */
                        letter-spacing: 0.5px;
                        transition: all 0.3s ease;
                        position: relative;
                        padding: 8px 0;
                    }

                    .portfolio-nav-link::after {
                        content: '';
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        width: 0;
                        height: 2px;
                        background: #3b82f6;
                        transition: width 0.3s ease;
                    }

                    .portfolio-nav-link:hover {
                        color: #3b82f6;
                    }

                    .portfolio-nav-link:hover::after,
                    .portfolio-nav-link.active::after {
                        width: 100%;
                    }

                    .portfolio-nav-link.active {
                        color: #3b82f6;
                    }

                    .portfolio-section {
                        padding: 60px 40px;
                        /* More padding */
                    }

                    .portfolio-section-title {
                        text-align: center;
                        margin-bottom: 50px;
                    }

                    .portfolio-section-title h2 {
                        font-size: 2.8rem;
                        /* Larger section title */
                        color: #1e293b;
                        margin-bottom: 20px;
                        font-weight: 700;
                    }

                    .portfolio-section-title p {
                        font-size: 1.2rem;
                        /* Larger description */
                        color: #64748b;
                        max-width: 800px;
                        margin: 0 auto;
                    }

                    .portfolio-grid {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        /* Wider items */
                        gap: 40px;
                        /* More space between items */
                        margin-top: 40px;
                    }

                    .portfolio-item {
                        background: white;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
                        transition: all 0.3s ease;
                        cursor: pointer;
                        position: relative;
                    }

                    .portfolio-item:hover {
                        transform: translateY(-10px);
                        /* More pronounced hover effect */
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                    }

                    .portfolio-item-image {
                        height: 280px;
                        /* Taller images */
                        background-size: cover;
                        background-position: center;
                        position: relative;
                        overflow: hidden;
                    }

                    .portfolio-item-image img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        transition: transform 0.3s ease;
                    }

                    .portfolio-item:hover .portfolio-item-image img {
                        transform: scale(1.05);
                    }

                    .portfolio-item-overlay {
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: linear-gradient(135deg, rgba(30, 58, 138, 0.9), rgba(59, 130, 246, 0.9));
                        opacity: 0;
                        transition: opacity 0.3s ease;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .portfolio-item:hover .portfolio-item-overlay {
                        opacity: 1;
                    }

                    .portfolio-view-btn {
                        background: white;
                        color: #1e3a8a;
                        padding: 12px 24px;
                        border: none;
                        border-radius: 25px;
                        font-weight: 600;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        font-size: 1rem;
                        /* Larger button text */
                    }

                    .portfolio-view-btn:hover {
                        transform: scale(1.05);
                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                    }

                    .portfolio-item-content {
                        padding: 30px;
                        /* More padding */
                    }

                    .portfolio-item-category {
                        display: inline-block;
                        background: #eff6ff;
                        color: #1e40af;
                        padding: 8px 16px;
                        /* Larger category tag */
                        border-radius: 20px;
                        font-size: 0.9rem;
                        font-weight: 600;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        margin-bottom: 15px;
                    }

                    .portfolio-item-title {
                        font-size: 1.6rem;
                        /* Larger title */
                        font-weight: 700;
                        color: #1e293b;
                        margin-bottom: 15px;
                    }

                    .portfolio-item-description {
                        color: #64748b;
                        font-size: 1.05rem;
                        /* Slightly larger text */
                        line-height: 1.7;
                    }

                    .portfolio-stats-section {
                        background: #1e3a8a;
                        color: white;
                        padding: 80px 40px;
                        /* More padding */
                        text-align: center;
                    }

                    .portfolio-stats-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                        gap: 50px;
                        /* More space between stats */
                        max-width: 1000px;
                        /* Wider stats section */
                        margin: 0 auto;
                    }

                    .portfolio-stat-item {
                        text-align: center;
                    }

                    .portfolio-stat-number {
                        font-size: 3.5rem;
                        /* Larger numbers */
                        font-weight: 700;
                        color: #60a5fa;
                        margin-bottom: 15px;
                    }

                    .portfolio-stat-label {
                        font-size: 1.2rem;
                        /* Larger labels */
                        opacity: 0.9;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                    }

                    .portfolio-footer {
                        background: #0f172a;
                        color: white;
                        padding: 60px 40px;
                        /* More padding */
                        text-align: center;
                    }

                    .portfolio-footer p {
                        opacity: 0.8;
                        margin-bottom: 30px;
                        /* More space */
                        font-size: 1.1rem;
                        /* Larger text */
                    }

                    .portfolio-social-links {
                        display: flex;
                        justify-content: center;
                        gap: 25px;
                        /* More space between icons */
                    }

                    .portfolio-social-link {
                        display: inline-block;
                        width: 60px;
                        /* Larger social icons */
                        height: 60px;
                        background: #1e40af;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        text-decoration: none;
                        color: white;
                        font-size: 1.5rem;
                        /* Larger icons */
                        transition: all 0.3s ease;
                    }

                    .portfolio-social-link:hover {
                        background: #3b82f6;
                        transform: translateY(-5px);
                        /* More pronounced hover */
                    }

                    @media (max-width: 1200px) {
                        .portfolio-grid {
                            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                        }
                    }

                    @media (max-width: 992px) {
                        .portfolio-grid {
                            grid-template-columns: 1fr;
                            /* Single column on smaller screens */
                        }
                    }

                    @media (max-width: 992px) {
                        .portfolio-header {
                            padding: 50px 30px;
                        }

                        .portfolio-container h1 {
                            font-size: 3rem;
                        }

                        .portfolio-subtitle {
                            font-size: 1.2rem;
                        }

                        .portfolio-grid {
                            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                            gap: 30px;
                        }

                        .portfolio-item-image {
                            height: 250px;
                        }
                    }

                    @media (max-width: 768px) {
                        .portfolio-header {
                            padding: 40px 20px;
                            min-height: 300px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                        }

                        .portfolio-container h1 {
                            font-size: 2.5rem;
                        }

                        .portfolio-navigation {
                            padding: 20px;
                        }

                        .portfolio-nav-container {
                            flex-direction: column;
                            text-align: center;
                        }


                        .portfolio-nav-links {
                            justify-content: center;
                            gap: 15px;
                        }

                        .portfolio-section {
                            padding: 40px 20px;
                        }

                        .portfolio-section-title h2 {
                            font-size: 2.2rem;
                        }

                        .portfolio-grid {
                            grid-template-columns: 1fr;
                            gap: 30px;
                        }

                        .portfolio-stats-section {
                            padding: 60px 20px;
                        }

                        .portfolio-stat-number {
                            font-size: 3rem;
                        }
                    }

                    @media (max-width: 576px) {
                        .portfolio-container h1 {
                            font-size: 2rem;
                        }

                        .portfolio-subtitle {
                            font-size: 1rem;
                        }

                        .portfolio-nav-link {
                            font-size: 0.9rem;
                        }

                        .portfolio-section-title h2 {
                            font-size: 1.8rem;
                            margin-bottom: 15px;
                            line-height: 1.3;
                            padding: 0 10px;
                            word-break: break-word;
                            hyphens: auto;
                            -webkit-hyphens: auto;
                            -ms-hyphens: auto;
                            -moz-hyphens: auto;
                            text-align: center;
                            display: inline-block;
                            width: 100%;
                            max-width: 100%;
                        }

                        .portfolio-item-image {
                            height: 220px;
                        }

                        .portfolio-item-title {
                            font-size: 1.4rem;
                        }

                        .portfolio-stat-number {
                            font-size: 2.5rem;
                        }

                        .portfolio-social-link {
                            width: 50px;
                            height: 50px;
                            font-size: 1.2rem;
                        }
                    }
                </style>

                <div class="portfolio-container">
                    <header class="portfolio-header">
                        <h1>Professional Portfolio</h1>
                        <p class="portfolio-subtitle">Showcasing our finest creative work and innovative solutions across
                            multiple disciplines</p>
                    </header>

                    <nav class="portfolio-navigation">
                        <div class="portfolio-nav-container">
                            <div class="portfolio-logo">Portfolio</div>
                            <div class="portfolio-nav-links">
                                <a href="#all" class="portfolio-nav-link active" data-filter="all">All</a>
                                <a href="#web-design" class="portfolio-nav-link" data-filter="web-design">Web Design</a>
                                <a href="#logo-design" class="portfolio-nav-link" data-filter="logo-design">Logo Design</a>
                                <a href="#branding" class="portfolio-nav-link" data-filter="branding">Branding</a>
                                <a href="#print-design" class="portfolio-nav-link" data-filter="print-design">Print
                                    Design</a>
                                <a href="#photography" class="portfolio-nav-link" data-filter="photography">Photography</a>
                            </div>
                        </div>
                    </nav>

                    <div class="portfolio-section">
                        <div class="portfolio-grid">
                            <!-- Web Design Projects -->
                            <div class="portfolio-item" data-category="web-design">
                                <div class="portfolio-item-image">
                                    <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=600&h=400&fit=crop"
                                        alt="Modern Website Design">
                                    <div class="portfolio-item-overlay">
                                        <button class="portfolio-view-btn" data-project="ecommerce">View Project</button>
                                    </div>
                                </div>
                                <div class="portfolio-item-content">
                                    <span class="portfolio-item-category">Web Design</span>
                                    <h3 class="portfolio-item-title">Modern E-Commerce Platform</h3>
                                    <p class="portfolio-item-description">A complete e-commerce solution with responsive
                                        design,
                                        intuitive interface, and seamless shopping experience.</p>
                                </div>
                            </div>

                            <div class="portfolio-item" data-category="web-design">
                                <div class="portfolio-item-image">
                                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop"
                                        alt="Web Development">
                                    <div class="portfolio-item-overlay">
                                        <button class="portfolio-view-btn" data-project="saas">View Project</button>
                                    </div>
                                </div>
                                <div class="portfolio-item-content">
                                    <span class="portfolio-item-category">Web Design</span>
                                    <h3 class="portfolio-item-title">SaaS Platform</h3>
                                    <p class="portfolio-item-description">Comprehensive SaaS solution with team
                                        collaboration
                                        features and responsive design.</p>
                                </div>
                            </div>

                            <div class="portfolio-item" data-category="web-design">
                                <div class="portfolio-item-image">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop"
                                        alt="Dashboard Design">
                                    <div class="portfolio-item-overlay">
                                        <button class="portfolio-view-btn" data-project="dashboard">View Project</button>
                                    </div>
                                </div>
                                <div class="portfolio-item-content">
                                    <span class="portfolio-item-category">Web Design</span>
                                    <h3 class="portfolio-item-title">Analytics Dashboard</h3>
                                    <p class="portfolio-item-description">Custom dashboard with data visualization and
                                        real-time
                                        analytics.</p>
                                </div>
                            </div>

                            <!-- Logo Design Projects -->
                            <div class="portfolio-item" data-category="logo-design">
                                <div class="portfolio-item-image">
                                    <img src="https://images.unsplash.com/photo-1558655146-d09347e92766?w=600&h=400&fit=crop"
                                        alt="Logo Design">
                                    <div class="portfolio-item-overlay">
                                        <button class="portfolio-view-btn" data-project="corporate-logo">View
                                            Project</button>
                                    </div>
                                </div>
                                <div class="portfolio-item-content">
                                    <span class="portfolio-item-category">Logo Design</span>
                                    <h3 class="portfolio-item-title">Corporate Brand Identity</h3>
                                    <p class="portfolio-item-description">Complete brand identity package for financial
                                        services
                                        company.</p>
                                </div>
                            </div>



                            <div class="portfolio-item" data-category="logo-design">
                                <div class="portfolio-item-image">
                                    <img src="https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=600&h=400&fit=crop"
                                        alt="Logo Design">
                                    <div class="portfolio-item-overlay">
                                        <button class="portfolio-view-btn" data-project="restaurant-logo">View
                                            Project</button>
                                    </div>
                                </div>
                                <div class="portfolio-item-content">
                                    <span class="portfolio-item-category">Logo Design</span>
                                    <h3 class="portfolio-item-title">Restaurant Branding</h3>
                                    <p class="portfolio-item-description">Vibrant logo and visual identity for gourmet
                                        restaurant.</p>
                                </div>
                            </div>

                            <!-- App Design Projects -->
                            <div class="portfolio-item" data-category="app-design">
                                <div class="portfolio-item-image">
                                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600&h=400&fit=crop"
                                        alt="Mobile App Design">
                                    <div class="portfolio-item-overlay">
                                        <button class="portfolio-view-btn" data-project="banking-app">View Project</button>
                                    </div>
                                </div>
                                <div class="portfolio-item-content">
                                    <span class="portfolio-item-category">App Design</span>
                                    <h3 class="portfolio-item-title">Mobile Banking App</h3>
                                    <p class="portfolio-item-description">User-friendly banking application with secure
                                        transactions.</p>
                                </div>
                            </div>

                            <!-- Print Design Projects -->
                            <div class="portfolio-item" data-category="print-design">
                                <div class="portfolio-item-image">
                                    <img src="https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=600&h=400&fit=crop"
                                        alt="Print Design">
                                    <div class="portfolio-item-overlay">
                                        <button class="portfolio-view-btn" data-project="brochure">View Project</button>
                                    </div>
                                </div>
                                <div class="portfolio-item-content">
                                    <span class="portfolio-item-category">Print Design</span>
                                    <h3 class="portfolio-item-title">Marketing Brochure</h3>
                                    <p class="portfolio-item-description">Professional marketing materials for real estate
                                        developer.</p>
                                </div>
                            </div>

                            <!-- Photography Projects -->
                            <div class="portfolio-item" data-category="photography">
                                <div class="portfolio-item-image">
                                    <img src="https://images.unsplash.com/photo-1472214103451-9374bd1c798e?w=600&h=400&fit=crop"
                                        alt="Photography">
                                    <div class="portfolio-item-overlay">
                                        <button class="portfolio-view-btn" data-project="nature-photo">View Project</button>
                                    </div>
                                </div>
                                <div class="portfolio-item-content">
                                    <span class="portfolio-item-category">Photography</span>
                                    <h3 class="portfolio-item-title">Nature Photography</h3>
                                    <p class="portfolio-item-description">Collection of professional nature and landscape
                                        photographs.</p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Project Modal -->
                <div id="projectModal" class="portfolio-modal">
                    <div class="modal-content">
                        <span class="close-modal">&times;</span>
                        <div class="modal-image">
                            <img id="modalImage" src="" alt="Project Image">
                        </div>
                        <div class="modal-body">
                            <span id="modalCategory" class="modal-category">Web Design</span>
                            <h2 id="modalTitle" class="modal-title">Project Title</h2>
                            <p id="modalDescription" class="modal-description">Project description will go here with full
                                details about the project.</p>
                            <div class="modal-details">
                                <div class="detail-item">
                                    <h4>Client</h4>
                                    <p id="modalClient">ABC Corporation</p>
                                </div>
                                <div class="detail-item">
                                    <h4>Date</h4>
                                    <p id="modalDate">January 2023</p>
                                </div>
                                <div class="detail-item">
                                    <h4>Services</h4>
                                    <p id="modalServices">Web Design, Development</p>
                                </div>
                                <div class="detail-item">
                                    <h4>Technologies</h4>
                                    <p id="modalTechnologies">HTML, CSS, JavaScript</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Navigation filtering functionality
                        const navLinks = document.querySelectorAll('.portfolio-nav-link');
                        const portfolioItems = document.querySelectorAll('.portfolio-item');

                        // Project data for modal
                        const projects = {
                            'ecommerce': {
                                image: 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=1200&h=600&fit=crop',
                                category: 'Web Design',
                                title: 'Modern E-Commerce Platform',
                                description: 'A complete e-commerce solution built with modern web technologies. This platform features a responsive design that adapts perfectly to all devices, from desktop to mobile. The intuitive user interface guides customers seamlessly through the shopping journey with clear product displays, easy navigation, and a streamlined checkout process. We implemented advanced features like personalized recommendations, wishlists, and multiple payment gateway integrations including Stripe and PayPal. The admin dashboard provides comprehensive sales analytics and inventory management tools.',
                                client: 'Fashion Retail Inc.',
                                date: 'March 2023',
                                services: 'Web Design, Frontend Development, UX Strategy',
                                technologies: 'React, Node.js, MongoDB, Stripe API, AWS'
                            },
                            'corporate-logo': {
                                image: 'https://images.unsplash.com/photo-1558655146-d09347e92766?w=1200&h=600&fit=crop',
                                category: 'Logo Design',
                                title: 'Corporate Brand Identity',
                                description: 'Complete brand identity package for a financial services company looking to modernize their image while maintaining trust and professionalism. The logo design combines geometric stability with subtle dynamic elements to represent both security and growth. We developed a comprehensive visual language including primary and secondary logos, icon systems, and detailed brand guidelines covering color usage (with Pantone references), typography hierarchy, and application examples across various media. The new identity successfully repositioned the company as both trustworthy and forward-thinking in their market.',
                                client: 'Global Finance Group',
                                date: 'January 2023',
                                services: 'Logo Design, Brand Identity, Visual System',
                                technologies: 'Adobe Illustrator, InDesign, Brand Guidelines'
                            },
                            'banking-app': {
                                image: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=1200&h=600&fit=crop',
                                category: 'App Design',
                                title: 'Mobile Banking App',
                                description: 'User-friendly mobile banking application designed for both iOS and Android platforms, with a focus on security and accessibility. The app features biometric login (Face ID and fingerprint), real-time account monitoring, money transfer capabilities between accounts and external banks, bill payment scheduling, and detailed spending analytics with customizable categories. We implemented robust security measures including end-to-end encryption, fraud detection algorithms, and instant transaction notifications. The clean interface prioritizes essential functions while maintaining accessibility standards for all users.',
                                client: 'Metro Bank',
                                date: 'November 2022',
                                services: 'UI/UX Design, Prototyping, User Testing',
                                technologies: 'Figma, Swift, Kotlin, Firebase'
                            },
                            'brochure': {
                                image: 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=1200&h=600&fit=crop',
                                category: 'Print Design',
                                title: 'Marketing Brochure',
                                description: 'Series of premium marketing materials for a luxury real estate developer showcasing their high-end properties. The brochure features stunning photography of properties, elegant typography using custom fonts, and a sophisticated color scheme that reflects the exclusive nature of the developments. We created a modular design system that could be adapted for different property types while maintaining consistent branding. The project extended to coordinating business cards, presentation folders, and sales sheets - all printed on premium paper stocks with special finishes like spot UV and foil stamping for a truly luxurious feel.',
                                client: 'Elite Properties',
                                date: 'September 2022',
                                services: 'Print Design, Art Direction, Production',
                                technologies: 'Adobe InDesign, Photoshop, Premium Printing'
                            },
                            'saas': {
                                image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200&h=600&fit=crop',
                                category: 'Web Design',
                                title: 'SaaS Platform',
                                description: 'Comprehensive SaaS solution for project management with advanced team collaboration features. The platform includes task management with Gantt chart views, time tracking integrated with payroll systems, document sharing with version control, and team communication tools including threaded discussions and video conferencing. We implemented a robust permission system allowing for complex organizational structures with multiple teams and clients. The responsive design ensures seamless experience across desktop, tablet, and mobile devices with offline capabilities for critical functions. The backend features automated backups, audit logging, and comprehensive API for integrations.',
                                client: 'TechStart Inc.',
                                date: 'May 2022',
                                services: 'Web Design, Full-stack Development, Cloud Integration',
                                technologies: 'Vue.js, Node.js, PostgreSQL, AWS'
                            },
                            'startup-logo': {
                                image: 'https://images.unsplash.com/photo-1581093450021-4a7360e9a7e9?w=1200&h=600&fit=crop',
                                category: 'Logo Design',
                                title: 'Startup Logo Package',
                                description: 'Vibrant and modern logo design for a tech startup specializing in AI solutions. The logo symbolizes innovation and forward-thinking with its dynamic shape and gradient color scheme that transitions from blue to purple, representing the intersection of technology and creativity. We created multiple logo variations including a primary mark, lettermark for social media, and simplified icon for favicons and mobile apps. The comprehensive brand style guide included detailed specifications for color usage (with both RGB and CMYK values), typography pairings, spacing rules, and examples of correct/incorrect usage across various applications from business cards to trade show displays.',
                                client: 'NeuralTech',
                                date: 'February 2022',
                                services: 'Logo Design, Brand Identity, Motion Graphics',
                                technologies: 'Adobe Illustrator, After Effects, Style Guides'
                            },
                            'nature-photo': {
                                image: 'https://images.unsplash.com/photo-1472214103451-9374bd1c798e?w=1200&h=600&fit=crop',
                                category: 'Photography',
                                title: 'Nature Photography',
                                description: 'Collection of professional nature and landscape photographs captured during expeditions to national parks across three continents. The series includes breathtaking landscapes at golden hour, intimate wildlife portraits, and detailed macro photography of flora. These images were carefully post-processed to maintain natural colors while enhancing visual impact, then licensed for use in environmental campaigns, nature publications, and corporate offices. The project required extensive planning for optimal lighting conditions and often involved hiking with heavy equipment to remote locations. Selected images were printed in large format for gallery exhibitions using museum-quality archival papers.',
                                // Only see relevant data. The system processes millions of data points daily while maintaining sub-second response times through optimized database queries and caching.',
                                client: 'Digital Reach Agency',
                                date: 'July 2022',
                                services: 'UI/UX Design, Data Visualization, API Integration',
                                technologies: 'React, D3.js, Python, BigQuery'
                            },
                            'restaurant-logo': {
                                image: 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=1200&h=600&fit=crop',
                                category: 'Logo Design',
                                title: 'Restaurant Branding',
                                description: 'Complete visual identity for a gourmet restaurant specializing in fusion cuisine. The logo combines elegant typography with an abstract food-inspired icon that works equally well on menus, signage, and packaging. We developed a rich color palette inspired by seasonal ingredients, with primary colors for regular use and seasonal accent colors that could rotate throughout the year. The branding extended to all touchpoints including menus (with a custom icon system for dietary restrictions), staff uniforms, table settings, and takeout packaging. The cohesive system created a memorable dining experience that reinforced the restaurant\'s premium positioning while maintaining approachability.',
                                client: 'Harmony Restaurant',
                                date: 'October 2022',
                                services: 'Brand Identity, Print Design, Environmental Graphics',
                                technologies: 'Adobe Creative Suite, Packaging Design'
                            }
                        };

                        // Filter projects
                        navLinks.forEach(link => {
                            link.addEventListener('click', function (e) {
                                e.preventDefault();

                                // Update active state
                                navLinks.forEach(navLink => navLink.classList.remove('active'));
                                this.classList.add('active');

                                const filter = this.getAttribute('data-filter');

                                portfolioItems.forEach(item => {
                                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                                        item.style.display = 'block';
                                    } else {
                                        item.style.display = 'none';
                                    }
                                });
                            });
                        });

                        // Modal functionality
                        const modal = document.getElementById('projectModal');
                        const closeModal = document.querySelector('.close-modal');
                        const viewButtons = document.querySelectorAll('.portfolio-view-btn');

                        viewButtons.forEach(button => {
                            button.addEventListener('click', function () {
                                const projectId = this.getAttribute('data-project');
                                const project = projects[projectId];

                                if (project) {
                                    document.getElementById('modalImage').src = project.image;
                                    document.getElementById('modalImage').alt = project.title;
                                    document.getElementById('modalCategory').textContent = project.category;
                                    document.getElementById('modalTitle').textContent = project.title;
                                    document.getElementById('modalDescription').textContent = project.description;
                                    document.getElementById('modalClient').textContent = project.client;
                                    document.getElementById('modalDate').textContent = project.date;
                                    document.getElementById('modalServices').textContent = project.services;
                                    document.getElementById('modalTechnologies').textContent = project.technologies;

                                    modal.style.display = 'block';
                                    document.body.style.overflow = 'hidden';
                                }
                            });
                        });

                        closeModal.addEventListener('click', function () {
                            modal.style.display = 'none';
                            document.body.style.overflow = 'auto';
                        });

                        window.addEventListener('click', function (e) {
                            if (e.target === modal) {
                                modal.style.display = 'none';
                                document.body.style.overflow = 'auto';
                            }
                        });
                    });
                </script>
            </section>
        </section>
    </div>
@endsection