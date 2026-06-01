<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow p-6 space-y-6">
        <h2 class="text-2xl font-bold text-center">Forgot Password</h2>

        {{-- Error & Success Messages --}}
        @if (session('error'))
            <p class="text-red-600 text-center">{{ session('error') }}</p>
        @endif
        @if (session('success'))
            <p class="text-green-600 text-center">{{ session('success') }}</p>
        @endif

        {{-- Step 1: Email Form --}}
        <form method="POST" action="{{ route('forgot-password.request') }}" class="space-y-4" id="emailForm">
            @csrf
            <input type="email" name="email" value="{{ old('email', session('email')) }}" placeholder="Enter your email"
                required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2" />
            <button type="submit" class="w-full text-white px-4 py-2 rounded-lg transition"
                style="background-color: #D97706;" onmouseover="this.style.backgroundColor='#B45309'"
                onmouseout="this.style.backgroundColor='#D97706'">
                Send OTP
            </button>
        </form>

        {{-- Step 2: OTP Form (Visible only if OTP sent) --}}
        @if (session('showOtpForm'))
            <div class="mt-4 space-y-4">
                <form method="POST" action="{{ route('forgot-password.verify') }}" class="space-y-4" id="otpForm" onsubmit="combineOtp(event)">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <input type="hidden" name="otp" id="otp">

                    <div class="flex justify-center space-x-2">
                        @php
                            $otpLength = session('otp_length') ?? 6;
                        @endphp
                        @for ($i = 1; $i <= $otpLength; $i++)
                            <input type="text" maxlength="1"
                                class="w-12 h-12 text-center border rounded-md text-lg focus:ring-2 otp-input"
                                oninput="moveNext(this)" required>
                        @endfor
                    </div>

                    <button type="submit" class="w-full text-white px-4 py-2 rounded-lg transition"
                        style="background-color: #D97706;" onmouseover="this.style.backgroundColor='#B45309'"
                        onmouseout="this.style.backgroundColor='#D97706'">
                        Verify OTP
                    </button>
                </form>

                {{-- Resend OTP Section --}}
                <div class="text-center mt-2 text-gray-600">
                    <span id="timer">60</span> seconds remaining.
                    <button id="resendBtn" class="text-blue-600 underline disabled:opacity-50" disabled>Resend OTP</button>
                </div>
            </div>
        @endif

    </div>

    <script>
        // OTP Input Navigation
        function moveNext(el) {
            if (el.value.length === 1 && el.nextElementSibling) {
                el.nextElementSibling.focus();
            }
            if (el.value.length > 1) {
                el.value = el.value.slice(0,1);
            }
        }

        // Combine OTP digits before submit
        function combineOtp(e) {
            const inputs = document.querySelectorAll('.otp-input');
            const otp = Array.from(inputs).map(i => i.value).join('');
            if (otp.length !== inputs.length) {
                e.preventDefault();
                alert('Please enter complete OTP');
                return false;
            }
            document.getElementById('otp').value = otp;
            return true;
        }

        // Resend OTP Timer
        @if(session('showOtpForm'))
        let countdown = 60;
        const timerEl = document.getElementById('timer');
        const resendBtn = document.getElementById('resendBtn');

        const interval = setInterval(() => {
            countdown--;
            timerEl.textContent = countdown;
            if (countdown <= 0) {
                clearInterval(interval);
                resendBtn.disabled = false;
                timerEl.textContent = '';
            }
        }, 1000);

        // Resend OTP click
        resendBtn.addEventListener('click', function() {
            resendBtn.disabled = true;
            countdown = 60;
            timerEl.textContent = countdown;

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('email', '{{ session("email") }}');

            fetch("{{ route('forgot-password.request') }}", {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(() => {
                // restart countdown
                const interval2 = setInterval(() => {
                    countdown--;
                    timerEl.textContent = countdown;
                    if (countdown <= 0) {
                        clearInterval(interval2);
                        resendBtn.disabled = false;
                        timerEl.textContent = '';
                    }
                }, 1000);
            })
            .catch(err => {
                console.error(err);
                resendBtn.disabled = false;
            });
        });
        @endif
    </script>

</body>
</html>
