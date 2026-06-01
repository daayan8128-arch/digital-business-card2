<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow p-6 space-y-6">
        <h2 class="text-2xl font-bold text-center">Verify OTP</h2>

        <!-- Error / Success messages -->
        <div id="message" class="hidden p-3 rounded"></div>

        <form id="otpForm" method="POST" action="{{ route('otp.verify.post') }}" class="space-y-4">
            @csrf
            <div class="flex justify-between space-x-2">
                <!-- 6 OTP input boxes -->
                <input type="text" maxlength="1" name="otp[]" class="otp-input w-12 h-12 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-xl" required>
                <input type="text" maxlength="1" name="otp[]" class="otp-input w-12 h-12 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-xl" required>
                <input type="text" maxlength="1" name="otp[]" class="otp-input w-12 h-12 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-xl" required>
                <input type="text" maxlength="1" name="otp[]" class="otp-input w-12 h-12 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-xl" required>
                <input type="text" maxlength="1" name="otp[]" class="otp-input w-12 h-12 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-xl" required>
                <input type="text" maxlength="1" name="otp[]" class="otp-input w-12 h-12 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-xl" required>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
            >
                Verify OTP
            </button>
        </form>
    </div>

    <script>
        const inputs = document.querySelectorAll('.otp-input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Optional: Combine OTP before submit
        document.getElementById('otpForm').addEventListener('submit', function(e){
            const otpValue = Array.from(inputs).map(input => input.value).join('');
            if(otpValue.length !== inputs.length){
                e.preventDefault();
                const message = document.getElementById('message');
                message.className = "bg-red-100 text-red-700 p-3 rounded";
                message.innerText = "Please enter complete OTP";
                message.classList.remove("hidden");
            } else {
                // create a hidden input with combined OTP
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "otp";
                hiddenInput.value = otpValue;
                this.appendChild(hiddenInput);
            }
        });
    </script>

</body>
</html>
