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

        .services-section {
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

        .services-section .container {
            width: 100%;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .services-section .header {
            padding: 30px 25px 20px;
            background: white;
        }

        .services-section .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .services-section .header-line {
            width: 100px;
            height: 3px;
            margin-left: 285px;
            background: linear-gradient(90deg, #3498db, #2980b9);
            border-radius: 2px;
        }

        .services-section .services-container {
            padding: 0 25px 30px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            min-height: 400px;
            /* Minimum height for empty state */
            position: relative;
        }

        /* Empty State Styles */
        .empty-services {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
            padding: 0 20px;
        }

        .empty-services-icon {
            font-size: 3rem;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .empty-services h3 {
            color: #334155;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .empty-services p {
            color: #64748b;
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Service Card Styles */
        .services-section .service-card {
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .services-section .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .services-section .service-image {
            width: 100%;
            height: 180px;
            background-size: cover;
            background-position: center;
            position: relative;
            background-color: #e9ecef;
            /* Fallback background */
        }

        .services-section .service-content {
            padding: 20px;
        }

        .services-section .service-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .services-section .service-description {
            word-break: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;

            font-size: 14px;
            color: #7f8c8d;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .services-section .service-btn {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .services-section .service-btn:hover {
            background: linear-gradient(135deg, #128C7E, #075E54);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        /* Responsive Styles */
        @media (max-width: 1250px) {
            .services-section {
                width: 95%;
                max-width: 1200px;
            }
        }

        @media (max-width: 992px) {
            .services-section .services-container {
                grid-template-columns: 1fr;
            }

            .services-section .header h1 {
                font-size: 24px;
            }
        }

        @media (max-width: 768px) {
            .services-section {
                padding: 15px;
            }

            .services-section .container {
                border-radius: 10px;
            }

            .services-section .header {
                padding: 25px 20px 15px;
            }

            .empty-services-icon {
                font-size: 2.5rem;
            }

            .empty-services h3 {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .services-section {
                padding: 10px;
            }

            .services-section .header {
                padding: 20px 15px 10px;
            }

            .services-section .header h1 {
                font-size: 20px;
            }

            .services-section .services-container {
                padding: 0 15px 20px;
            }

            .services-section .service-content {
                padding: 15px;
            }

            .services-section .service-title {
                font-size: 16px;
            }

            .services-section .service-description {
                font-size: 13px;
            }
        }
    </style>

    <div class="scrollable-content">
        <section class="content-section">
            <section class="services-section">
                <div class="container">
                    <div class="header">
                        <h1>Services</h1>
                        <div class="header-line"></div>
                    </div>

                    <div class="services-container">
                        @if(count($services) > 0)
                            @foreach ($services as $service)
                                <div class="service-card">
                                    <div class="service-image"
                                        style="background-image: url('{{ $service->service_image ? asset('uploads/' . $service->service_image) : 'https://via.placeholder.com/600x400' }}');">
                                    </div>

                                    <div class="service-content">
                                        <h3 class="service-title">{{ $service->service_name }}</h3>
                                        <p class="service-description">{{ $service->service_description }}</p>
                                        <button class="service-btn whatsapp-inquiry">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                                alt="WhatsApp" width="20">
                                            Inquiry
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-services">
                                <i class="fas fa-concierge-bell empty-services-icon"></i>
                                <h3>No Services Available</h3>
                                <p>We're currently updating our service offerings. Please check back soon!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // WhatsApp inquiry functionality
            document.querySelectorAll('.whatsapp-inquiry').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Add a click animation
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(-1px)';
                    }, 150);

                    // Get the service title
                    const serviceTitle = this.closest('.service-card').querySelector('.service-title').textContent;
                    const phoneNumber = "{{$details->phone ?? '1234567890'}}"; // Fallback number if not set
                    const message = `Hi, I'm interested in your ${serviceTitle} service. Can you provide more details?`;

                    // Open WhatsApp with the message
                    setTimeout(() => {
                        window.open(`https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`, '_blank');
                    }, 200);
                });
            });

            // Add hover effects for service cards
            document.querySelectorAll('.service-card').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.borderColor = '#25D366';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.borderColor = '#e9ecef';
                });
            });
        });
    </script>
@endsection