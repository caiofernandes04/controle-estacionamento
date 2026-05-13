<x-guest-layout>
    <div class="auth-text">
        Informe seu email para receber o link de redefinicao de senha.
    </div>

    @if (session('status'))
        <div class="success-message">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Enviar link</button>

        <div class="auth-links">
            <a href="{{ route('login') }}">Voltar ao login</a>
        </div>
    </form>
</x-guest-layout>
