<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    @error('email')
        <p style="color:red;">{{ $message }}</p>
    @enderror

    <button type="submit">Login</button>
</form>