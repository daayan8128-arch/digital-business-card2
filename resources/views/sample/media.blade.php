@extends('mainsample.maintemplate')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush

    <div class="scrollable-content">
        <section class="media-section">
            <div class="container">
                <!-- PDF Section -->
                <div class="media-section-wrapper">
                    <div class="header">
                        <h1>Our Brochures</h1>
                        <div class="header-line"></div>
                    </div>

                    <div class="media-grid">
                        <!-- Printing Services -->
                        <div class="media-card" onclick="portfolioOpenPDF('printing')">
                            <div class="media-image" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <div class="media-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="media-title">OUR PRINTING SERVICES</div>
                            </div>
                            <div class="media-content">
                                <h3 class="media-name">PRINTING SERVICES</h3>
                                <p class="media-description">Complete price list of our printing services</p>
                                <div class="media-meta">Download PDF</div>
                            </div>
                        </div>

                        <!-- Logo Design -->
                        <div class="media-card" onclick="portfolioOpenPDF('logo')">
                            <div class="media-image" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <div class="media-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="media-title">LOGO EXCHANGES</div>
                            </div>
                            <div class="media-content">
                                <h3 class="media-name">LOGO DESIGN</h3>
                                <p class="media-description">Our logo design packages and pricing</p>
                                <div class="media-meta">Download PDF</div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="media-card" onclick="portfolioOpenPDF('social')">
                            <div class="media-image" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <div class="media-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="media-title">SOCIAL MEDIA VIDEO</div>
                            </div>
                            <div class="media-content">
                                <h3 class="media-name">SOCIAL MEDIA</h3>
                                <p class="media-description">Video production and social media services</p>
                                <div class="media-meta">Download PDF</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Section -->
                <div class="media-section-wrapper">
                    <div class="header">
                        <h1>Our Videos</h1>
                        <div class="header-line"></div>
                    </div>

                    <div class="media-grid">
                        <!-- Printing Process Video -->
                        <div class="media-card" onclick="portfolioOpenVideo('M7lc1UVf-VE', 'Printing Services')">
                            <div class="media-image">
                                <img class="media-thumbnail" src="https://img.youtube.com/vi/M7lc1UVf-VE/maxresdefault.jpg"
                                    alt="Printing Services">
                                <div class="media-play-button"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="media-content">
                                <h3 class="media-name">PRINTING SERVICES</h3>
                                <p class="media-description">See our printing process in action</p>
                                <div class="media-meta">Watch Video</div>
                            </div>
                        </div>

                        <!-- Digital Services Video -->
                        <div class="media-card" onclick="portfolioOpenVideo('dQw4w9WgXcQ', 'Digital Services')">
                            <div class="media-image">
                                <img class="media-thumbnail" src="https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"
                                    alt="Digital Services">
                                <div class="media-play-button"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="media-content">
                                <h3 class="media-name">DIGITAL SERVICES</h3>
                                <p class="media-description">Our digital printing solutions</p>
                                <div class="media-meta">Watch Video</div>
                            </div>
                        </div>

                        <!-- Service Overview Video -->
                        <div class="media-card" onclick="portfolioOpenVideo('9bZkp7q19f0', 'Service Overview')">
                            <div class="media-image">
                                <img class="media-thumbnail" src="https://img.youtube.com/vi/9bZkp7q19f0/maxresdefault.jpg"
                                    alt="Service Overview">
                                <div class="media-play-button"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="media-content">
                                <h3 class="media-name">SERVICE OVERVIEW</h3>
                                <p class="media-description">Complete service portfolio</p>
                                <div class="media-meta">Watch Video</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PDF Modal -->
            <div id="portfolioPdfModal" class="portfolio-modal">
                <div class="portfolio-modal-content">
                    <div class="portfolio-modal-header">
                        <h3 class="portfolio-modal-title" id="portfolioPdfTitle">Document Viewer</h3>
                        <button class="portfolio-close-btn" onclick="portfolioClosePDF()"><i
                                class="fas fa-times"></i></button>
                    </div>
                    <iframe id="portfolioPdfViewer" class="portfolio-pdf-viewer"></iframe>
                </div>
            </div>

            <!-- Video Modal -->
            <div id="portfolioVideoModal" class="portfolio-modal">
                <div class="portfolio-modal-content">
                    <div class="portfolio-modal-header">
                        <h3 class="portfolio-modal-title" id="portfolioVideoTitle">Video Player</h3>
                        <button class="portfolio-close-btn" onclick="portfolioCloseVideo()"><i
                                class="fas fa-times"></i></button>
                    </div>
                    <iframe id="portfolioVideoPlayer" class="portfolio-video-player" allowfullscreen></iframe>
                </div>
            </div>

            <style>
                body {
                    margin: 0;
                    padding: 0;
                    overflow-x: hidden;
                    /* ❌ stop right-scroll */
                    font-family: sans-serif;
                }

                .scrollable-content {
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    /* ✅ center the 1200px content */
                     background: var(--bg-color);
                    /* optional background */
                }

                .media-section {
                    width: 1200px;
                    /* ✅ fixed width as you asked */
                    background: white;
                    /* margin-left: 30px;    */
                    /* margin-right: 30px; */
                    padding: 20px;
                    box-sizing: border-box;
                    border-radius: 10px;
                    /* box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);   */
                }

                @media (max-width: 480px) {
                    .media-section {
                        /* padding: 5px !important;  */
                    }

                    .media-section .container {
                        padding: 0 !important;
                        margin: 0 auto !important;
                        max-width: 100% !important;
                    }

                    .media-section .media-card {
                        margin: 10px 0 !important;
                        width: 300px !important;
                    }
                }

                .media-section * {
                    /* margin: 0; */
                    padding: 0;
                    box-sizing: border-box;
                }

                .media-section {
                    font-family: 'Arial', sans-serif;
                    background: var(--bg-color);
                    min-height: 1400px;
                    padding: 40px;
                    /* margin-right: 20px !important;
                    margin-left: 20px !important; */

                    /* margin: 0 30px; */
                    width: 1200px;
                    /* Changed from 1200px to match image width */
                }

                .media-section .container {
                    width: 100%;
                    margin: 0 auto;
                    background: white;
                    border-radius: 15px;
                    /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); */
                    overflow: hidden;
                    padding: 20px;
                }

                .media-section-wrapper {
                    margin-bottom: 30px;
                }

                .media-section .header {
                    padding: 0 0 20px 0;
                    background: white;
                }

                .media-section .header h1 {
                    font-size: 24px;
                    font-weight: 700;
                    color: #2c3e50;
                    margin-bottom: 8px;
                    text-align: left;
                }

                .media-section .header-line {
                    width: 200px;
                    height: 3px;
                    background: linear-gradient(90deg, #10b981, #059669);
                    border-radius: 2px;
                }

                .media-section .media-grid {
                    display: grid;
                    grid-template-columns: repeat(2, 300px);
                    /* Fixed width cards */
                    gap: 50px;
                    /* Reduced from 20px to 10px */
                }

                .media-section .media-card {
                    width: 300px;
                    margin: 0;
                    background: #f8f9fa;
                    border-radius: 12px;
                    overflow: hidden;
                    transition: all 0.3s ease;
                    border: 1px solid #e9ecef;
                }

                .media-section .media-card:hover {
                    transform: translateY(-2px);
                    /* box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); */
                    border-color: #10b981;
                }

                .media-section .media-image {
                    width: 300px;
                    height: 140px;
                    background-size: cover;
                    background-position: center;
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                .media-section .media-icon {
                    width: 50px;
                    height: 50px;
                    margin-bottom: 0.75rem;
                    position: relative;
                    z-index: 1;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .media-section .media-icon i {
                    font-size: 2rem;
                    color: white;
                    /* filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2)); */
                }

                .media-section .media-title {
                    color: white;
                    font-size: 1rem;
                    font-weight: 600;
                    position: relative;
                    z-index: 1;
                    text-align: center;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
                    padding: 0 0.5rem;
                }

                .media-section .media-thumbnail {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.3s ease;
                }

                .media-section .media-card:hover .media-thumbnail {
                    transform: scale(1.05);
                }

                .media-section .media-play-button {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 50px;
                    height: 50px;
                    background: rgba(255, 255, 255, 0.95);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #10b981;
                    font-size: 1.25rem;
                    /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); */
                    transition: all 0.3s;
                }

                .media-section .media-card:hover .media-play-button {
                    background: white;
                    transform: translate(-50%, -50%) scale(1.1);
                    color: #059669;
                    /* box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3); */
                }

                .media-section .media-content {
                    padding: 15px;
                }

                .media-section .media-name {
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

                .media-section .media-description {
                    font-size: 12px;
                    color: #7f8c8d;
                    line-height: 1.4;
                    display: -webkit-box;
                    -webkit-line-clamp: 3;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }

                .media-section .media-meta {
                    font-size: 11px;
                    color: #10b981;
                    margin-top: 8px;
                    padding-top: 8px;
                    border-top: 1px solid #ecf0f1;
                    font-weight: 600;
                }

                /* Modal Styles */
                .portfolio-modal {
                    display: none;
                    position: fixed;
                    z-index: 1000;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.9);
                    backdrop-filter: blur(8px);
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .portfolio-modal.show {
                    opacity: 1;
                }

                .portfolio-modal-content {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) scale(0.95);
                    width: 90%;
                    height: 90%;
                    max-width: 1000px;
                    background: white;
                    border-radius: 1rem;
                    overflow: hidden;
                    /* box-shadow: 0 24px 48px rgba(0, 0, 0, 0.3); */
                    transition: transform 0.3s ease;
                }

                .portfolio-modal.show .portfolio-modal-content {
                    transform: translate(-50%, -50%) scale(1);
                }

                .portfolio-modal-header {
                    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                    color: white;
                    padding: 1rem 1.25rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .portfolio-modal-title {
                    font-size: 1.1rem;
                    font-weight: 600;
                }

                .portfolio-close-btn {
                    background: none;
                    border: none;
                    color: white;
                    font-size: 1.25rem;
                    cursor: pointer;
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: background 0.2s;
                }

                .portfolio-close-btn:hover {
                    background: rgba(255, 255, 255, 0.15);
                }

                .portfolio-pdf-viewer,
                .portfolio-video-player {
                    width: 100%;
                    height: calc(100% - 60px);
                    border: none;
                }

                @media (max-width: 768px) {
                    .media-section .media-grid {
                        grid-template-columns: 300px;
                        /* Single column on mobile */
                        gap: 15px;
                    }
                }
            </style>

            <script>
                // Professional PDF content with consistent green color scheme
                const portfolioPdfCatalogs = {
                    'printing': portfolioCreateServicePDF(
                        "OUR PRINTING SERVICES",
                        "Shree Gayatri Impression",
                        [
                            "Digital Printing Services",
                            "Offset Printing Solutions",
                            "Large Format Printing",
                            "Business Cards & Stationery",
                            "Brochures & Flyers",
                            "Packaging Printing"
                        ],
                        "Price List and Service Catalog"
                    ),
                    'logo': portfolioCreateServicePDF(
                        "LOGO EXCHANGES",
                        "Shree Gayatri Impression",
                        [
                            "Basic Logo Design",
                            "Premium Logo Package",
                            "Brand Identity Design",
                            "Business Card Design",
                            "Social Media Kit",
                            "Complete Brand Guidelines"
                        ],
                        "Logo Design Packages and Pricing"
                    ),
                    'social': portfolioCreateServicePDF(
                        "SOCIAL MEDIA VIDEO",
                        "Shree Gayatri Impression",
                        [
                            "Social Media Content Creation",
                            "Promotional Videos",
                            "Animation Services",
                            "Video Editing",
                            "Social Media Management",
                            "Content Strategy"
                        ],
                        "Social Media Video Services"
                    )
                };

                function portfolioCreateServicePDF(title, company, services, description) {
                    const servicesList = services.map(service => `• ${service}`).join('\n');

                    const pdfContent = `%PDF-1.4
                                            1 0 obj
                                            <<
                                            /Title (${title})
                                            /Author (${company})
                                            /Creator (Shree Gayatri Impression)
                                            /Producer (Professional Portfolio PDF)
                                            >>
                                            endobj
                                            2 0 obj
                                            <<
                                            /Type /Catalog
                                            /Pages 3 0 R
                                            >>
                                            endobj
                                            3 0 obj
                                            <<
                                            /Type /Pages
                                            /Kids [4 0 R]
                                            /Count 1
                                            >>
                                            endobj
                                            4 0 obj
                                            <<
                                            /Type /Page
                                            /Parent 3 0 R
                                            /MediaBox [0 0 612 792]
                                            /Contents 5 0 R
                                            /Resources <<
                                            /Font <<
                                            /F1 <<
                                            /Type /Font
                                            /Subtype /Type1
                                            /BaseFont /Helvetica-Bold
                                            >>
                                            /F2 <<
                                            /Type /Font
                                            /Subtype /Type1
                                            /BaseFont /Helvetica
                                            >>
                                            >>
                                            >>
                                            endobj
                                            5 0 obj
                                            <<
                                            /Length 400
                                            >>
                                            stream
                                            BT
                                            /F1 24 Tf
                                            1 0 0 1 50 750 Tm
                                            0 0.4 0.2 rg
                                            (${title}) Tj
                                            ET
                                            BT
                                            /F2 12 Tf
                                            1 0 0 1 50 700 Tm
                                            0 0 0 rg
                                            (${company}) Tj
                                            ET
                                            BT
                                            /F2 12 Tf
                                            1 0 0 1 50 670 Tm
                                            0 0 0 rg
                                            (${description}) Tj
                                            ET
                                            BT
                                            /F1 14 Tf
                                            1 0 0 1 50 620 Tm
                                            0 0.4 0.2 rg
                                            (OUR SERVICES:) Tj
                                            ET
                                            BT
                                            /F2 12 Tf
                                            1 0 0 1 70 580 Tm
                                            0 0 0 rg
                                            (${servicesList}) Tj
                                            ET
                                            BT
                                            /F2 10 Tf
                                            1 0 0 1 50 100 Tm
                                            0 0.4 0.2 rg
                                            (Contact us: info@gayatriimpression.com | +91 9876543210) Tj
                                            ET
                                            endstream
                                            endobj
                                            xref
                                            0 6
                                            0000000000 65535 f 
                                            0000000015 00000 n 
                                            0000000119 00000 n 
                                            0000000168 00000 n 
                                            0000000225 00000 n 
                                            0000000325 00000 n 
                                            trailer
                                            <<
                                            /Size 6
                                            /Root 2 0 R
                                            >>
                                            startxref
                                            495
                                            %%EOF`;

                    return 'data:application/pdf;base64,' + btoa(pdfContent);
                }

                function portfolioOpenPDF(type) {
                    const modal = document.getElementById('portfolioPdfModal');
                    const pdfViewer = document.getElementById('portfolioPdfViewer');
                    const pdfTitle = document.getElementById('portfolioPdfTitle');

                    const titles = {
                        'printing': 'OUR PRINTING SERVICES',
                        'logo': 'LOGO EXCHANGES',
                        'social': 'SOCIAL MEDIA VIDEO'
                    };

                    pdfTitle.textContent = titles[type] || 'Document Viewer';

                    if (portfolioPdfCatalogs[type]) {
                        pdfViewer.src = portfolioPdfCatalogs[type];
                    }

                    modal.style.display = 'block';
                    setTimeout(() => {
                        modal.classList.add('show');
                    }, 10);
                    document.body.style.overflow = 'hidden';
                }

                function portfolioClosePDF() {
                    const modal = document.getElementById('portfolioPdfModal');
                    const pdfViewer = document.getElementById('portfolioPdfViewer');

                    modal.classList.remove('show');
                    setTimeout(() => {
                        modal.style.display = 'none';
                        pdfViewer.src = '';
                    }, 300);
                    document.body.style.overflow = 'auto';
                }

                function portfolioOpenVideo(videoId, title) {
                    const modal = document.getElementById('portfolioVideoModal');
                    const videoPlayer = document.getElementById('portfolioVideoPlayer');
                    const videoTitle = document.getElementById('portfolioVideoTitle');

                    videoTitle.textContent = title || 'Portfolio Video';
                    videoPlayer.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;

                    modal.style.display = 'block';
                    setTimeout(() => {
                        modal.classList.add('show');
                    }, 10);
                    document.body.style.overflow = 'hidden';
                }

                function portfolioCloseVideo() {
                    const modal = document.getElementById('portfolioVideoModal');
                    const videoPlayer = document.getElementById('portfolioVideoPlayer');

                    modal.classList.remove('show');
                    setTimeout(() => {
                        modal.style.display = 'none';
                        videoPlayer.src = '';
                    }, 300);
                    document.body.style.overflow = 'auto';
                }

                // Close modal when clicking outside
                window.onclick = function (event) {
                    const pdfModal = document.getElementById('portfolioPdfModal');
                    const videoModal = document.getElementById('portfolioVideoModal');
                    if (event.target === pdfModal) {
                        portfolioClosePDF();
                    }
                    if (event.target === videoModal) {
                        portfolioCloseVideo();
                    }
                }

                // Close modal with Escape key
                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        portfolioClosePDF();
                        portfolioCloseVideo();
                    }
                });
            </script>
        </section>
    </div>
@endsection