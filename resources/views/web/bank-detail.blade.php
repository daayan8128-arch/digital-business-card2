@extends('webTemplate.maintemplate')

@section('content')


    <style>
        /* Base Styles */
        .scrollable-content {
            scrollbar-width: none;
            -ms-overflow-style: none;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* content hamesha upar se start ho */
            background: var(--bg-color);
            padding: 20px 0;
        }

        .scrollable-content::-webkit-scrollbar {
            display: none;
        }

        #payment-section {
            width: 100%;
            max-width: 1200px;

            display: flex;
            align-items: flex-start;
            padding: 20px;
            box-sizing: border-box;
        }

        .payment-container {
            width: 100%;
            margin: 0 auto;
        }

        .payment-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        /* Header Styles */
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
            min-height: 200px;
            /* Minimum height for empty state */
            position: relative;
        }

        /* Empty State Styles */
        .empty-payment {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
            padding: 0 20px;
        }

        .empty-payment-icon {
            font-size: 3rem;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .empty-payment h3 {
            color: #334155;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .empty-payment p {
            color: #64748b;
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Payment Item Styles */
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
            min-height: 200px;
            /* Minimum height for empty state */
            position: relative;
        }

        .bank-main {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
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
            min-height: 200px;
            /* Minimum height for empty state */
            position: relative;
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

        /* Responsive Styles */
        @media (max-width: 1250px) {
            #payment-section {
                width: 95%;
                max-width: 1200px;
            }
        }

        @media (max-width: 992px) {
            .payment-card {
                padding: 25px;
            }

            .main h1 {
                font-size: 22px;
            }

            .empty-payment-icon {
                font-size: 2.5rem;
            }

            .empty-payment h3 {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 768px) {
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

        @media (max-width: 480px) {
            #payment-section {
                padding: 15px;
            }

            .payment-card {
                padding: 20px;
            }

            .main h1 {
                font-size: 20px;
            }

            .divider {
                width: 50px;
                height: 2px;
            }

            .empty-payment-icon {
                font-size: 2rem;
            }

            .empty-payment h3 {
                font-size: 1.1rem;
            }
        }
    </style>


    <div class="scrollable-content">
        <section id="payment-section">
            <div class="payment-container">
                <div class="payment-card">
                    <div class="main">
                        <h1>Payment Details</h1>
                        <div class="divider"></div>
                    </div>

                    <!-- Payment Methods Section -->
                    <div class="payment-methods">
                        @if($bankdetails->count() > 0)
                            @foreach ($bankdetails as $bank)
                                @if ($bank->google_pay_number)
                                    <div class="payment-item" onclick="copyToClipboard('{{$bank->google_pay_number}}')">
                                        <div class="payment-icon">
                                            <img src="{{ asset('assets/img/gpay.png') }}" style="width: 50px; height: 50px;"
                                                alt="Google Pay" loading="lazy">
                                        </div>
                                        <div class="payment-info">
                                            <div class="payment-title">Google Pay</div>
                                            <div class="payment-detail">{{$bank->google_pay_number}}</div>
                                        </div>
                                        <div class="copy-indicator">Click to copy</div>
                                    </div>
                                @endif

                                @if ($bank->phonepe_number)
                                    <div class="payment-item" onclick="copyToClipboard('{{$bank->phonepe_number}}')">
                                        <div class="payment-icon">
                                            <img src="{{ asset('assets/img/phonepe.png') }}" style="width: 50px; height: 50px;"
                                                alt="PhonePe" loading="lazy">
                                        </div>
                                        <div class="payment-info">
                                            <div class="payment-title">PhonePe</div>
                                            <div class="payment-detail">{{$bank->phonepe_number}}</div>
                                        </div>
                                        <div class="copy-indicator">Click to copy</div>
                                    </div>
                                @endif

                                @if ($bank->upi_id)
                                    <div class="payment-item" onclick="copyToClipboard('{{$bank->upi_id}}')">
                                        <div class="payment-icon">
                                            <img src="{{ asset('assets/img/upiid.png') }}" style="width: 40px; height: 40px;"
                                                alt="UPI ID" loading="lazy">
                                        </div>
                                        <div class="payment-info">
                                            <div class="payment-title">UPI ID</div>
                                            <div class="payment-detail">{{$bank->upi_id}}</div>
                                        </div>
                                        <div class="copy-indicator">Click to copy</div>
                                    </div>
                                @endif

                                @if ($bank->paytm_number)
                                    <div class="payment-item" onclick="copyToClipboard('{{$bank->paytm_number}}')">
                                        <div class="payment-icon">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/42/Paytm_logo.png/640px-Paytm_logo.png"
                                                style="width: 40px; height: 40px;" alt="Paytm" loading="lazy">
                                        </div>
                                        <div class="payment-info">
                                            <div class="payment-title">Paytm</div>
                                            <div class="payment-detail">{{$bank->paytm_number}}</div>
                                        </div>
                                        <div class="copy-indicator">Click to copy</div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="empty-payment">
                                <i class="fas fa-wallet empty-payment-icon"></i>
                                <h3>No Payment Methods Available</h3>
                                <p>Payment details will be added soon. Please check back later.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Bank Details Section -->
                    @if ($bankdetails->filter(fn($bank) => $bank->account_name || $bank->bank_name || $bank->branch_name || $bank->ifsc_code)->isNotEmpty())
                        <div class="bank-details">
                            <div class="bank-main">
                                <h3>Bank Details</h3>
                            </div>
                            @if($bankdetails->count() > 0)
                                @foreach ($bankdetails as $bank)
                                    <div class="bank-info-grid">
                                        <div class="bank-label">Account Name:</div>
                                        <div class="bank-value">{{$bank->account_name}}</div>

                                        <div class="bank-label">Bank Name:</div>
                                        <div class="bank-value">{{$bank->bank_name}}</div>

                                        <div class="bank-label">Branch:</div>
                                        <div class="bank-value">{{$bank->branch_name}}</div>

                                        <div class="bank-label">IFSC Code:</div>
                                        <div class="bank-value">{{$bank->ifsc_code}}</div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-payment">
                                    <i class="fas fa-university empty-payment-icon"></i>
                                    <h3>No Bank Details Available</h3>
                                    <p>Bank account information will be added soon.</p>
                                </div>
                            @endif
                        </div>
                    @endif
                    <!-- QR Code Section -->
                    @if ($bankdetails->filter(fn($bank) => !empty($bank->scanner_image))->isNotEmpty())
                        <div class="qr-section">
                            <h3>Scan & Pay</h3>
                            @if($bankdetails->count() > 0)
                                <div class="qr-container">
                                    <div class="qr-code">
                                        @foreach ($bankdetails as $bank)
                                            @if(!empty($bank->scanner_image_url))
                                                <img src="{{ $bank->scanner_image_url }}"
                                                     alt="QR Code"
                                                     style="width:100%;height:100%;object-fit:contain;">
                                            @else
                                                <div class="empty-payment">
                                                    <i class="fas fa-qrcode empty-payment-icon"></i>
                                                    <p>QR Code not available</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="empty-payment">
                                    <i class="fas fa-qrcode empty-payment-icon"></i>
                                    <h3>No QR Code Available</h3>
                                    <p>Scan and pay option will be added soon.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </section>
    </div>

    <script>
        function copyToClipboard(text) {
            if (!text || text.trim() === '') {
                showToast('No content to copy');
                return;
            }

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
@endsection