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
            <section class="services-section">
                <div class="container">
                    <div class="header">
                        <h1>Services</h1>
                        <div class="header-line"></div>
                    </div>

                    <div class="services-container">
                        <div class="service-card">
                            <div class="service-image logo-design"></div>
                            <div class="service-content">
                                <h3 class="service-title">Logo Identity Design</h3>
                                <p class="service-description">Create Visually Memorable And Compelling Logo Designs That
                                    Reflect Your Business Identity</p>
                                <button class="service-btn whatsapp-inquiry">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                        alt="WhatsApp" width="20">
                                    Inquiry
                                </button>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-image brand-identity"></div>
                            <div class="service-content">
                                <h3 class="service-title">Brand Identity Design</h3>
                                <p class="service-description">Develop A Complete Brand Identity System Including Logo,
                                    Color
                                    Palette, And Visual Guidelines</p>
                                <button class="service-btn whatsapp-inquiry">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                        alt="WhatsApp" width="20">
                                    Inquiry
                                </button>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-image brochure-design"></div>
                            <div class="service-content">
                                <h3 class="service-title">Brochure Design</h3>
                                <p class="service-description">Professional Tri-Fold And Bi-Fold Brochure Designs That
                                    Effectively Communicate Your Message</p>
                                <button class="service-btn whatsapp-inquiry">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                        alt="WhatsApp" width="20">
                                    Inquiry
                                </button>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-image packaging-design"></div>
                            <div class="service-content">
                                <h3 class="service-title">Product Packaging Design</h3>
                                <p class="service-description">Eye-Catching Packaging Designs That Help Products Stand Out
                                    On
                                    Retail Shelves</p>
                                <button class="service-btn whatsapp-inquiry">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                        alt="WhatsApp" width="20">
                                    Inquiry
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    @media (max-width: 768px) {
    .scrollable-content {
        display: flex;
        justify-content: center;
        padding: 0 !important;
        margin: 0 auto !important;
        width: 100% !important;
        box-sizing: border-box;
    }

    .scrollable-content > * {
        max-width: 420px;
        width: 100% !important;
        padding-left: 10px !important;
        padding-right: 10px !important;
        margin: 0 auto !important;
        box-sizing: border-box;
    }

    .contact-section,
    .content-section,
    .services-section,
    .container,
    .services-container {
        width: 100% !important;
        max-width: 420px;
        padding: 0 10px !important;
        margin: 0 auto !important;
        box-sizing: border-box;
    }

    .service-card {
        width: 100% !important;
    }
}

                    .scrollable-content {
                        scrollbar-width: none;
                        -ms-overflow-style: none;
                    }

                    .scrollable-content::-webkit-scrollbar {
                        display: none;
                    }

                    .services-section * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }

                    .services-section {
                        font-family: 'Arial', sans-serif;
                        background: var(--bg-color);
                        margin-left: 30px;
                        margin-right: 30px;

                        min-height: 100vh;
                        padding: 20px;
                    }

                    .services-section .container {
                        max-width: auto;

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
                        margin: 0 auto;
                        background: linear-gradient(90deg, #3498db, #2980b9);
                        border-radius: 2px;
                    }

                    .services-section .services-container {
                        padding: 0 25px 30px;
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        /* 2 columns */
                        gap: 20px;
                        /* Space between cards */
                    }

                    .services-section .service-card {
                        background: #f8f9fa;
                        border-radius: 12px;
                        margin-bottom: 0;
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

                    /* Service-specific real images */
                    .services-section .logo-design {
                        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1626785774573-4b799315345d?w=400&h=300&fit=crop');
                        background-size: cover;
                        background-position: center;
                    }

                    .services-section .brand-identity {
                        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1586953208448-b95a79798f07?w=400&h=300&fit=crop');
                        background-size: cover;
                        background-position: center;
                    }

                    .services-section .brochure-design {
                        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=400&h=300&fit=crop');
                        background-size: cover;
                        background-position: center;
                    }

                    .services-section .packaging-design {
                        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=300&fit=crop');
                        background-size: cover;
                        background-position: center;
                    }

                    @media (max-width: 480px) {
                        .services-section .container {
                            margin: 10px;
                            max-width: none;
                        }

                        .services-section .services-container {
                            padding: 0 20px 25px;
                        }

                        @media (max-width: 768px) {
                            .services-section .services-container {
                                grid-template-columns: 1fr;
                                /* Switch to 1 column on mobile */
                            }
                        }

                        .services-section .service-content {
                            padding: 15px;
                        }
                    }
                </style>

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
                                const phoneNumber = "919876543210"; // Replace with your actual phone number
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
            </section>

        </section>
        </div>
@endsection