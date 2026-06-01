<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Business Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #fdfcfb, #e2ebf0);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;

        }

        .content {
            flex: 1;
            /* 👈 ye footer ko neeche dhakel dega */
            padding: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .footer {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            text-align: center;
            padding: 20px 10px;
            font-size: 14px;
        }




        .header {
            background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .company-logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            /* image crop ho jaaye */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 2;
            padding: 0;
            background: none;
            /* white background hatao */
        }

        .company-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* box ke andar crop karke fit kare */
            display: block;
        }





        .company-name {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .tagline {
            font-size: 18px;
            opacity: 0.9;
        }



        .profile {
            text-align: center;
        }

        .profile-img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 5px solid #f8f9fa;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto 20px;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-img i {
            font-size: 60px;
            color: #6a11cb;
        }

        .name {
            font-size: 28px;
            font-weight: bold;
            color: #1a2a6c;
            margin-bottom: 5px;
        }

        .title {
            font-size: 18px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icons div {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .social-icons div:hover {
            transform: translateY(-5px);
        }

        .facebook {
            background: #3b5998;
        }

        .youtube {
            background: #ff0000;
        }

        .instagram {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }

        .twitter {
            background: #1da1f2;
        }

        .linkedin {
            background: #0077b5;
        }

        .contact-info {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .contact-info h2 {
            color: #1a2a6c;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .contact-details {
            flex-grow: 1;
        }

        .contact-type {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 3px;
        }

        .contact-value {
            font-size: 16px;
            color: #343a40;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
        }

        .btn-secondary {
            background: white;
            color: #6a11cb;
            border: 2px solid #6a11cb;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
        }

        .btn-secondary:hover {
            background: #f8f9fa;
        }



        .footer p {
            margin: 5px 0;
            font-size: 13px;
            font-weight: 500;
        }

        .footer p:first-child {
            font-size: 14px;
            font-weight: 600;
        }


        @media (max-width: 768px) {
            .content {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .company-logo {
                width: 60px;
                height: 60px;
                top: 15px;
                right: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="company-logo">
                @if($details && $details->company_logo)
                    <img src="{{ asset('uploads/' . $details->company_logo) }}" alt="Company Logo">
                @else
                    @php
                        $companyName = $details->business_name ?? 'BN';
                        $initials = strtoupper(substr(preg_replace('/\s+/', '', $companyName), 0, 2));
                    @endphp
                    <div style="width: 80px; height: 80px; background:#1a2a6c; color:white; 
                                                        display:flex; align-items:center; justify-content:center; 
                                                        font-size:28px; font-weight:bold; border-radius:10px;">
                        {{ $initials }}
                    </div>
                @endif
            </div>
            @if(!empty($details->business_name) || !empty($details->tagline))
                <div class="company-name">{{ $details->business_name }}</div>

                <div class="tagline">{{$details->tagline }}</div>
            @endif
        </div>

        <div class="content">
            <div class="profile">
                <div class="profile-img" style="border-radius:50%; overflow:hidden;">
                    @if(!empty($details->photo_path))
                        <img src="{{ asset('uploads/' . $details->photo_path) }}" alt="Profile Image"
                            style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <div style="width:100%; height:100%; background:#34495e; 
                                                display:flex; align-items:center; justify-content:center; 
                                                color:white; font-size:30px; border-radius:50%;">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                </div>


                @if(!empty($details->name) || !empty($details->designation))

                    <h1 class="name"> {{$details->name }}</h1>
                    <div class="title">{{ $details->designation }}</div>

                @endif
                <div class="social-icons">
                    @if(!empty($details->facebook))
                        <div class="facebook" onclick="window.open('{{ $details->facebook }}')">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                    @endif

                    @if(!empty($details->linkedin))
                        <div class="linkedin" onclick="window.open('{{ $details->linkedin }}')">
                            <i class="fab fa-linkedin-in"></i>
                        </div>
                    @endif

                    @if(!empty($details->instagram))
                        <div class="instagram" onclick="window.open('{{ $details->instagram }}')">
                            <i class="fab fa-instagram"></i>
                        </div>
                    @endif

                    @if(!empty($details->twitter))
                        <div class="twitter" onclick="window.open('{{ $details->twitter }}')">
                            <i class="fab fa-twitter"></i>
                        </div>
                    @endif

                    @if(!empty($details->youtube))
                        <div class="youtube" onclick="window.open('{{ $details->youtube }}')">
                            <i class="fab fa-youtube"></i>
                        </div>
                    @endif

                    <!-- Default icons if no social media links -->
                    <!-- @if(empty($details->facebook) && empty($details->linkedin) && empty($details->instagram) && empty($details->twitter) && empty($details->youtube))
                    <div class="social-link">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-link">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                    <div class="social-link">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="social-link ">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="social-link">
                        <i class="fa-brands fa-youtube"></i>
                    </div>

                @endif -->
                </div>

            </div>

            <div class="contact-info">

                <h2>Contact Information</h2>
                @if (!empty($details->phone))

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-type">Phone</div>

                            <div class="contact-value"> {{$details->phone}}</div>
                        </div>
                    </div>
                @endif
                @if (!empty($details->email))
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-type">Email</div>
                            <div class="contact-value"> {{$details->email}}</div>
                        </div>
                    </div>
                @endif
                @if (!empty($details->address))
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-type">Address</div>
                            <div class="contact-value"> {{$details->address}}</div>
                        </div>
                    </div>
                @endif
                @if (!empty($details->website))
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-type">Website</div>
                            <div class="contact-value"> {{$details->website}}</div>
                        </div>
                    </div>
                @endif



                <div class="action-buttons">
                    <button class="btn btn-primary" onclick="downloadVCard()">
                        <i class="fas fa-download"></i> Save Contact
                    </button>
                    <button class="btn btn-secondary" onclick="shareCard()">
                        <i class="fas fa-share-alt"></i> Share Card
                    </button>
                </div>
            </div>
        </div>
        <footer class="footer">
            <p>Partner : <strong>Solution4U</strong> | Tech by <strong>Digital Business Card</strong></p>
            <p>Let’s create yours — <a style="color: white;" href="{{ route('register') }}">Register</a></p>
        </footer>


    </div>

    <script>
        function downloadVCard() {
            // Dynamic vCard content using Blade variables
            const vCardData = `BEGIN:VCARD
                VERSION:3.0
                N:{{ $details->name ?? '' }};
                FN:{{ $details->name ?? '' }}
                ORG:{{ $details->business_name ?? '' }}
                TITLE:{{ $details->designation ?? '' }}
                TEL;TYPE=WORK,VOICE:{{ $details->phone ?? '' }}
                EMAIL;TYPE=PREF,INTERNET:{{ $details->email ?? '' }}
                ADR;TYPE=WORK:;;{{ $details->address ?? '' }}
                URL:{{ $details->website ?? '' }}
                REV:${new Date().toISOString()}
                END:VCARD`;

            // Create a Blob object with the vCard data
            const blob = new Blob([vCardData], { type: 'text/vcard' });

            // Create a download link
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = '{{ Str::slug($details->name ?? "contact") }}.vcf';
            document.body.appendChild(a);

            // Trigger the download
            a.click();

            // Clean up
            setTimeout(() => {
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }, 100);
        }
        function shareCard() {
            if (navigator.share) {
                navigator.share({
                    title: 'SHREE GAYATRI IMPRESSION',
                    text: 'Digital Business Card of Mayurkumar Mali',
                    url: window.location.href
                })
                    .then(() => console.log('Shared successfully'))
                    .catch((error) => console.log('Error sharing:', error));
            } else {
                alert('Web Share API not supported in your browser. You can copy the URL manually: ' + window.location.href);
            }
        }
    </script>
</body>

</html>