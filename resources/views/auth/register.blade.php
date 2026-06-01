<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital Business Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6C63FF;
            --secondary-color: #4A40E5;
            --accent-color: #8A85FF;
            --text-primary: #2D2B57;
            --text-secondary: #6C6A99;
            --background-light: #F8F9FF;
            --white: #ffffff;
            --gradient-primary: linear-gradient(135deg, #6C63FF 0%, #4A40E5 100%);
            --purple-dark: #2d1b69;
            --purple-gradient: linear-gradient(135deg, #2d1b69 0%, #1e1b4b 50%, #0f0a2e 100%);
            --error-color: #FF6B6B;
            --success-color: #4ECB71;
            --card-bg: rgba(255, 255, 255, 0.98);
            --card-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
            background: var(--purple-gradient);
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Enhanced Background Effects */
        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        /* Floating Particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatParticles 20s infinite linear;
        }

        .particle:nth-child(odd) {
            background: rgba(108, 99, 255, 0.15);
        }

        @keyframes floatParticles {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-10vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Enhanced Wave Container */
        .wave-container {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .wave {
            position: absolute;
            width: 200%;
            height: 200%;
            opacity: 0.15;
        }

        .wave:nth-child(1) {
            animation: wave1 25s ease-in-out infinite;
            animation-delay: 0s;
        }

        .wave:nth-child(2) {
            animation: wave2 30s ease-in-out infinite;
            animation-delay: -8s;
        }

        .wave:nth-child(3) {
            animation: wave3 35s ease-in-out infinite;
            animation-delay: -15s;
        }

        @keyframes wave1 {

            0%,
            100% {
                transform: translateX(-50%) translateY(-50%) rotate(0deg) scale(1);
            }

            33% {
                transform: translateX(-40%) translateY(-60%) rotate(120deg) scale(1.1);
            }

            66% {
                transform: translateX(-60%) translateY(-40%) rotate(240deg) scale(0.9);
            }
        }

        @keyframes wave2 {

            0%,
            100% {
                transform: translateX(-60%) translateY(-40%) rotate(0deg) scale(0.9);
            }

            50% {
                transform: translateX(-30%) translateY(-50%) rotate(-180deg) scale(1.3);
            }
        }

        @keyframes wave3 {

            0%,
            100% {
                transform: translateX(-40%) translateY(-60%) rotate(0deg) scale(1.1);
            }

            25% {
                transform: translateX(-55%) translateY(-35%) rotate(90deg) scale(0.8);
            }

            75% {
                transform: translateX(-35%) translateY(-55%) rotate(270deg) scale(1.2);
            }
        }

        /* Enhanced Flowing Lines */
        .flowing-lines {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 2;
            opacity: 0.7;
            pointer-events: none;
        }

        .flowing-line {
            position: absolute;
            stroke-width: 2;
            fill: none;
            filter: drop-shadow(0 0 10px currentColor);
        }

        .flowing-line:nth-child(1) {
            stroke: rgba(139, 92, 246, 0.5);
            animation: flowingLine1 18s ease-in-out infinite;
        }

        .flowing-line:nth-child(2) {
            stroke: rgba(99, 102, 241, 0.4);
            animation: flowingLine2 22s ease-in-out infinite;
        }

        .flowing-line:nth-child(3) {
            stroke: rgba(168, 85, 247, 0.4);
            animation: flowingLine3 26s ease-in-out infinite;
        }

        .flowing-line:nth-child(4) {
            stroke: rgba(147, 51, 234, 0.3);
            animation: flowingLine4 30s ease-in-out infinite;
        }

        @keyframes flowingLine1 {

            0%,
            100% {
                opacity: 0.5;
                stroke-width: 2;
            }

            50% {
                opacity: 0.8;
                stroke-width: 3;
            }
        }

        @keyframes flowingLine2 {

            0%,
            100% {
                opacity: 0.4;
                stroke-width: 2;
            }

            50% {
                opacity: 0.7;
                stroke-width: 2.5;
            }
        }

        @keyframes flowingLine3 {

            0%,
            100% {
                opacity: 0.4;
                stroke-width: 2;
            }

            50% {
                opacity: 0.6;
                stroke-width: 3;
            }
        }

        @keyframes flowingLine4 {

            0%,
            100% {
                opacity: 0.3;
                stroke-width: 2;
            }

            50% {
                opacity: 0.5;
                stroke-width: 2.5;
            }
        }

        /* Enhanced Auth Container */
        .auth-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1000px;
            display: flex;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            animation: slideUpFade 1s ease-out;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(80px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .auth-illustration {
            flex: 1;
            background: var(--gradient-primary);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            display: none;
            position: relative;
            overflow: hidden;
        }

        .auth-illustration::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotateGlow 20s linear infinite;
        }

        @keyframes rotateGlow {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .illustration-img {
            max-width: 100%;
            margin-bottom: 30px;
            animation: floatIllustration 6s ease-in-out infinite;
            z-index: 1;
        }

        @keyframes floatIllustration {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .illustration-text {
            text-align: center;
            font-size: 1.2rem;
            max-width: 350px;
            z-index: 1;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-panel {
            flex: 1;
            background: var(--card-bg);
            padding: 40px;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .auth-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.4);
            animation: pulseGlow 3s ease-in-out infinite;
            position: relative;
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: var(--gradient-primary);
            z-index: -1;
            animation: ripple 2s infinite;
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 8px 25px rgba(108, 99, 255, 0.4);
                transform: scale(1);
            }

            50% {
                box-shadow: 0 12px 35px rgba(108, 99, 255, 0.6);
                transform: scale(1.05);
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }

        .auth-title {
            color: var(--text-primary);
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--primary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
            animation: slideInLeft 0.6s ease-out both;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(5) {
            animation-delay: 0.5s;
        }

        .form-group:nth-child(6) {
            animation-delay: 0.6s;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-group label {
            display: block;
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .label-icon {
            margin-right: 12px;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 18px 24px 18px 50px;
            background: var(--background-light);
            border: 2px solid transparent;
            border-radius: 16px;
            color: var(--text-primary);
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 6px rgba(108, 99, 255, 0.12);
            transform: translateY(-2px);
        }

        .form-control:focus::placeholder {
            opacity: 0.5;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50px;
            color: var(--text-secondary);
            transition: all 0.3s ease;
            z-index: 2;
        }

        .form-group:focus-within .input-icon {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .form-group:focus-within .label-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
            box-shadow: 0 0 0 6px rgba(255, 107, 107, 0.12);
            animation: shakeError 0.6s ease-in-out;
        }

        @keyframes shakeError {

            0%,
            20%,
            40%,
            60%,
            80% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }
        }

        .form-control.is-valid {
            border-color: var(--success-color);
            box-shadow: 0 0 0 6px rgba(78, 203, 113, 0.12);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 10px;
            display: flex;
            align-items: center;
            animation: fadeInDown 0.3s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-icon {
            margin-right: 6px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .success-message {
            color: var(--success-color);
            font-size: 0.85rem;
            margin-top: 10px;
            display: flex;
            align-items: center;
            animation: fadeInDown 0.3s ease-out;
        }

        .error-message-box {
            background: linear-gradient(135deg, rgba(255, 107, 107, 0.1) 0%, rgba(255, 107, 107, 0.05) 100%);
            border: 1px solid rgba(255, 107, 107, 0.3);
            color: var(--error-color);
            padding: 18px;
            border-radius: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            animation: slideInDown 0.5s ease-out;
            backdrop-filter: blur(10px);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-message-box i {
            margin-right: 12px;
            font-size: 1.3rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            60%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            80% {
                transform: translateY(-5px);
            }
        }

        .submit-btn {
            width: 100%;
            padding: 20px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 15px;
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out 0.8s both;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .submit-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(108, 99, 255, 0.6);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .submit-btn i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .submit-btn:hover i {
            transform: translateX(5px);
        }

        .form-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(108, 106, 153, 0.2);
            animation: fadeIn 0.6s ease-out 1s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .form-footer p {
            color: var(--text-secondary);
            margin-bottom: 15px;
        }

        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .form-footer a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background: var(--primary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .form-footer a:hover::after {
            width: 100%;
        }

        .username-info {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 10px;
            padding-left: 12px;
            transition: all 0.3s ease;
        }

        .password-toggle {
            position: absolute;
            right: 18px;
            top: 50px;
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .password-strength {
            height: 8px;
            margin-top: 12px;
            border-radius: 4px;
            background: var(--background-light);
            overflow: hidden;
            position: relative;
        }

        .password-strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1), background 0.3s ease;
            border-radius: 4px;
            position: relative;
        }

        .password-strength-meter::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: strengthShimmer 2s infinite;
        }

        @keyframes strengthShimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .password-strength-text {
            font-size: 0.8rem;
            margin-top: 10px;
            color: var(--text-secondary);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            animation: fadeInUp 0.6s ease-out 0.9s both;
        }

        .social-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--background-light);
            color: var(--text-primary);
            border: 2px solid rgba(108, 106, 153, 0.2);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1.3rem;
            position: relative;
            overflow: hidden;
        }

        .social-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(108, 99, 255, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.4s ease;
        }

        .social-btn:hover::before {
            width: 200%;
            height: 200%;
        }

        .social-btn:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .social-btn.google:hover {
            color: #DB4437;
            border-color: #DB4437;
        }

        .social-btn.facebook:hover {
            color: #4267B2;
            border-color: #4267B2;
        }

        .social-btn.twitter:hover {
            color: #1DA1F2;
            border-color: #1DA1F2;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-secondary);
            margin: 25px 0;
            font-weight: 500;
            animation: fadeIn 0.6s ease-out 0.7s both;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(108, 106, 153, 0.2);
        }

        .divider:not(:empty)::before {
            margin-right: 20px;
        }

        .divider:not(:empty)::after {
            margin-left: 20px;
        }

        /* Responsive Design */
        @media (min-width: 992px) {
            .auth-illustration {
                display: flex;
            }
        }

        @media (max-width: 768px) {
            .auth-wrapper {
                flex-direction: column;
                max-width: 500px;
                border-radius: 20px;
            }

            .auth-panel {
                padding: 30px;
            }

            .logo-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }

            .auth-panel {
                padding: 25px 20px;
            }

            .auth-title {
                font-size: 2rem;
            }

            .form-control {
                padding: 16px 20px 16px 45px;
            }

            .input-icon {
                top: 48px;
            }

            .password-toggle {
                top: 48px;
            }
        }
    </style>
</head>

<body>
    <!-- Enhanced Dynamic Background -->
    <div class="background-container">
        <!-- Floating Particles -->
        <div class="particles" id="particles"></div>

        <!-- Wave Container -->
        <div class="wave-container">
            <svg class="wave" viewBox="0 0 1200 800" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,400 C300,200 600,600 900,400 C1050,300 1200,500 1200,400 L1200,800 L0,800 Z"
                    fill="url(#gradient1)" />
                <defs>
                    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:rgba(96,165,250,0.3);stop-opacity:1" />
                        <stop offset="100%" style="stop-color:rgba(59,130,246,0.1);stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>

            <svg class="wave" viewBox="0 0 1200 800" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,300 C400,100 800,500 1200,300 L1200,800 L0,800 Z" fill="url(#gradient2)" />
                <defs>
                    <linearGradient id="gradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:rgba(139,92,246,0.2);stop-opacity:1" />
                        <stop offset="100%" style="stop-color:rgba(99,102,241,0.1);stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>

            <svg class="wave" viewBox="0 0 1200 800" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,500 C200,300 400,600 600,400 C800,200 1000,600 1200,400 L1200,800 L0,800 Z"
                    fill="url(#gradient3)" />
                <defs>
                    <linearGradient id="gradient3" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:rgba(168,85,247,0.15);stop-opacity:1" />
                        <stop offset="100%" style="stop-color:rgba(147,51,234,0.05);stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Enhanced Flowing Lines -->
        <div class="flowing-lines">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <path class="flowing-line" d="M-200,400 Q200,200 600,400 T1400,400">
                    <animate attributeName="d" values="M-200,400 Q200,200 600,400 T1400,400;
                                    M-200,300 Q300,100 700,300 T1400,500;
                                    M-200,500 Q150,250 550,450 T1400,300;
                                    M-200,350 Q400,150 800,350 T1400,450;
                                    M-200,400 Q200,200 600,400 T1400,400" dur="18s" repeatCount="indefinite" />
                </path>
                <path class="flowing-line" d="M-200,300 Q300,500 700,300 T1400,600">
                    <animate attributeName="d" values="M-200,300 Q300,500 700,300 T1400,600;
                                    M-200,450 Q250,200 650,450 T1400,350;
                                    M-200,200 Q400,400 800,200 T1400,500;
                                    M-200,550 Q350,300 750,550 T1400,250;
                                    M-200,300 Q300,500 700,300 T1400,600" dur="22s" repeatCount="indefinite" />
                </path>
                <path class="flowing-line" d="M-200,600 Q400,300 800,600 T1400,200">
                    <animate attributeName="d" values="M-200,600 Q400,300 800,600 T1400,200;
                                    M-200,250 Q500,450 900,250 T1400,550;
                                    M-200,450 Q200,150 600,450 T1400,400;
                                    M-200,350 Q450,600 850,350 T1400,150;
                                    M-200,600 Q400,300 800,600 T1400,200" dur="26s" repeatCount="indefinite" />
                </path>
                <path class="flowing-line" d="M-200,150 Q350,400 750,150 T1400,550">
                    <animate attributeName="d" values="M-200,150 Q350,400 750,150 T1400,550;
                                    M-200,500 Q450,200 850,500 T1400,100;
                                    M-200,350 Q300,600 700,350 T1400,450;
                                    M-200,100 Q400,350 800,100 T1400,600;
                                    M-200,150 Q350,400 750,150 T1400,550" dur="30s" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="auth-wrapper">
        <div class="auth-illustration">
            <div class="illustration-img">
                <svg width="250" height="250" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="250" cy="250" r="250" fill="url(#paint0_linear)" />
                    <path
                        d="M250 130C227.909 130 210 147.909 210 170V330C210 352.091 227.909 370 250 370C272.091 370 290 352.091 290 330V170C290 147.909 272.091 130 250 130Z"
                        fill="white" />
                    <path
                        d="M330 210C330 187.909 312.091 170 290 170H210C187.909 170 170 187.909 170 210C170 232.091 187.909 250 210 250H290C312.091 250 330 232.091 330 210Z"
                        fill="white" />
                    <defs>
                        <linearGradient id="paint0_linear" x1="250" y1="0" x2="250" y2="500"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#6C63FF" />
                            <stop offset="1" stop-color="#4A40E5" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <div class="illustration-text">
                <h3>Join Our Community</h3>
                <p>Create an account to access exclusive features and content</p>
            </div>
        </div>

        <div class="auth-panel">
            <div class="auth-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
                <h2 class="auth-title">Create Account</h2>
                <p class="auth-subtitle">Sign up to get started with our platform</p>
            </div>

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user label-icon"></i>Full Name
                    </label>
                    <i class="fas fa-user input-icon"></i>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Enter your full name">
                    @error('name')
                        <div class="error-message"><i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-at label-icon"></i>Username
                    </label>
                    <i class="fas fa-at input-icon"></i>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" required autocomplete="username"
                        placeholder="Choose a username">
                    <div class="username-info">Username will be auto-generated from your name, but you can customize it
                    </div>
                    <div id="username-status" class="username-info"></div>

                    @error('username')
                        <div class="error-message"><i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="company_name">
                        <i class="fas fa-building label-icon"></i>Company Name (Optional)
                    </label>
                    <i class="fas fa-building input-icon"></i>
                    <input id="company_name" type="text"
                        class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                        value="{{ old('company_name') }}" autocomplete="organization"
                        placeholder="Enter your company name">
                    @error('company_name')
                        <div class="error-message"><i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope label-icon"></i>Email Address
                    </label>
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="Enter your email address">
                    @error('email')
                        <div class="error-message"><i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock label-icon"></i>Password (min 6 characters)
                    </label>
                    <i class="fas fa-lock input-icon"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Create a strong password">
                    <button type="button" class="password-toggle" id="passwordToggle">
                        <i class="far fa-eye"></i>
                    </button>
                    <div class="password-strength">
                        <div class="password-strength-meter" id="passwordStrengthMeter"></div>
                    </div>
                    <div class="password-strength-text" id="passwordStrengthText"></div>
                    @error('password')
                        <div class="error-message"><i class="fas fa-exclamation-circle error-icon"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">
                        <i class="fas fa-lock label-icon"></i>Confirm Password
                    </label>
                    <i class="fas fa-lock input-icon"></i>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirm your password">
                    <button type="button" class="password-toggle" id="confirmPasswordToggle">
                        <i class="far fa-eye"></i>
                    </button>
                    <div id="password-match" class="username-info"></div>
                </div>

                @if ($errors->any())
                    <div class="error-message-box">
                        <i class="fas fa-exclamation-triangle"></i>
                        Registration failed. Please check the errors above.
                    </div>
                @endif

                <button type="submit" class="submit-btn">
                    Create Account <i class="fas fa-arrow-right"></i>
                </button>
            </form>



            <div class="form-footer">
                <p>Already have an account? <a href="/login">Sign In</a></p>
            </div>
        </div>
    </div>

    <script>
        // Create floating particles (lighter version)
        function createParticles() {
            const particleContainer = document.getElementById('particles');
            const particleCount = 6; // हल्का load

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                const size = Math.random() * 6 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 10 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';

                particleContainer.appendChild(particle);
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            createParticles();

            const nameInput = document.getElementById("name");
            const usernameInput = document.getElementById("username");
            const usernameStatus = document.getElementById("username-status");
            const passwordInput = document.getElementById("password");
            const confirmPasswordInput = document.getElementById("password-confirm");
            const passwordMatch = document.getElementById("password-match");
            const passwordStrengthMeter = document.getElementById("passwordStrengthMeter");
            const passwordStrengthText = document.getElementById("passwordStrengthText");
            const passwordToggle = document.getElementById("passwordToggle");
            const confirmPasswordToggle = document.getElementById("confirmPasswordToggle");
            const submitBtn = document.querySelector('.submit-btn');
            const registerForm = document.getElementById('registerForm');

            // CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Name → auto username
            nameInput.addEventListener("input", function () {
                let nameValue = nameInput.value.trim().toLowerCase();

                if (nameValue !== "") {
                    let autoUsername = nameValue
                        .replace(/\s+/g, ".")
                        .replace(/[^a-z0-9._]/g, "");

                    usernameInput.value = autoUsername;
                    validateUsername(autoUsername);
                }
            });

            // Username validation (live DB check with POST)
            usernameInput.addEventListener("input", function () {
                validateUsername(usernameInput.value.trim());
            });

            async function validateUsername(username) {
                if (username === "") {
                    usernameStatus.innerHTML = '⚠️ Username is required.';
                    usernameStatus.style.color = "#FF6B6B";
                    return;
                }

                if (username.length < 4) {
                    usernameStatus.innerHTML = '⚠️ At least 4 characters.';
                    usernameStatus.style.color = "#FF6B6B";
                    return;
                }

                if (!/^[a-zA-Z0-9._]+$/.test(username)) {
                    usernameStatus.innerHTML = '⚠️ Only letters, numbers, underscores, and dots allowed.';
                    usernameStatus.style.color = "#FF6B6B";
                    return;
                }

                // 🔥 POST request to Laravel backend
                usernameStatus.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
                try {
                    let res = await fetch(`/check-username`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: JSON.stringify({ username: username })
                    });

                    let data = await res.json();

                    if (data.exists) {
                        usernameStatus.innerHTML = '❌ Username already taken.';
                        usernameStatus.style.color = "#FF6B6B";
                    } else {
                        usernameStatus.innerHTML = '✅ Username available!';
                        usernameStatus.style.color = "#4ECB71";
                    }
                } catch (e) {
                    usernameStatus.innerHTML = '⚠️ Error checking username.';
                    usernameStatus.style.color = "#FF6B6B";
                }
            }

            // Password show/hide
            passwordToggle.addEventListener("click", function () {
                passwordInput.type = passwordInput.type === "password" ? "text" : "password";
                passwordToggle.innerHTML = passwordInput.type === "password" ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>';
            });

            confirmPasswordToggle.addEventListener("click", function () {
                confirmPasswordInput.type = confirmPasswordInput.type === "password" ? "text" : "password";
                confirmPasswordToggle.innerHTML = confirmPasswordInput.type === "password" ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>';
            });

            // Password strength
            passwordInput.addEventListener("input", function () {
                const password = passwordInput.value;
                let strength = 0;

                if (password.length >= 6) strength += 20;
                if (password.length >= 8) strength += 20;
                if (/[A-Z]/.test(password)) strength += 20;
                if (/[0-9]/.test(password)) strength += 20;
                if (/[^A-Za-z0-9]/.test(password)) strength += 20;

                let message = "Weak", color = "#FF6B6B";
                if (strength >= 40 && strength < 80) {
                    message = "Medium"; color = "#FFC145";
                } else if (strength >= 80) {
                    message = "Strong"; color = "#4ECB71";
                }

                passwordStrengthMeter.style.width = strength + "%";
                passwordStrengthMeter.style.background = color;
                passwordStrengthText.textContent = message;

                checkPasswordMatch();
            });

            // Confirm password match
            confirmPasswordInput.addEventListener("input", checkPasswordMatch);
            function checkPasswordMatch() {
                if (passwordInput.value && confirmPasswordInput.value) {
                    if (passwordInput.value !== confirmPasswordInput.value) {
                        passwordMatch.innerHTML = '❌ Passwords do not match';
                        passwordMatch.style.color = "#FF6B6B";
                        return false;
                    } else {
                        passwordMatch.innerHTML = '✅ Passwords match';
                        passwordMatch.style.color = "#4ECB71";
                        return true;
                    }
                }
                return false;
            }

            // Submit loading
            registerForm.addEventListener('submit', function () {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
                submitBtn.style.pointerEvents = 'none';
            });
        });
    </script>



</body>

</html>