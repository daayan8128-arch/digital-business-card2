@extends('webTemplate.maintemplate')

@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
<style>
/* Contact page styles scoped under .sg-contact-page to avoid leakage */
.sg-contact-page {
    width: 100%;
    /* background: #f8f9fa; */
    padding: 40px 0;
    box-sizing: border-box;
}

.sg-contact-page .sg-contact-container {
    width: 100% !important;
    max-width: 1140px !important;
    margin: 0 auto !important;
    padding: 40px 30px;
    box-sizing: border-box;
}

.sg-contact-page .sg-contact-header {
    text-align: center;
    margin-bottom: 40px;
}

.sg-contact-page .sg-contact-header h1 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 15px;
}

.sg-contact-page .sg-decorative-line {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #10b981, #059669);
    margin: 0 auto 20px;
    border-radius: 2px;
}

.sg-contact-page .sg-subtitle {
    font-size: 1.1rem;
    color: #7f8c8d;
    max-width: 600px;
    margin: 0 auto;
}

.sg-contact-page .sg-contact-content {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    margin-top: 30px;
}

.sg-contact-page .sg-contact-info-section,
.sg-contact-page .sg-contact-form-section {
    flex: 1;
    min-width: 300px;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.sg-contact-page .sg-info-card {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid #eee;
}

.sg-contact-page .sg-info-card:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.sg-contact-page .sg-info-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    flex-shrink: 0;
    color: white;
    font-size: 1.2rem;
}

.sg-contact-page .sg-info-content h3 {
    font-size: 1.2rem;
    color: #2c3e50;
    margin-bottom: 8px;
}

.sg-contact-page .sg-info-content p {
    color: #7f8c8d;
    line-height: 1.6;
    margin: 0;
}

.sg-contact-page .sg-form-header { margin-bottom: 25px; }
.sg-contact-page .sg-form-header h2 { font-size: 1.8rem; color: #2c3e50; margin-bottom: 8px; }
.sg-contact-page .sg-form-subtitle { color: #7f8c8d; margin: 0; }

.sg-contact-page .sg-form-row { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px; }
.sg-contact-page .sg-form-group { flex: 1; min-width: 200px; }
.sg-contact-page .sg-form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600; }
.sg-contact-page .sg-form-group label span { color: #e74c3c; }

.sg-contact-page .sg-input-group { position: relative; }
.sg-contact-page .sg-input-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #7f8c8d; }
.sg-contact-page .sg-input-group input { width: 100%; padding: 12px 15px 12px 45px; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; transition: all 0.3s; }
.sg-contact-page .sg-input-group input:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,0.1); outline: none; }

.sg-contact-page .sg-textarea-group { position: relative; }
.sg-contact-page .sg-textarea-group i { position: absolute; left: 15px; top: 18px; color: #7f8c8d; }
.sg-contact-page .sg-textarea-group textarea { width: 100%; padding: 12px 15px 12px 45px; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; min-height: 150px; resize: vertical; transition: all 0.3s; }
.sg-contact-page .sg-textarea-group textarea:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,0.1); outline: none; }

.sg-contact-page .sg-submit-btn { background: linear-gradient(135deg,#10b981 0%,#059669 100%); color: #fff; border: none; padding: 12px 25px; border-radius: 6px; font-size: 1rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s; margin-top: 15px; }
.sg-contact-page .sg-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(16,185,129,0.3); }

/* Success message */
.sg-contact-page .sg-alert-message { display: none; position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 15px 25px; border-radius: 6px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); z-index: 1000; align-items: center; gap: 10px; animation: slideIn 0.3s ease-out; }

@keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }

@media (max-width: 768px) {
    .sg-contact-page .sg-contact-content { flex-direction: column; }
    .sg-contact-page .sg-contact-info-section, .sg-contact-page .sg-contact-form-section { width: 100%; }
    .sg-contact-page .sg-info-card { flex-direction: column; align-items: flex-start; }
    .sg-contact-page .sg-info-icon { margin-bottom: 15px; margin-right: 0; }
}
</style>
<div class="sg-scrollable-content sg-contact-page">
    <section class="sg-contact-section">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
                        @if ($details)
                        @if ($details->phone || $details->secondary_phone)

                        <div class="sg-info-card">
                            <div class="sg-info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="sg-info-content">
                                <h3>Phone Numbers</h3>
                                <p>{{$details->phone}}<br>{{$details->secondary_phone}}</p>
                            </div>
                        </div>
                        @endif
                        @if ($details->email || $details->secondary_email)

                        <div class="sg-info-card">
                            <div class="sg-info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="sg-info-content">
                                <h3>Email Address</h3>
                                <p>{{$details->email}}<br>{{$details->secondary_email}}</p>
                            </div>
                        </div>
                        @endif
                        @if ($details->address)

                        <div class="sg-info-card">
                            <div class="sg-info-icon" style="width: 120px;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="sg-info-content">
                                <h3>Office Location</h3>
                                <p>{{$details->address}}</p>
                            </div>
                        </div>
                        @endif
                        @if ($details->business_hours)

                        <div class="sg-info-card">
                            <div class="sg-info-icon" style="width: 50px;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="sg-info-content">
                                <h3>Business Hours</h3>
                                <p>{{$details->business_hours}}</p>
                            </div>
                        </div>
                        @endif

                        @else
                        <p>No contact information found.</p>
                        @endif
                    </div>
                </div>

                <!-- Contact Form Section -->
                <div class="sg-contact-form-section">
                    <div class="sg-form-header">
                        <h2>Send Us a Message</h2>
                        <p class="sg-form-subtitle">We'll respond within 24 hours</p>
                    </div>

                    <form id="sgContactForm" class="sg-contact-form" action="{{ route('contact.submit') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

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
    </section>
</div>

<script>
document.getElementById('sgContactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    console.log('Form submission started');

    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.innerHTML;

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span>Sending...</span><i class="fas fa-spinner fa-spin"></i>';

    try {
        const formData = new FormData(form);
        console.log('FormData contents:');
        for (let [key, value] of formData.entries()) {
            console.log(key + ': ' + value);
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        console.log('CSRF Token:', csrfToken);

        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        console.log('Response status:', response.status);
        const data = await response.json();
        console.log('Response data:', data);

        if (!response.ok) {
            throw new Error(data.message || 'Server error');
        }

        if (data.success) {
            console.log('Success! Message ID:', data.record_id);
            document.getElementById('sgSuccessMessage').style.display = 'flex';
            form.reset();

            setTimeout(() => {
                document.getElementById('sgSuccessMessage').style.display = 'none';
            }, 5000);
        } else {
            throw new Error(data.errors ? Object.values(data.errors).join('\n') : 'Submission failed');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error: ' + error.message);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
    }
});
</script>

@endsection