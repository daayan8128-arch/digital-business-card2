@extends('mainsample.maintemplate')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush

    <div class="sg-scrollable-content">
        <section class="sg-contact-section">
            <!-- Success message -->
            <div class="sg-alert-message" id="sgSuccessMessage">
                <i class="fas fa-check-circle"></i>
                <span>Message sent successfully!</span>
            </div>

            <div class="sg-contact-container">
                <!-- Contact Header -->
                <div class="sg-contact-header">
                    <h1>Connect With Us</h1>
                    <div class="sg-decorative-line"></div>
                    <p class="sg-subtitle">Have questions or want to discuss a project? We're here to help.</p>
                </div>

                <!-- Contact Content - Stacked Layout -->
                <div class="sg-contact-content">
                    <!-- Contact Info Section -->
                    <div class="sg-contact-info-section">
                        <div class="sg-contact-info">
                            <div class="sg-info-card">
                                <div class="sg-info-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="sg-info-content">
                                    <h3>Phone Numbers</h3>
                                    <p>+91 93248 25523<br>+91 98765 43210</p>
                                </div>
                            </div>

                            <div class="sg-info-card">
                                <div class="sg-info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="sg-info-content">
                                    <h3>Email Address</h3>
                                    <p>info@gayatriimpression.com<br>support@gayatriimpression.com</p>
                                </div>
                            </div>

                            <div class="sg-info-card">
                                <div class="sg-info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="sg-info-content">
                                    <h3>Office Location</h3>
                                    <p>10, Shivam Gurukrupa, Bapunagar<br>Near Corner, Adarsh Society<br>Ahmedabad</p>
                                </div>
                            </div>

                            <div class="sg-info-card">
                                <div class="sg-info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="sg-info-content">
                                    <h3>Business Hours</h3>
                                    <p>Mon-Fri: 9:00 AM - 6:00 PM<br>Sat: 10:00 AM - 4:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form Section -->
                    <div class="sg-contact-form-section">
                        <div class="sg-form-header">
                            <h2>Send Us a Message</h2>
                            <p class="sg-form-subtitle">We'll respond within 24 hours</p>
                        </div>

                        <form id="sgContactForm" class="sg-contact-form">
                            <div class="sg-form-row">
                                <div class="sg-form-group">
                                    <label for="sgName">Full Name <span>*</span></label>
                                    <div class="sg-input-group">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="sgName" name="name" required placeholder="Your name">
                                    </div>
                                </div>

                                <div class="sg-form-group">
                                    <label for="sgEmail">Email <span>*</span></label>
                                    <div class="sg-input-group">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" id="sgEmail" name="email" required placeholder="your@email.com">
                                    </div>
                                </div>
                            </div>

                            <div class="sg-form-row">
                                <div class="sg-form-group">
                                    <label for="sgPhone">Phone</label>
                                    <div class="sg-input-group">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" id="sgPhone" name="phone" placeholder="+91 98765 43210">
                                    </div>
                                </div>

                                <div class="sg-form-group">
                                    <label for="sgSubject">Subject</label>
                                    <div class="sg-input-group">
                                        <i class="fas fa-tag"></i>
                                        <input type="text" id="sgSubject" name="subject" placeholder="Inquiry about...">
                                    </div>
                                </div>
                            </div>

                            <div class="sg-form-group">
                                <label for="sgMessage">Message <span>*</span></label>
                                <div class="sg-textarea-group">
                                    <i class="fas fa-comment-dots"></i>
                                    <textarea id="sgMessage" name="message" required placeholder="Your message..."></textarea>
                                </div>
                            </div>

                            <button type="submit" class="sg-submit-btn">
                                <span>Send Message</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

                /* Base Styles */
                .sg-contact-section {
                    font-family: 'Poppins', sans-serif;

       background: var(--bg-color);                    min-height: auto;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 2px 20px;
                    position: relative;
                }

                /* Alert Message */
                .sg-alert-message {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: #4CAF50;
                    color: white;
                    padding: 12px 20px;
                    border-radius: 6px;
                    font-weight: 500;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                    opacity: 0;
                    transform: translateY(-20px);
                    transition: all 0.3s ease;
                    z-index: 1000;
                    font-size: 14px;
                }

                .sg-alert-message i {
                    font-size: 18px;
                }

                .sg-alert-message.show {
                    opacity: 1;
                    transform: translateY(0);
                }

                /* Main Container */
                .sg-contact-container {
                    background: white;
                    border-radius: 12px;
                    margin-left: 10px !important;
                    margin-right: 10px !important;
                    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
                    /* max-width: 1200px;    */
                    width: 745px;
                    padding: 40px;
                    margin: 20px 0;
                }

                /* Contact Header */
                .sg-contact-header {
                    text-align: center;
                    margin-bottom: 30px;
                }

                .sg-contact-header h1 {
                    font-size: 28px;
                    font-weight: 700;
                    color: #2d3748;
                    margin-bottom: 10px;
                }

                .sg-decorative-line {
                    width: 50px;
                    height: 3px;
                    background: #667eea;
                    border-radius: 2px;
                    margin: 15px auto;
                }

                .sg-subtitle {
                    font-size: 15px;
                    color: #718096;
                    line-height: 1.5;
                }

                /* Contact Content */
                .sg-contact-content {
                    display: flex;
                    flex-direction: column;
                    gap: 30px;
                }

                /* Contact Info Section */
                .sg-contact-info {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 20px;
                }

                .sg-info-card {
                    display: flex;
                    align-items: flex-start;
                    padding: 15px;
                    background: #f8fafc;
                    border-radius: 8px;
                    transition: all 0.2s ease;
                    border: 1px solid #e2e8f0;
                }

                .sg-info-card:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                }

                .sg-info-icon {
                    width: 36px;
                    height: 36px;
                    background: #667eea;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-right: 15px;
                    color: white;
                    font-size: 16px;
                }

                .sg-info-content h3 {
                    font-size: 15px;
                    font-weight: 600;
                    color: #2d3748;
                    margin-bottom: 5px;
                }

                .sg-info-content p {
                    font-size: 13px;
                    line-height: 1.5;
                    color: #4a5568;
                }

                /* Contact Form Section */
                .sg-form-header {
                    margin-bottom: 20px;
                }

                .sg-form-header h2 {
                    font-size: 22px;
                    font-weight: 600;
                    color: #2d3748;
                    margin-bottom: 5px;
                }

                .sg-form-subtitle {
                    font-size: 14px;
                    color: #718096;
                }

                /* Form Elements */
                .sg-contact-form {
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                }

                .sg-form-row {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 15px;
                }

                .sg-form-group {
                    position: relative;
                }

                .sg-form-group label {
                    display: block;
                    margin-bottom: 8px;
                    font-size: 13px;
                    font-weight: 500;
                    color: #4a5568;
                }

                .sg-form-group label span {
                    color: #e53e3e;
                }

                .sg-input-group, .sg-textarea-group {
                    position: relative;
                }

                .sg-input-group i, .sg-textarea-group i {
                    position: absolute;
                    left: 15px;
                    top: 50%;
                    transform: translateY(-50%);
                    color: #a0aec0;
                    font-size: 15px;
                }

                .sg-form-group input {
                    width: 100%;
                    padding: 12px 15px 12px 40px;
                    border: 1px solid #e2e8f0;
                    border-radius: 8px;
                    font-size: 14px;
                    background: #f8fafc;
                    transition: all 0.2s ease;
                    color: #2d3748;
                }

                .sg-form-group input:focus {
                    outline: none;
                    border-color: #667eea;
                    background: white;
                    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                }

                .sg-textarea-group i {
                    top: 15px;
                    transform: none;
                }

                .sg-form-group textarea {
                    width: 100%;
                    padding: 15px 15px 15px 40px;
                    border: 1px solid #e2e8f0;
                    border-radius: 8px;
                    font-size: 14px;
                    background: #f8fafc;
                    min-height: 120px;
                    resize: vertical;
                    transition: all 0.2s ease;
                    color: #2d3748;
                }

                .sg-form-group textarea:focus {
                    outline: none;
                    border-color: #667eea;
                    background: white;
                    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                }

                /* Submit Button */
                .sg-submit-btn {
                    background: #667eea;
                    color: white;
                    border: none;
                    padding: 14px;
                    border-radius: 8px;
                    font-size: 15px;
                    font-weight: 500;
                    cursor: pointer;
                    margin-top: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    transition: all 0.2s ease;
                }

                .sg-submit-btn:hover {
                    background: #5a6fdb;
                    transform: translateY(-1px);
                }

                /* Responsive Design */
                @media (max-width: 768px) {
                    .sg-contact-container {
                        padding: 30px 20px;
                    }

                    .sg-form-row {
                        grid-template-columns: 1fr;
                    }

                    .sg-contact-info {
                        grid-template-columns: 1fr;
                    }
                }

                @media (max-width: 480px) {
                    .sg-contact-header h1 {
                        font-size: 24px;
                    }

                    .sg-contact-container {
                        padding: 25px 15px;
                    }
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const contactForm = document.getElementById('sgContactForm');
                    const successMessage = document.getElementById('sgSuccessMessage');
                    
                    // Form submission
                    contactForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        // Simple validation
                        const name = document.getElementById('sgName').value;
                        const email = document.getElementById('sgEmail').value;
                        const message = document.getElementById('sgMessage').value;
                        
                        if(name && email && message) {
                            // Show success message
                            successMessage.classList.add('show');
                            
                            // Reset form
                            contactForm.reset();
                            
                            // Hide message after 4 seconds
                            setTimeout(() => {
                                successMessage.classList.remove('show');
                            }, 4000);
                        }
                    });
                });
            </script>
        </section>
    </div>
@endsection