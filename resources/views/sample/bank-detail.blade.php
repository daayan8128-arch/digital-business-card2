@extends('mainsample.maintemplate')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush


    <div class="scrollable-content">
        <section id="payment-section">
            <div class="payment-container">
                <div class="payment-card">
                    <div class="main">
                        <h1>Payment Details</h1>
                        <div class="divider"></div>
                    </div>

                    <div class="payment-methods">
                        <!-- Google Pay -->
                        <div class="payment-item" onclick="copyToClipboard('9924533621')">
                            <div class="payment-icon">
                                <img src="{{ asset('assets/img/gpay.png') }}" alt="Google Pay" loading="lazy"
                                    style="width: 50px; height: 50px;">

                            </div>
                            <div class="payment-info">
                                <div class="payment-title">Google Pay</div>
                                <div class="payment-detail">9924533621</div>
                            </div>
                            <div class="copy-indicator">Click to copy</div>
                        </div>

                        <!-- PhonePe -->
                        <div class="payment-item" onclick="copyToClipboard('9924533621')">
                            <div class="payment-icon">
                                <img src="{{ asset('assets/img/phonepe.png') }}" alt="PhonePe" loading="lazy"
                                    style="width: 50px; height: 50px;">
                            </div>
                            <div class="payment-info">
                                <div class="payment-title">PhonePe</div>
                                <div class="payment-detail">9924533621</div>
                            </div>
                            <div class="copy-indicator">Click to copy</div>
                        </div>

                        <!-- UPI -->
                        <div class="payment-item" onclick="copyToClipboard('agvati@impression-ignoici')">
                            <div class="payment-icon">
                                <img src="{{ asset('assets/img/upiid.png') }}" alt="UPI ID" loading="lazy"
                                    style="width: 40px; height: 40px;">
                            </div>
                            <div class="payment-info">
                                <div class="payment-title">UPI ID</div>
                                <div class="payment-detail">agvati@impression-ignoici</div>
                            </div>
                            <div class="copy-indicator">Click to copy</div>
                        </div>

                        <!-- Paytm -->
                        <div class="payment-item" onclick="copyToClipboard('9924533621')">
                            <div class="payment-icon">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/42/Paytm_logo.png/640px-Paytm_logo.png"
                                    alt="Paytm" loading="lazy">
                            </div>
                            <div class="payment-info">
                                <div class="payment-title">Paytm</div>
                                <div class="payment-detail">9924533621</div>
                            </div>
                            <div class="copy-indicator">Click to copy</div>
                        </div>
                    </div>

                    <div class="bank-details">
                        <div class="bank-main">
                            <h3>Bank Details</h3>
                        </div>
                        <div class="bank-info-grid">
                            <div class="bank-label">Account Name:</div>
                            <div class="bank-value">SHREE GAVATRI IMPRESSION</div>

                            <div class="bank-label">Bank Name:</div>
                            <div class="bank-value">UNION BANK OF INDIA</div>

                            <div class="bank-label">Branch:</div>
                            <div class="bank-value">VASTRAL</div>

                            <div class="bank-label">IFSC Code:</div>
                            <div class="bank-value">UBIN0553558</div>
                        </div>
                    </div>

                    <div class="qr-section">
                        <h3>Scan & Pay</h3>
                        <div class="qr-container">
                            <div class="qr-code">
                                <!-- QR Code Placeholder -->
                                <div class="qr-pattern"></div>
                                <div class="upi-logo">
                                    <img src="{{ asset('assets/img/qr.png') }}" alt="QR Code" loading="lazy"
                                        style="width: 160px; height: 150px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                /* Base Styles */
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }

                #payment-section {

                    background: var(--bg-color);
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 20px;
                }

                .payment-container {
                    width: 1200px;
                    margin: auto 30px;
                    /* max-width: 500px; */
                }

                .payment-card {
                    background: white;
                    border-radius: 16px;
                    padding: 30px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                    position: relative;
                    overflow: hidden;
                }

                /* main Styles */
                .main {
                    display: flex;
                    flex-direction: column;
                    margin-bottom: 25px;
                }

                .main h1 {
                    font-size: 24px;
                    font-weight: 600;
                    color: #2d3748;
                    margin-bottom: 8px;
                }

                .divider {
                    height: 3px;
                    width: 60px;
                    background: linear-gradient(90deg, #4f46e5, #8b5cf6);
                    border-radius: 3px;
                }

                /* Payment Methods */
                .payment-methods {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 15px;
                    margin-bottom: 25px;
                }

                .payment-item {
                    display: flex;
                    align-items: center;
                    padding: 12px;
                    background: #f8fafc;
                    border-radius: 10px;
                    transition: all 0.2s ease;
                    border: 1px solid #e2e8f0;
                    position: relative;
                    cursor: pointer;
                }

                .payment-item:hover {
                    background: #f1f5f9;
                    border-color: #c7d2fe;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                }

                .payment-icon {
                    width: 36px;
                    height: 36px;
                    border-radius: 8px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-right: 12px;
                    background: white;
                    padding: 5px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                }

                .payment-icon img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                }

                .payment-info {
                    flex: 1;
                }

                .payment-title {
                    font-weight: 500;
                    color: #2d3748;
                    font-size: 14px;
                    margin-bottom: 2px;
                }

                .payment-detail {
                    color: #64748b;
                    font-size: 12px;
                    font-weight: 400;
                }

                .copy-indicator {
                    position: absolute;
                    bottom: -20px;
                    left: 0;
                    width: 100%;
                    text-align: center;
                    font-size: 10px;
                    color: #64748b;
                    opacity: 0;
                    transition: opacity 0.2s ease;
                }

                .payment-item:hover .copy-indicator {
                    opacity: 1;
                }

                /* Bank Details */
                .bank-details {
                    background: #f8fafc;
                    border-radius: 12px;
                    padding: 20px;
                    margin-bottom: 25px;
                    border-left: 4px solid #4f46e5;
                }

                .bank-main {
                    display: flex;
                    align-items: center;
                    margin-bottom: 15px;
                }

                .bank-main .material-icons {
                    color: #4f46e5;
                    margin-right: 10px;
                    font-size: 24px;
                }

                .bank-main h3 {
                    color: #2d3748;
                    font-size: 16px;
                    font-weight: 500;
                }

                .bank-info-grid {
                    display: grid;
                    grid-template-columns: 1fr 2fr;
                    gap: 12px;
                    align-items: center;
                }

                .bank-label {
                    font-weight: 500;
                    color: #475569;
                    font-size: 13px;
                }

                .bank-value {
                    color: #1e293b;
                    font-size: 13px;
                    padding: 8px 12px;
                    background: white;
                    border-radius: 6px;
                    border: 1px solid #e2e8f0;
                    word-break: break-all;
                }

                /* QR Section */
                .qr-section {
                    text-align: center;
                }

                .qr-section h3 {
                    color: #2d3748;
                    margin-bottom: 15px;
                    font-size: 16px;
                    font-weight: 500;
                }

                .qr-container {
                    display: inline-block;
                    padding: 10px;
                    background: white;
                    border-radius: 12px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                }

                .qr-code {
                    width: 160px;
                    height: 160px;
                    background: white;
                    border: 1px solid #e2e8f0;
                    border-radius: 8px;
                    position: relative;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .qr-pattern {
                    width: 140px;
                    height: 140px;
                    background-image:
                        repeating-linear-gradient(0deg, #2d3748 0px, #2d3748 8px, transparent 8px, transparent 16px),
                        repeating-linear-gradient(90deg, #2d3748 0px, #2d3748 8px, transparent 8px, transparent 16px);
                    opacity: 0.8;
                }

                /* .upi-logo {
                    position: absolute;
                    bottom: 10px;
                    right: 10px;
                    width: 30px;
                    height: 30px;
                    background: white;
                    border-radius: 4px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 3px;
                }

                .upi-logo img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                } */

                /* Responsive */
                @media (max-width: 600px) {
                    .payment-card {
                        padding: 20px;
                    }

                    .payment-methods {
                        grid-template-columns: 1fr;
                    }

                    .bank-info-grid {
                        grid-template-columns: 1fr;
                        gap: 8px;
                    }

                    .bank-value {
                        padding: 6px 10px;
                    }
                }

                /* Toast Notification */
                .toast {
                    position: fixed;
                    bottom: 20px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: #4f46e5;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 8px;
                    font-size: 14px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    z-index: 1000;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .toast.show {
                    opacity: 1;
                }
            </style>

            <script>
                function copyToClipboard(text) {
                    navigator.clipboard.writeText(text).then(() => {
                        showToast('Copied to clipboard!');
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                        showToast('Failed to copy');
                    });
                }

                function showToast(message) {
                    const toast = document.createElement('div');
                    toast.className = 'toast';
                    toast.textContent = message;
                    document.body.appendChild(toast);

                    setTimeout(() => {
                        toast.classList.add('show');
                    }, 10);

                    setTimeout(() => {
                        toast.classList.remove('show');
                        setTimeout(() => {
                            document.body.removeChild(toast);
                        }, 300);
                    }, 2000);
                }
            </script>
        </section>
    </div>
@endsection