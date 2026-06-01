<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow p-6 space-y-6">
        <h2 class="text-2xl font-bold text-center">Reset Password</h2>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Success --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('reset-password.post') }}" class="space-y-4" id="resetForm">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            {{-- New Password --}}
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="New Password"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3 pr-10 focus:ring-2"
                    style="focus:ring-color: #D97706;"
                />
                <button type="button" onclick="togglePassword('password', this)" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    👁
                </button>
            </div>

            {{-- Confirm Password --}}
            <div class="relative">
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Confirm Password"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3 pr-10 focus:ring-2"
                    style="focus:ring-color: #D97706;"
                />
                <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                    👁
                </button>
            </div>

            {{-- Password match warning --}}
            <p id="password-match-msg" class="text-red-600 text-sm hidden">Passwords do not match!</p>

            <button
                type="submit"
                class="w-full text-white px-4 py-2 rounded-lg transition"
                style="background-color: #D97706;"
                onmouseover="this.style.backgroundColor='#B45309'"
                onmouseout="this.style.backgroundColor='#D97706'"
            >
                Reset Password
            </button>
        </form>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            if (input.type === "password") {
                input.type = "text";
                btn.textContent = "🙈"; // change icon
            } else {
                input.type = "password";
                btn.textContent = "👁";
            }
        }

        // Check if passwords match
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const matchMsg = document.getElementById('password-match-msg');
        const form = document.getElementById('resetForm');

        function checkPasswordMatch() {
            if (confirmPassword.value && password.value !== confirmPassword.value) {
                matchMsg.classList.remove('hidden');
                return false;
            } else {
                matchMsg.classList.add('hidden');
                return true;
            }
        }

        confirmPassword.addEventListener('input', checkPasswordMatch);
        password.addEventListener('input', checkPasswordMatch);

        form.addEventListener('submit', function(e) {
            if (!checkPasswordMatch()) {
                e.preventDefault(); // prevent form submission if passwords do not match
            }
        });
    </script>

</body>
</html>
