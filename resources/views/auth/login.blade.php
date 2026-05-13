<x-guest-layout>
    @if (session('status'))
        <div class="success-message">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">

            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">

            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-options">
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Lembrar acesso</span>
            </label>
        </div>

        <button type="submit">Entrar</button>

        <div class="auth-links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Esqueci minha senha</a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Criar conta</a>
            @endif
        </div>
    </form>
</x-guest-layout>
