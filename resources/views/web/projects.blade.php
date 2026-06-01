@extends('webTemplate.maintemplate')

@section('content')
    <!-- @push('styles')
                <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            @endpush -->

    <style>
        .content-section {
            padding: 20px 0;
            background: #e0e5ec !important;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
        }

        .portfolio-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: whitesmoke;
            border-radius: 20px;
            line-height: 1.6;
            width: 1200px;
            margin-left: 40px;
            margin-right: 40px;

            /* Fixed width for laptop view */
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .portfolio-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .portfolio-header h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .portfolio-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
        }

        .portfolio-navigation {
            background: whitesmoke;
            border-radius: 20px;
            padding: 25px 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .portfolio-nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .portfolio-logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e3a8a;
        }

        .portfolio-nav-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .portfolio-nav-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 0;
        }

        .portfolio-nav-link:hover,
        .portfolio-nav-link.active {
            color: #3b82f6;
        }

        /* Portfolio Grid Styling */
        .portfolio-section {
            min-height: 500px;
            /* Fixed minimum height for empty state */
            position: relative;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .empty-portfolio {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 400px;
            color: #64748b;
            font-size: 1.2rem;
            text-align: center;
            padding: 40px;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            margin: 20px 0;
            background: #f8fafc;
        }

        /* Responsive adjustments */
        @media (max-width: 1250px) {
            .portfolio-container {
                width: 95%;
                max-width: 1200px;
                margin: 0 auto;
            }
        }

        @media (max-width: 992px) {
            .portfolio-header {
                padding: 40px 20px;
            }

            .portfolio-header h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .portfolio-header h1 {
                font-size: 2rem;
            }

            .portfolio-navigation {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .portfolio-header {
                padding: 30px 15px;
            }

            .portfolio-header h1 {
                font-size: 1.8rem;
            }

            .empty-portfolio {
                height: 300px;
                padding: 20px;
            }
        }

        .portfolio-item {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .portfolio-item-image {
            height: 250px;
            position: relative;
            overflow: hidden;
            background: #f1f5f9;
            /* Fallback background */
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
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .portfolio-view-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .portfolio-item-content {
            padding: 25px;
        }

        .portfolio-item-category {
            display: inline-block;
            background: #eff6ff;
            color: #1e40af;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        .portfolio-item-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .portfolio-item-description {

            word-break: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;

            color: #64748b;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Modal Styles */
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
        }

        .modal-content {
            background: white;
            max-width: 900px;
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
            height: 450px;
            position: relative;
        }

        .modal-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-body {
            padding: 30px;
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
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
        }

        .modal-description {
            word-break: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;

            color: #64748b;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .modal-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }

        .detail-item h4 {
            font-size: 1.1rem;
            color: #1e293b;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .detail-item p {
            color: #64748b;
            font-size: 1rem;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .portfolio-grid {
                grid-template-columns: 1fr;
            }

            .portfolio-header {
                padding: 40px 20px;
            }

            .modal-image {
                height: 350px;
            }

            .portfolio-container {
                margin: 0 20px;
            }
        }

        @media (max-width: 768px) {
            .portfolio-header h1 {
                font-size: 2.2rem;
            }

            .portfolio-nav-container {
                flex-direction: column;
            }

            .portfolio-nav-links {
                justify-content: center;
            }

            .modal-image {
                height: 250px;
            }

            .modal-details {
                grid-template-columns: 1fr;
            }

            .portfolio-section {
                min-height: 400px;
            }
        }

        @media (max-width: 576px) {
            .portfolio-header {
                padding: 30px 15px;
            }

            .portfolio-header h1 {
                font-size: 1.8rem;
            }

            .portfolio-item-image {
                height: 200px;
            }

            .modal-body {
                padding: 20px;
            }

            .modal-title {
                font-size: 1.5rem;
            }

            .portfolio-section {
                min-height: 300px;
            }
        }
    </style>

    <div class="scrollable-content">
        <section class="content-section">
            <div class="portfolio-container">
                <header class="portfolio-header">
                    <h1>Professional Portfolio</h1>
                    <p class="portfolio-subtitle">Showcasing our finest creative work and innovative solutions</p>
                </header>

                <nav class="portfolio-navigation">
                    <div class="portfolio-nav-container">
                        <div class="portfolio-logo">Portfolio</div>
                        <div class="portfolio-nav-links">
                            <a href="#all" class="portfolio-nav-link active" data-filter="all">All</a>
                            @php
                                $uniqueCategories = [];
                            @endphp
                            @foreach ($portfolios as $portfolio)
                                @if (!in_array($portfolio->category, $uniqueCategories))
                                    <a href="#{{ str_replace(' ', '-', strtolower($portfolio->category)) }}"
                                        class="portfolio-nav-link"
                                        data-filter="{{ str_replace(' ', '-', strtolower($portfolio->category)) }}">
                                        {{ $portfolio->category }}
                                    </a>
                                    @php $uniqueCategories[] = $portfolio->category; @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                </nav>

                <div class="portfolio-section">
                    @if(count($portfolios) > 0)
                        <div class="portfolio-grid">
                            @foreach ($portfolios as $portfolio)
                                <div class="portfolio-item"
                                    data-category="{{ str_replace(' ', '-', strtolower($portfolio->category)) }}"
                                    onclick="openProjectModal('{{ $portfolio->id }}')">
                                    <div class="portfolio-item-image">
                                        <img src="{{ $portfolio->portfolio_image ? asset('uploads/' . $portfolio->portfolio_image) : 'https://via.placeholder.com/600x400' }}"
                                            alt="{{ $portfolio->title }}">

                                        <div class="portfolio-item-overlay">
                                            <button class="portfolio-view-btn" data-project="{{ $portfolio->id }}">
                                                View Project
                                            </button>
                                        </div>
                                    </div>
                                    <div class="portfolio-item-content">
                                        <span class="portfolio-item-category">{{ $portfolio->category }}</span>
                                        <h3 class="portfolio-item-title">{{ $portfolio->title }}</h3>
                                        <p class="portfolio-item-description">{{ $portfolio->about_project }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-portfolio">
                            <i class="fas fa-folder-open" style="font-size: 3rem; margin-bottom: 20px;"></i>
                            <h3>No Projects Found</h3>
                            <p>Our portfolio is currently being updated. Please check back soon!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Project Modal -->
            <div id="projectModal" class="portfolio-modal">
                <span class="close-modal" onclick="closeProjectModal()">×</span>
                <div class="modal-content">
                    <div class="modal-image">
                        <img id="modalImage" src="" alt="Project Image">
                    </div>
                    <div class="modal-body">
                        <span id="modalCategory" class="modal-category"></span>
                        <h2 id="modalTitle" class="modal-title"></h2>
                        <p id="modalDescription" class="modal-description"></p>
                        <div class="modal-details">
                            <div class="detail-item">
                                <h4>Client</h4>
                                <p id="modalClient"></p>
                            </div>
                            <div class="detail-item">
                                <h4>Date</h4>
                                <p id="modalDate"></p>
                            </div>
                            <div class="detail-item">
                                <h4>Services</h4>
                                <p id="modalServices"></p>
                            </div>
                            <div class="detail-item">
                                <h4>Technologies</h4>
                                <p id="modalTechnologies"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Project data for modal
        const projects = {
            @foreach ($portfolios as $portfolio)
                                                '{{ $portfolio->id }}': {
                    image: "{{ $portfolio->portfolio_image ? asset('uploads/' . $portfolio->portfolio_image) : 'https://via.placeholder.com/600x400' }}",
                    category: "{{ $portfolio->category }}",
                    title: "{{ $portfolio->title }}",
                    description: {!! json_encode($portfolio->description) !!},
                    client: "{{ $portfolio->client_name ?? 'N/A' }}",
                    date: "{{ $portfolio->date_completed ? $portfolio->date_completed : 'N/A' }}",
                    services: "{{ $portfolio->service_type ?? 'N/A' }}",
                    technologies: "{{ $portfolio->technologies_used ?? 'N/A' }}"
                },
            @endforeach
                        };

        function openProjectModal(projectId) {
            const project = projects[projectId];

            if (project) {
                document.getElementById('modalImage').src = project.image;
                document.getElementById('modalImage').alt = project.title;
                document.getElementById('modalCategory').textContent = project.category;
                document.getElementById('modalTitle').textContent = project.title;
                document.getElementById('modalDescription').innerHTML = project.description;
                document.getElementById('modalClient').textContent = project.client;
                document.getElementById('modalDate').textContent = project.date;
                document.getElementById('modalServices').textContent = project.services;
                document.getElementById('modalTechnologies').textContent = project.technologies;

                document.body.classList.add('modal-open');
                document.getElementById('projectModal').style.display = 'block';
            }
        }

        function closeProjectModal() {
            document.body.classList.remove('modal-open');
            document.getElementById('projectModal').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Navigation filtering functionality
            const navLinks = document.querySelectorAll('.portfolio-nav-link');
            const portfolioItems = document.querySelectorAll('.portfolio-item');

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

            // Close modal when clicking outside
            window.addEventListener('click', function (e) {
                if (e.target === document.getElementById('projectModal')) {
                    closeProjectModal();
                }
            });
        });
    </script>
@endsection