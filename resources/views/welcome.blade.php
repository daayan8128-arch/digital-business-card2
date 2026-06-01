<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digital Business Card</title>
  <style>
    :root {
      --primary-color: #1e40af;
      --secondary-color: #3b82f6;
      --accent-color: #60a5fa;
      --text-primary: #1f2937;
      --text-secondary: #6b7280;
      --background-light: #f8fafc;
      --white: #ffffff;
      --gradient-primary: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
      --purple-dark: #2d1b69;
      --purple-gradient: linear-gradient(135deg, #2d1b69 0%, #1e1b4b 50%, #0f0a2e 100%);
      --error-color: #ef4444;
      --success-color: #10b981;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      overflow: hidden;
      background: var(--purple-gradient);
      height: 100vh;
      position: relative;
    }

    .wave-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .wave {
      position: absolute;
      width: 200%;
      height: 200%;
      opacity: 0.1;
    }

    .wave:nth-child(1) {
      animation: wave1 20s ease-in-out infinite;
      animation-delay: 0s;
    }

    .wave:nth-child(2) {
      animation: wave2 25s ease-in-out infinite;
      animation-delay: -5s;
    }

    .wave:nth-child(3) {
      animation: wave3 30s ease-in-out infinite;
      animation-delay: -10s;
    }

    @keyframes wave1 {

      0%,
      100% {
        transform: translateX(-50%) translateY(-50%) rotate(0deg) scale(1);
      }

      50% {
        transform: translateX(-40%) translateY(-60%) rotate(180deg) scale(1.1);
      }
    }

    @keyframes wave2 {

      0%,
      100% {
        transform: translateX(-60%) translateY(-40%) rotate(0deg) scale(0.9);
      }

      50% {
        transform: translateX(-30%) translateY(-50%) rotate(-180deg) scale(1.2);
      }
    }

    @keyframes wave3 {

      0%,
      100% {
        transform: translateX(-40%) translateY(-60%) rotate(0deg) scale(1.1);
      }

      50% {
        transform: translateX(-50%) translateY(-30%) rotate(360deg) scale(0.8);
      }
    }

    /* Flowing Lines Design */
    .flowing-lines {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 5;
      opacity: 0.6;
    }

    .flowing-line {
      position: absolute;
      stroke: rgba(255, 255, 255, 0.3);
      stroke-width: 1;
      fill: none;
      animation: flowingLine 15s ease-in-out infinite;
    }

    .flowing-line:nth-child(1) {
      animation-delay: 0s;
      stroke: rgba(139, 92, 246, 0.4);
    }

    .flowing-line:nth-child(2) {
      animation-delay: -3s;
      stroke: rgba(99, 102, 241, 0.3);
    }

    .flowing-line:nth-child(3) {
      animation-delay: -6s;
      stroke: rgba(168, 85, 247, 0.3);
    }

    .flowing-line:nth-child(4) {
      animation-delay: -9s;
      stroke: rgba(147, 51, 234, 0.2);
    }

    @keyframes flowingLine {

      0%,
      100% {
        d: path("M-200,400 Q200,200 600,400 T1400,400");
        opacity: 0.6;
      }

      25% {
        d: path("M-200,300 Q300,100 700,300 T1400,500");
        opacity: 0.8;
      }

      50% {
        d: path("M-200,500 Q150,250 550,450 T1400,300");
        opacity: 0.4;
      }

      75% {
        d: path("M-200,350 Q400,150 800,350 T1400,450");
        opacity: 0.7;
      }
    }

    .main-content {
      position: relative;
      z-index: 10;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      transition: all 0.8s ease;
    }

    .main-content.hidden {
      opacity: 0;
      transform: scale(0.9);
      pointer-events: none;
    }

    .welcome-text {
      text-align: center;
      text-transform: uppercase;
      color: white;
      font-size: clamp(3rem, 8vw, 8rem);
      font-weight: 900;
      letter-spacing: -0.02em;
      text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      animation: fadeInUp 1.5s ease-out;
      margin-bottom: 2rem;
    }

    .welcome-buttons {
      display: flex;
      gap: 1.5rem;
      animation: fadeInUp 1.5s ease-out 0.3s both;
    }

    .welcome-btn {
      padding: 1rem 2rem;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 12px;
      font-weight: 600;
      font-size: 1.1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
      text-decoration: none;
      display: inline-block;
    }

    .welcome-btn:hover {
      background: rgba(255, 255, 255, 0.2);
      border-color: rgba(255, 255, 255, 0.5);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 768px) {
      .welcome-text {
        font-size: clamp(2rem, 10vw, 4rem);
        padding: 0 1rem;
      }

      .welcome-buttons {
        flex-direction: column;
        gap: 1rem;
      }
    }
  </style>
</head>

<body>
  <div class="wave-container">
    <svg class="wave" viewBox="0 0 1200 800" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,400 C300,200 600,600 900,400 C1050,300 1200,500 1200,400 L1200,800 L0,800 Z" fill="url(#gradient1)" />
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
      <path d="M0,500 C200,300 400,600 600,400 C800,200 1000,600 1200,400 L1200,800 L0,800 Z" fill="url(#gradient3)" />
      <defs>
        <linearGradient id="gradient3" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:rgba(168,85,247,0.15);stop-opacity:1" />
          <stop offset="100%" style="stop-color:rgba(147,51,234,0.05);stop-opacity:1" />
        </linearGradient>
      </defs>
    </svg>
  </div>

  <!-- Flowing Lines Design -->
  <div class="flowing-lines">
    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
      <path class="flowing-line" d="M-200,400 Q200,200 600,400 T1400,400">
        <animate attributeName="d" values="M-200,400 Q200,200 600,400 T1400,400;
                            M-200,300 Q300,100 700,300 T1400,500;
                            M-200,500 Q150,250 550,450 T1400,300;
                            M-200,350 Q400,150 800,350 T1400,450;
                            M-200,400 Q200,200 600,400 T1400,400" dur="15s" repeatCount="indefinite" />
      </path>
      <path class="flowing-line" d="M-200,300 Q300,500 700,300 T1400,600">
        <animate attributeName="d" values="M-200,300 Q300,500 700,300 T1400,600;
                            M-200,450 Q250,200 650,450 T1400,350;
                            M-200,200 Q400,400 800,200 T1400,500;
                            M-200,550 Q350,300 750,550 T1400,250;
                            M-200,300 Q300,500 700,300 T1400,600" dur="18s" repeatCount="indefinite" />
      </path>
      <path class="flowing-line" d="M-200,600 Q400,300 800,600 T1400,200">
        <animate attributeName="d" values="M-200,600 Q400,300 800,600 T1400,200;
                            M-200,250 Q500,450 900,250 T1400,550;
                            M-200,450 Q200,150 600,450 T1400,400;
                            M-200,350 Q450,600 850,350 T1400,150;
                            M-200,600 Q400,300 800,600 T1400,200" dur="20s" repeatCount="indefinite" />
      </path>
      <path class="flowing-line" d="M-200,150 Q350,400 750,150 T1400,550">
        <animate attributeName="d" values="M-200,150 Q350,400 750,150 T1400,550;
                            M-200,500 Q450,200 850,500 T1400,100;
                            M-200,350 Q300,600 700,350 T1400,450;
                            M-200,100 Q400,350 800,100 T1400,600;
                            M-200,150 Q350,400 750,150 T1400,550" dur="22s" repeatCount="indefinite" />
      </path>
    </svg>
  </div>

  <div class="main-content" id="mainContent">
    <h1 class="welcome-text">Welcome to our site</h1>
    <div class="welcome-buttons">
     <a href="/login" class="welcome-btn">Login</a>
        <a href="{{ route('register') }}" class="welcome-btn">Register</a>
    </div>
  </div>
<script>
    // document.getElementById('loginForm').addEventListener('submit', function(e) {
    //         e.preventDefault();
    //         
    //         const formData = new FormData(this);
    //         
    //         fetch('/login', {
    //             method: 'POST',
    //             headers: {
    //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    //                 'Accept': 'application/json'
    //             },
    //             body: formData
    //         })
    //         .then(response => {
    //             if (response.redirected) {
    //                 window.location.href = response.url;
    //             }
    //             return response.json();
    //         })
    //         .then(data => {
    //             if (data.errors) {
    //                 // Handle validation errors
    //                 if (data.errors.email) {
    //                     showError('login-email', data.errors.email[0]);
    //                 }
    //                 if (data.errors.password) {
    //                     showError('login-password', data.errors.password[0]);
    //                 }
    //             }
    //         })
    //         .catch(error => console.error('Error:', error));
    //     });

        // Registration form handling
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/register', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
                return response.json();
            })
            .then(data => {
                if (data.errors) {
                    // Handle validation errors
                    if (data.errors.name) {
                        showError('register-name', data.errors.name[0]);
                    }
                    if (data.errors.email) {
                        showError('register-email', data.errors.email[0]);
                    }
                    if (data.errors.password) {
                        showError('register-password', data.errors.password[0]);
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
</script>
</body>

</html>