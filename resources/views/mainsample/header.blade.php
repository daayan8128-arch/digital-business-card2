<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultra Responsive Neumorphism Navigation Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --bg-color: #e0e5ec;
            --text-color: #6c7b7f;
            --active-color: #4a90e2;
            --shadow-dark: #bcc2c9;
            --shadow-light: #ffffff;
            --border-radius: 8px;
            --item-padding: 18px 25px;
            --icon-size: 50px;
            --font-size: 16px;
            --container-width: 300px;
            --container-height: 650px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-color);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            padding-top: 40px;
            position: relative;
            overflow-x: hidden;
        }

        /* Mobile Toggle Button */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: max(20px, env(safe-area-inset-top));
            left: 20px;
            width: 55px;
            height: 55px;
            background: var(--bg-color);
            border-radius: 8px;
            box-shadow:
                8px 8px 16px var(--shadow-dark),
                -8px -8px 16px var(--shadow-light);
            cursor: pointer;
            z-index: 1001;
            transition: all 0.3s ease;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--text-color);
            border: none;
            outline: none;
        }

        .mobile-toggle:hover {
            box-shadow:
                inset 6px 6px 12px var(--shadow-dark),
                inset -6px -6px 12px var(--shadow-light);
            color: var(--active-color);
        }

        .mobile-toggle.active {
            box-shadow:
                inset 8px 8px 16px var(--shadow-dark),
                inset -8px -8px 16px var(--shadow-light);
            color: var(--active-color);
        }

        /* Mobile Overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
            backdrop-filter: blur(3px);
        }

        .mobile-overlay.active {
            opacity: 1;
        }

        .header-container {
            background: var(--bg-color);
            border-radius: 25px;
            box-shadow:
                20px 20px 40px var(--shadow-dark),
                -20px -20px 40px var(--shadow-light);
            width: var(--container-width);
            height: auto;
            /* ✅ content ke hisaab se height */
            min-height: auto;
            /* ✅ koi minimum force na ho */
            padding: 30px 0;
            position: relative;
            max-width: 100%;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            /* ✅ space-between ki jagah */
        }



        .menu-item {
            display: flex;
            align-items: center;
            padding: 5px 8px;
            margin: 3px 5px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            animation: slideIn 0.5s ease forwards;
            opacity: 0;
            text-decoration: none;
            color: inherit;
            min-height: 65px;
        }

        .menu-item:visited {
            color: inherit;
        }

        .menu-item:hover {
            box-shadow:
                inset 6px 6px 14px var(--shadow-dark),
                inset -6px -6px 14px var(--shadow-light);
            transform: translateY(-2px);
        }

        .menu-item.active {
            box-shadow:
                inset 10px 10px 20px var(--shadow-dark),
                inset -10px -10px 20px var(--shadow-light);
            background: linear-gradient(145deg, #d6dce5, #e8eff6);
        }

        .menu-item.active:hover {
            transform: translateY(0);
        }

        .icon {
            width: var(--icon-size);
            height: var(--icon-size);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 18px;
            font-size: calc(var(--icon-size) * 0.4);
            transition: all 0.3s ease;
            background: var(--bg-color);
            color: var(--text-color);
            box-shadow:
                5px 5px 10px var(--shadow-dark),
                -5px -5px 10px var(--shadow-light);
            flex-shrink: 0;
        }

        .menu-item.active .icon {
            box-shadow:
                inset 6px 6px 12px var(--shadow-dark),
                inset -6px -6px 12px var(--shadow-light);
            color: var(--active-color);
            transform: scale(1.05);
        }

        .menu-text {
            font-size: var(--font-size);
            font-weight: 500;
            color: var(--text-color);
            transition: all 0.3s ease;
            flex-grow: 1;
            white-space: nowrap;
        }

        .menu-item.active .menu-text {
            color: var(--active-color);
            font-weight: 600;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Animation delays */
        .menu-item:nth-child(1) {
            animation-delay: 0.05s;
        }

        .menu-item:nth-child(2) {
            animation-delay: 0.1s;
        }

        .menu-item:nth-child(3) {
            animation-delay: 0.15s;
        }

        .menu-item:nth-child(4) {
            animation-delay: 0.2s;
        }

        .menu-item:nth-child(5) {
            animation-delay: 0.25s;
        }

        .menu-item:nth-child(6) {
            animation-delay: 0.3s;
        }

        .menu-item:nth-child(7) {
            animation-delay: 0.35s;
        }

        .menu-item:nth-child(8) {
            animation-delay: 0.4s;
        }

        .menu-item:nth-child(9) {
            animation-delay: 0.45s;
        }

        /* Close button */
        .close-button {
            display: none;
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: var(--bg-color);
            border-radius: 12px;
            box-shadow:
                5px 5px 10px var(--shadow-dark),
                -5px -5px 10px var(--shadow-light);
            cursor: pointer;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--text-color);
            transition: all 0.3s ease;
            z-index: 10;
            border: none;
        }

        .close-button:hover {
            box-shadow:
                inset 4px 4px 8px var(--shadow-dark),
                inset -4px -4px 8px var(--shadow-light);
            color: #e74c3c;
        }

        /* Share Popup Styles */
        .share-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            backdrop-filter: blur(3px);
        }

        .share-popup.active {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .share-popup-content {
            background: var(--bg-color);
            border-radius: var(--border-radius);
            padding: 30px;
            width: 90%;
            max-width: 400px;
            box-shadow:
                15px 15px 30px var(--shadow-dark),
                -15px -15px 30px var(--shadow-light);
            position: relative;
            animation: popIn 0.3s ease-out;
        }

        @keyframes popIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .share-popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: var(--bg-color);
            box-shadow:
                3px 3px 6px var(--shadow-dark),
                -3px -3px 6px var(--shadow-light);
            border: none;
            color: var(--text-color);
        }

        .share-popup-title {
            margin-bottom: 20px;
            color: var(--text-color);
            font-size: 20px;
            font-weight: 600;
            text-align: center;
        }

        .share-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .share-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--bg-color);
            box-shadow:
                5px 5px 10px var(--shadow-dark),
                -5px -5px 10px var(--shadow-light);
            border: none;
            color: var(--text-color);
        }

        .share-button:hover {
            transform: translateY(-3px);
            box-shadow:
                8px 8px 16px var(--shadow-dark),
                -8px -8px 16px var(--shadow-light);
        }

        .share-button:active {
            transform: translateY(0);
            box-shadow:
                inset 4px 4px 8px var(--shadow-dark),
                inset -4px -4px 8px var(--shadow-light);
        }

        .share-icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .share-button.facebook {
            color: #1877F2;
        }

        .share-button.twitter {
            color: #1DA1F2;
        }

        .share-button.whatsapp {
            color: #25D366;
        }

        .share-button.linkedin {
            color: #0077B5;
        }

        .share-button.telegram {
            color: #0088CC;
        }

        .share-button.copy {
            color: var(--active-color);
        }

        /* Extra Large Screens (1440px+) */
        @media (min-width: 1440px) {
            :root {
                --container-width: 350px;
                --container-height: 750px;
                --item-padding: 22px 30px;
                --icon-size: 55px;
                --font-size: 18px;
                --border-radius: 22px;
            }

            body {
                padding: 40px;
                padding-top: 60px;
            }

            .header-container {
                padding: 40px 0;
            }

            .menu-item {
                margin: 14px 25px;
                min-height: 75px;
            }

            .icon {
                margin-right: 22px;
            }
        }

        /* Large Screens (1200px - 1439px) */
        @media (max-width: 1439px) and (min-width: 1200px) {
            :root {
                --container-width: 320px;
                --container-height: 700px;
                --item-padding: 20px 28px;
                --icon-size: 52px;
                --font-size: 17px;
                --border-radius: 21px;
            }

            .header-container {
                padding: 35px 0;
            }

            .menu-item {
                margin: 12px 22px;
                min-height: 70px;
            }

            .icon {
                margin-right: 20px;
            }
        }

        /* Medium Large Screens (1024px - 1199px) */
        @media (max-width: 1199px) and (min-width: 1025px) {
            :root {
                --container-width: 300px;
                --container-height: 650px;
                --item-padding: 18px 25px;
                --icon-size: 50px;
                --font-size: 16px;
            }
        }

        /* Tablet Landscape (769px - 1024px) */
        @media (max-width: 1024px) and (min-width: 769px) {
            :root {
                --container-width: 90%;
                --container-height: 600px;
                --item-padding: 16px 22px;
                --icon-size: 48px;
                --font-size: 15px;
                --border-radius: 18px;
            }

            body {
                padding: 0;
                align-items: center;
                justify-content: center;
            }

            .mobile-toggle {
                display: flex;
                width: 60px;
                height: 60px;
                font-size: 22px;
            }

            .mobile-overlay {
                display: block;
            }

            .header-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0.8);
                max-width: 400px;
                padding: 25px 0 25px 0;
                padding-top: 60px;
                border-radius: 30px;
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow:
                    25px 25px 50px var(--shadow-dark),
                    -25px -25px 50px var(--shadow-light);
            }

            .header-container.active {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
                visibility: visible;
            }

            .close-button {
                display: flex;
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .menu-item {
                margin: 8px 18px;
                min-height: 60px;
            }
        }

        /* Tablet Portrait (481px - 768px) */
        @media (max-width: 768px) and (min-width: 481px) {
            :root {
                --container-width: 85%;
                --container-height: auto;
                --item-padding: 15px 20px;
                --icon-size: 45px;
                --font-size: 15px;
                --border-radius: 16px;
            }

            .mobile-toggle {
                width: 55px;
                height: 55px;
                font-size: 20px;
                top: max(20px, env(safe-area-inset-top));
                left: 20px;
            }

            .header-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0.9);
                max-width: 380px;
                min-height: 500px;
                padding: 20px 0;
                padding-top: 55px;
                border-radius: 25px;
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .header-container.active {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
                visibility: visible;
            }

            .menu-item {
                margin: 6px 15px;
                min-height: 55px;
            }

            .icon {
                margin-right: 15px;
            }

            .close-button {
                display: flex;
                width: 38px;
                height: 38px;
                top: 12px;
                right: 12px;
                font-size: 16px;
            }
        }

        /* Large Mobile (361px - 480px) */
        @media (max-width: 480px) and (min-width: 361px) {
            :root {
                --container-width: 90%;
                --container-height: auto;
                --item-padding: 14px 18px;
                --icon-size: 42px;
                --font-size: 14px;
                --border-radius: 14px;
            }

            .mobile-toggle {
                width: 50px;
                height: 50px;
                font-size: 18px;
                top: max(15px, env(safe-area-inset-top));
                left: 15px;
            }

            .header-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0.95);
                max-width: 320px;
                min-height: 450px;
                padding: 18px 0;
                padding-top: 50px;
                border-radius: 20px;
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
            }

            .header-container.active {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
                visibility: visible;
            }

            .menu-item {
                margin: 5px 12px;
                min-height: 52px;
            }

            .icon {
                margin-right: 12px;
            }

            .close-button {
                display: flex;
                width: 35px;
                height: 35px;
                top: 10px;
                right: 10px;
                font-size: 14px;
            }
        }

        /* Small Mobile (280px - 360px) */
        @media (max-width: 360px) {
            :root {
                --container-width: 95%;
                --container-height: auto;
                --item-padding: 12px 15px;
                --icon-size: 38px;
                --font-size: 13px;
                --border-radius: 12px;
            }

            .mobile-toggle {
                width: 45px;
                height: 45px;
                font-size: 16px;
                top: max(12px, env(safe-area-inset-top));
                left: 12px;
            }

            .header-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 95vw;
                max-width: 300px;
                min-height: 420px;
                padding: 15px 0;
                padding-top: 45px;
                border-radius: 18px;
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
            }

            .header-container.active {
                opacity: 1;
                visibility: visible;
            }

            .menu-item {
                margin: 4px 10px;
                min-height: 48px;
            }

            .icon {
                margin-right: 10px;
            }

            .close-button {
                display: flex;
                width: 32px;
                height: 32px;
                top: 8px;
                right: 8px;
                font-size: 12px;
            }
        }

        /* Ultra Small Screens (Below 280px) */
        @media (max-width: 279px) {
            :root {
                --container-width: 98%;
                --container-height: auto;
                --item-padding: 10px 12px;
                --icon-size: 35px;
                --font-size: 12px;
                --border-radius: 10px;
            }

            .mobile-toggle {
                width: 40px;
                height: 40px;
                font-size: 14px;
                top: max(10px, env(safe-area-inset-top));
                left: 10px;
            }

            .header-container {
                width: 98vw;
                max-width: 260px;
                min-height: 400px;
                padding: 12px 0;
                padding-top: 40px;
                border-radius: 15px;
            }

            .menu-item {
                margin: 3px 8px;
                min-height: 45px;
            }

            .icon {
                margin-right: 8px;
            }

            .close-button {
                width: 28px;
                height: 28px;
                top: 6px;
                right: 6px;
                font-size: 11px;
            }
        }

        /* Hover effects enhancement */
        .menu-item:not(.active):hover .icon {
            transform: scale(1.1);
            color: var(--active-color);
        }

        .menu-item:not(.active):hover .menu-text {
            color: var(--active-color);
        }

        /* Focus states for accessibility */
        .menu-item:focus {
            outline: 2px solid var(--active-color);
            outline-offset: 2px;
        }

        .mobile-toggle:focus {
            outline: 2px solid var(--active-color);
            outline-offset: 2px;
        }

        /* Touch-friendly improvements */
        @media (hover: none) and (pointer: coarse) {
            .menu-item:hover {
                transform: none;
                box-shadow:
                    inset 6px 6px 14px var(--shadow-dark),
                    inset -6px -6px 14px var(--shadow-light);
            }

            .menu-item:active {
                transform: scale(0.98);
            }
        }

        /* Prevent body scroll when menu is open */
        body.menu-open {
            overflow: hidden;
            height: 100vh;
        }

        /* Animation improvements for mobile */
        @media (max-width: 1024px) {
            .mobile-toggle {
                display: flex !important;
            }

            .header-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 95vw;
                max-width: 340px;
                height: auto;
                min-height: unset;
                max-height: 90vh;
                padding: 10px 0 10px 0;
                border-radius: 16px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
                background: #e0e5ec;
                z-index: 1000;
                display: block;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .header-container.active {
                opacity: 1;
                visibility: visible;
            }

            .close-button {
                display: flex !important;
            }

            .menu-item {
                padding: 8px 10px;
                margin: 4px 6px;
                min-height: 36px;
                border-radius: 8px;
                font-size: 13px;
            }

            .icon {
                width: 24px;
                height: 24px;
                font-size: 13px;
                margin-right: 7px;
            }

            .menu-text {
                font-size: 13px;
                font-weight: 500;
            }
        }

        .header-container.active .menu-item {
            animation: mobileSlideIn 0.4s ease forwards;
            opacity: 0;
        }

        @keyframes mobileSlideIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Orientation changes */
        @media (orientation: landscape) and (max-height: 500px) {
            .header-container {
                max-height: 90vh;
                overflow-y: auto;
                min-height: auto;
            }

            .menu-item {
                min-height: 45px;
                padding: 10px 15px;
            }

            :root {
                --icon-size: 35px;
                --font-size: 13px;
            }
        }

        /* High DPI displays */
        @media (-webkit-min-device-pixel-ratio: 2),
        (min-resolution: 192dpi) {
            .header-container {
                box-shadow:
                    20px 20px 40px rgba(188, 194, 201, 0.8),
                    -20px -20px 40px rgba(255, 255, 255, 0.9);
            }
        }

        /* Dark mode support */
        /* @media (prefers-color-scheme: dark) {
            :root {
                --bg-color: #2d3748;
                --text-color: #a0aec0;
                --active-color: #63b3ed;
                --shadow-dark: #1a202c;
                --shadow-light: #4a5568;
            }
        } */

        /* Reduce motion for accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        .modal-open .header-container {
            display: none !important;
        }
    </style>
</head>

<body>
    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigation menu">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <!-- Share Popup -->
    <div class="share-popup" id="sharePopup">
        <div class="share-popup-content">
            <button class="share-popup-close" id="sharePopupClose">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="share-popup-title">Share This Page</h3>
            <div class="share-buttons">
                <button class="share-button facebook" data-share="facebook">
                    <i class="fab fa-facebook-f share-icon"></i>
                    <span>Facebook</span>
                </button>
                <button class="share-button twitter" data-share="twitter">
                    <i class="fab fa-twitter share-icon"></i>
                    <span>Twitter</span>
                </button>
                <button class="share-button whatsapp" data-share="whatsapp">
                    <i class="fab fa-whatsapp share-icon"></i>
                    <span>WhatsApp</span>
                </button>
                <button class="share-button linkedin" data-share="linkedin">
                    <i class="fab fa-linkedin-in share-icon"></i>
                    <span>LinkedIn</span>
                </button>
                <button class="share-button telegram" data-share="telegram">
                    <i class="fab fa-telegram-plane share-icon"></i>
                    <span>Telegram</span>
                </button>
                <button class="share-button copy" data-share="copy">
                    <i class="fas fa-link share-icon"></i>
                    <span>Copy Link</span>
                </button>
            </div>
        </div>
    </div>

    <nav class="header-container" id="headerContainer" role="navigation">
        <!-- Close Button for Mobile -->
        <button class="close-button" id="closeButton" aria-label="Close menu">
            <i class="fas fa-times"></i>
        </button>

        <a href="/hardiksenger" class="menu-item" data-page="about" tabindex="0">
            <div class="icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="menu-text">About Us</div>
        </a>

        <a href="/projects" class="menu-item" data-page="projects" tabindex="0">
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="menu-text">Projects</div>
        </a>

        <a href="/services" class="menu-item" data-page="services" tabindex="0">
            <div class="icon">
                <i class="fas fa-cogs"></i>
            </div>
            <div class="menu-text">Services</div>
        </a>

        <a href="/visionary" class="menu-item" data-page="visionary" tabindex="0">
            <div class="icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="menu-text">Visionary</div>
        </a>

        <a href="/media" class="menu-item" data-page="media" tabindex="0">
            <div class="icon">
                <i class="fas fa-photo-video"></i>
            </div>
            <div class="menu-text">Media</div>
        </a>

        <a href="/bank-detail" class="menu-item" data-page="bank" tabindex="0">
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
            <div class="menu-text">Bank Detail</div>
        </a>

        <a href="/contact" class="menu-item" data-page="contact" tabindex="0">
            <div class="icon">
                <i class="fas fa-phone-alt"></i>
            </div>
            <div class="menu-text">Contact Us</div>
        </a>

        <a href="#" class="menu-item" id="downloadVcfBtn" data-page="download" tabindex="0">
            <div class="icon">
                <i class="fas fa-download"></i>
            </div>
            <div class="menu-text">Download VCF</div>
        </a>

        <a href="#" class="menu-item" id="shareButton" data-page="share" tabindex="0">
            <div class="icon">
                <i class="fas fa-share-alt"></i>
            </div>
            <div class="menu-text">Share</div>
        </a>
    </nav>

    <script>
        // vCard Download (Static Data)
        function downloadVCard() {
            const vCardData = `BEGIN:VCARD
VERSION:3.0
N:John Doe
FN:John Doe
ORG:ABC Company
TITLE:Software Engineer
TEL;TYPE=WORK,VOICE:+91-9876543210
EMAIL;TYPE=PREF,INTERNET:johndoe@example.com
ADR;TYPE=WORK:;;123 Street, City, State, India
URL:https://example.com
REV:2025-09-19T12:00:00Z
END:VCARD`;

            const blob = new Blob([vCardData], { type: 'text/vcard' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `contact.vcf`;
            document.body.appendChild(a);
            a.click();
            setTimeout(() => {
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }, 100);
        }

        document.getElementById('downloadVcfBtn').addEventListener('click', function (e) {
            e.preventDefault();
            downloadVCard();
        });

        // Menu and Share Functionality
        const menuItems = document.querySelectorAll('.menu-item');
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileOverlay = document.getElementById('mobileOverlay');
        const headerContainer = document.getElementById('headerContainer');
        const closeButton = document.getElementById('closeButton');
        const shareButton = document.getElementById('shareButton');
        const sharePopup = document.getElementById('sharePopup');
        const sharePopupClose = document.getElementById('sharePopupClose');
        const shareButtons = document.querySelectorAll('[data-share]');
        const body = document.body;

        // Function to detect current page and set active state
        function setActiveMenuItem() {
            const currentPath = window.location.pathname;

            menuItems.forEach(item => {
                item.classList.remove('active');
            });

            let activePage = 'about'; // default

            if (currentPath.includes('/projects')) activePage = 'projects';
            else if (currentPath.includes('/services')) activePage = 'services';
            else if (currentPath.includes('/visionary')) activePage = 'visionary';
            else if (currentPath.includes('/media')) activePage = 'media';
            else if (currentPath.includes('/bank')) activePage = 'bank';
            else if (currentPath.includes('/contact')) activePage = 'contact';
            else if (currentPath.includes('/download')) activePage = 'download';
            else if (currentPath.includes('/share')) activePage = 'share';

            const activeMenuItem = document.querySelector(`[data-page="${activePage}"]`);
            if (activeMenuItem) {
                activeMenuItem.classList.add('active');
            }
        }
        document.addEventListener('DOMContentLoaded', setActiveMenuItem);

        // Mobile menu toggle
        function toggleMobileMenu() {
            const isActive = headerContainer.classList.contains('active');

            if (isActive) {
                headerContainer.classList.remove('active');
                mobileOverlay.classList.remove('active');
                mobileToggle.classList.remove('active');
                body.classList.remove('menu-open');
                mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
            } else {
                headerContainer.classList.add('active');
                mobileOverlay.classList.add('active');
                mobileToggle.classList.add('active');
                body.classList.add('menu-open');
                mobileToggle.innerHTML = '<i class="fas fa-times"></i>';
            }
        }

        // Share popup toggle
        function toggleSharePopup() {
            const isActive = sharePopup.classList.contains('active');
            if (isActive) {
                sharePopup.classList.remove('active');
                body.classList.remove('menu-open');
            } else {
                sharePopup.classList.add('active');
                body.classList.add('menu-open');
            }
        }

        // Share functionality
        function shareOnPlatform(platform) {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);
            let shareUrl = '';

            switch (platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${title}%20${url}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}`;
                    break;
                case 'telegram':
                    shareUrl = `https://t.me/share/url?url=${url}&text=${title}`;
                    break;
                case 'copy':
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        alert('Link copied to clipboard!');
                    }).catch(() => {
                        const textarea = document.createElement('textarea');
                        textarea.value = window.location.href;
                        document.body.appendChild(textarea);
                        textarea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textarea);
                        alert('Link copied to clipboard!');
                    });
                    return;
            }
            if (shareUrl) window.open(shareUrl, '_blank', 'width=600,height=400');
        }

        // Event listeners
        mobileToggle.addEventListener('click', toggleMobileMenu);
        closeButton.addEventListener('click', toggleMobileMenu);
        mobileOverlay.addEventListener('click', function () {
            if (headerContainer.classList.contains('active')) toggleMobileMenu();
        });
        shareButton.addEventListener('click', function (e) {
            e.preventDefault();
            toggleSharePopup();
            if (headerContainer.classList.contains('active')) toggleMobileMenu();
        });
        sharePopupClose.addEventListener('click', toggleSharePopup);
        sharePopup.addEventListener('click', function (e) {
            if (e.target === sharePopup) toggleSharePopup();
        });
        shareButtons.forEach(button => {
            button.addEventListener('click', function () {
                const platform = this.getAttribute('data-share');
                shareOnPlatform(platform);
            });
        });
        menuItems.forEach(item => {
            item.addEventListener('click', function () {
                if (this.id !== 'shareButton') {
                    menuItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    if (headerContainer.classList.contains('active')) toggleMobileMenu();
                }
            });
        });
        menuItems.forEach(item => {
            item.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                if (headerContainer.classList.contains('active')) toggleMobileMenu();
                if (sharePopup.classList.contains('active')) toggleSharePopup();
            }
        });
        function handleResize() {
            if (window.innerWidth > 1024 && headerContainer.classList.contains('active')) toggleMobileMenu();
        }
        window.addEventListener('resize', handleResize);

        // Touch detection
        function hasTouch() {
            return 'ontouchstart' in document.documentElement || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
        }
        if (hasTouch()) document.body.classList.add('touch-device');
        else document.body.classList.add('no-touch-device');

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Passive event listener for scroll
        try {
            const options = { passive: true };
            window.addEventListener('scroll', function () { }, options);
        } catch (e) { }
    </script>

</body>

</html>