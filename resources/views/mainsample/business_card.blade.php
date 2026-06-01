<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mayurkumar Mali - Professional Business Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            padding: 20px;
        }

        .business-card {
            width: 450px;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        .header {
            background: #2c3e50;
            padding: 25px 20px;
            text-align: center;
            color: white;
        }

        .profile-image {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            margin: 0 auto 15px;
            border: 3px solid #ffffff;
            overflow: hidden;
            background: #34495e;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .designation {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .social-link {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #34495e;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-size: 13px;
            transition: background 0.3s ease;
        }

        .social-link:hover {
            background: #4a6741;
        }

        .contact-section {
            padding: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border-left: 3px solid #2c3e50;
            background: #f8f9fa;
        }

        .contact-icon {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            background: #2c3e50;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 15px;
            color: white;
            flex-shrink: 0;
        }

        .contact-details {
            flex: 1;
            min-width: 0;
        }

        .contact-label {
            font-size: 10px;
            color: #7f8c8d;
            text-transform: uppercase;
            margin-bottom: 3px;
            font-weight: 600;
            white-space: nowrap;
        }

        .contact-value {
            font-size: 12px;
            color: #2c3e50;
            font-weight: 500;
            line-height: 1.4;
            word-break: break-word;
        }

        .actions-section {
            padding: 15px 20px;
            background: #ecf0f1;
            border-top: 1px solid #bdc3c7;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .action-btn {
            padding: 10px 8px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
            min-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1 1 48%;
        }

        .btn-call {
            background: #3498db;
            color: white;
        }

        .btn-whatsapp {
            background: #25D366;
            color: white;
        }

        .btn-message {
            background: #9b59b6;
            color: white;
        }

        .btn-contact {
            background: #2c3e50;
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .btn-icon {
            font-size: 13px;
            flex-shrink: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .business-card {
                width: 100vw;
                height: 100vh;
                border-radius: 0;
                overflow-y: auto;
            }

            .action-btn {
                padding: 12px 8px;
                font-size: 13px;
            }
        }
        
    </style>
</head>

<body>

    <div class="business-card">
        <!-- Header Section -->
        <div class="header">
            <div class="profile-image">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face"
                    alt="Mayurkumar Mali"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div
                    style="display: none; width: 100%; height: 100%; background: #34495e; align-items: center; justify-content: center; color: white; font-size: 30px;">
                    <i class="fas fa-user"></i>
                </div>
            </div>

            <div class="name">MAYURKUMAR MALI</div>
            <div class="designation">Founder & Creative Chief</div>

            <div class="social-links">
                <a href="#" class="social-link" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-link" title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="social-link" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.sggprinting.in" class="social-link" title="Website">
                    <i class="fas fa-globe"></i>
                </a>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="contact-section">
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="contact-details">
                    <div class="contact-label">Company Name</div>
                    <div class="contact-value">SHREE GAYATRI IMPRESSION</div>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="contact-details">
                    <div class="contact-label">Business Phone</div>
                    <div class="contact-value">+91 99248-25523</div>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact-details">
                    <div class="contact-label">Email Address</div>
                    <div class="contact-value">gayatriimpression.ahd@gmail.com</div>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="contact-details">
                    <div class="contact-label">Address</div>
                    <div class="contact-value">10, Shivam Gurukrupa, Bapunagar, Near Corner, Nr. Adarsh Society, Amreli
                        Nt. No-8, Khodiyarnagar, Bapunagar, Ahmedabad-380024</div>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="contact-details">
                    <div class="contact-label">Website</div>
                    <div class="contact-value">www.sggprinting.in</div>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="contact-details">
                    <div class="contact-label">GSTIN</div>
                    <div class="contact-value">24XXXXX1234X1ZX</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="actions-section">
            <div class="action-buttons">
                <a href="tel:+919924825523" class="action-btn btn-call">
                    <i class="fas fa-phone btn-icon"></i>
                    <span>Call Me</span>
                </a>

                <a href="https://wa.me/919924825523" class="action-btn btn-whatsapp" target="_blank">
                    <i class="fab fa-whatsapp btn-icon"></i>
                    <span>WhatsApp</span>
                </a>

                <a href="sms:+919924825523" class="action-btn btn-message">
                    <i class="fas fa-comment btn-icon"></i>
                    <span>Message</span>
                </a>


            </div>
        </div>
    </div>

    <script>
        function addToContacts() {
            const vcard = `BEGIN:VCARD
VERSION:3.0
FN:Mayurkumar Mali
ORG:SHREE GAYATRI IMPRESSION
TITLE:Founder & Creative Chief
TEL:+919924825523
EMAIL:gayatriimpression.ahd@gmail.com
URL:https://www.sggprinting.in
ADR:;;10, Shivam Gurukrupa, Bapunagar;Ahmedabad;Gujarat;380024;India
END:VCARD`;

            const blob = new Blob([vcard], { type: 'text/vcard' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'mayurkumar-mali.vcf';
            a.click();
            window.URL.revokeObjectURL(url);
        }
    </script>
</body>

</html>