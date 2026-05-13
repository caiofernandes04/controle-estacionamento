<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
            <label for="name">Nome</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">

            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">

            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">

            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Confirmar senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">

            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Cadastrar</button>

        <div class="auth-links">
            <a href="{{ route('login') }}">Ja tenho conta</a>
        </div>
    </form>
</x-guest-layout>
