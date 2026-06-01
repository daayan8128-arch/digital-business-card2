@extends('webTemplate.maintemplate')
@php
    $pdfs = $medias->filter(fn($item) => $item->media_file);
    $videos = $medias->filter(fn($item) => $item->video_url);
@endphp

@section('content')
     

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: sans-serif;
        }

        .scrollable-content {
            width: 100%;
            display: flex;
            justify-content: center;
            background: var(--bg-color);
        }

        .media-section {
            width: 1200px;
            background: white;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 10px;
        }

        @media (max-width: 480px) {
            .media-section {
                padding: 5px !important;
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
            padding: 0;
            box-sizing: border-box;
        }

        .media-section {
            font-family: 'Arial', sans-serif;
            background: var(--bg-color);
            min-height: 1400px;
            padding: 40px;
            width: 1200px;
        }

        .media-section .container {
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
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
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 50px;
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
            cursor: pointer;
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
            transition: all 0.3s;
        }

        .media-section .media-card:hover .media-play-button {
            background: white;
            transform: translate(-50%, -50%) scale(1.1);
            color: #059669;
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
            cursor: pointer;
        }

        .media-section .media-meta:hover {
            color: #059669;
        }

        .media-section .media-actions {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .media-section .media-action-btn {
            flex: 1;
            padding: 6px 10px;
            font-size: 12px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: background 0.3s;
        }

        .media-section .media-action-btn:hover {
            background: #059669;
        }

        .media-section .media-action-btn i {
            font-size: 12px;
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
            position: relative;
            display: flex;
            flex-direction: column;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.95);
            width: 90%;
            height: 90%;
            max-width: 1000px;
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .portfolio-modal.show .portfolio-modal-content {
            transform: translate(-50%, -50%) scale(1);
        }

        .portfolio-modal-header {
            z-index: 2;
            position: relative;
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
                grid-template-columns: 1fr;
                gap: 15px;
                justify-items: center;
            }

            .media-section .media-card {
                width: 100%;
                max-width: 300px;
            }

            .media-section .media-image {
                width: 100%;
            }

            .media-section .media-actions {
                flex-direction: column;
            }
        }

        /* Previous styles remain the same, just adding new ones below */

        .video-container {
            z-index: 1;
            position: relative;
            flex: 1;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            background: #000;
        }

        .portfolio-video-player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Fallback for thumbnail loading */
        .media-thumbnail {
            transition: all 0.3s ease;
        }

        .media-card:hover .media-thumbnail {
            transform: scale(1.05);
            opacity: 0.9;
        }

        .media-meta {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            color: #10b981;
            font-weight: 600;
            transition: color 0.3s;
        }

        .media-meta:hover {
            color: #059669;
        }

        .media-meta i {
            font-size: 12px;
        }
    </style>
    <div class="scrollable-content">
        <section class="media-section">
            <div class="container">
                <!-- PDF Section -->

                @if ($pdfs->count())
                    <div class="media-section-wrapper">
                        <div class="header">
                            <h1>Our Brochures</h1>
                            <div class="header-line"></div>
                        </div>

                        <div class="media-grid">
                            @foreach ($medias as $mediaItem)
                                @if($mediaItem->media_file)
                                    <div class="media-card">
                                        <div class="media-image" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                            <div class="media-icon">
                                                <i class="fas fa-file-pdf"></i>
                                            </div>
                                            <div class="media-title">{{ $mediaItem->pdf_title }}</div>
                                        </div>
                                        <div class="media-content">
                                            <h3 class="media-name">{{ $mediaItem->pdf_name }}</h3>
                                            <p class="media-description">{{ $mediaItem->pdf_description }}</p>
                                            <div class="media-actions">
                                                <button class="media-action-btn"
                                                    onclick="portfolioOpenPDF('{{ asset('uploads/media/' . $mediaItem->media_file) }}', '{{ $mediaItem->pdf_title }}')">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                                <a href="{{ asset('uploads/media/' . $mediaItem->media_file) }}"
                                                    class="media-action-btn" download>
                                                    <i class="fas fa-download"></i> Download
                                                </a>

                                                
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                <!-- Video Section -->
                @if ($videos->count())
                    <div class="media-section-wrapper">
                        <div class="header">
                            <h1>Our Videos</h1>
                            <div class="header-line"></div>
                        </div>

                        <div class="media-grid">
                            @foreach ($medias as $mediaItem)
                                @if($mediaItem->video_url)

                                    @php
                                        // Extract YouTube video ID from URL
                                        $videoId = '';
                                        $url = $mediaItem->video_url;

                                        // Handle different YouTube URL formats
                                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
                                            $videoId = $matches[1];
                                        }
                                    @endphp

                                    @if($videoId)
                                        <div class="media-card">
                                            <div class="media-image"
                                                onclick="portfolioOpenVideo('{{ $videoId }}', '{{ $mediaItem->video_name }}')">
                                                <img class="media-thumbnail"
                                                    src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg"
                                                    alt="{{ $mediaItem->video_name }}"
                                                    onerror="this.onerror=null;this.src='https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg'">
                                                <div class="media-play-button"><i class="fas fa-play"></i></div>
                                            </div>
                                            <div class="media-content">
                                                <h3 class="media-name">{{ $mediaItem->video_name }}</h3>
                                                <p class="media-description">{{ $mediaItem->video_description }}</p>
                                                <div class="media-meta"
                                                    onclick="portfolioOpenVideo('{{ $videoId }}', '{{ $mediaItem->video_name }}')">
                                                    <i class="fas fa-play"></i> Watch Video
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
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
                    <div class="video-container">
                        <iframe id="portfolioVideoPlayer" class="portfolio-video-player" allowfullscreen></iframe>
                    </div>
                </div>
            </div>


            <script>

                function portfolioOpenPDF(pdfUrl, title) {
                    const modal = document.getElementById('portfolioPdfModal');
                    const pdfViewer = document.getElementById('portfolioPdfViewer');
                    const pdfTitle = document.getElementById('portfolioPdfTitle');

                    pdfTitle.textContent = title || 'Document Viewer';
                    pdfViewer.src = pdfUrl + '#toolbar=0&navpanes=0&scrollbar=0';

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

                    videoTitle.textContent = title || 'Video Player';
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
                function portfolioOpenVideo(videoId, title) {
                    const modal = document.getElementById('portfolioVideoModal');
                    const videoPlayer = document.getElementById('portfolioVideoPlayer');
                    const videoTitle = document.getElementById('portfolioVideoTitle');

                    if (!videoId) {
                        alert('Invalid video URL');
                        return;
                    }

                    videoTitle.textContent = title || 'Video Player';
                    videoPlayer.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1&enablejsapi=1`;

                    modal.style.display = 'block';
                    setTimeout(() => {
                        modal.classList.add('show');
                    }, 10);
                    document.body.style.overflow = 'hidden';
                }

                function portfolioCloseVideo() {
                    const modal = document.getElementById('portfolioVideoModal');
                    const videoPlayer = document.getElementById('portfolioVideoPlayer');

                    // Stop the video when closing
                    videoPlayer.src = '';

                    modal.classList.remove('show');
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 300);
                    document.body.style.overflow = 'auto';
                }

                // Close modal when clicking outside
                window.onclick = function (event) {
                    const videoModal = document.getElementById('portfolioVideoModal');
                    if (event.target === videoModal) {
                        portfolioCloseVideo();
                    }
                }

                // Close modal with Escape key
                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        portfolioCloseVideo();
                    }
                });
            </script>
        </section>
    </div>
@endsection