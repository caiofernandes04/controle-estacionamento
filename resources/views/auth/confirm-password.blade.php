<x-guest-layout>
    <div class="auth-text">
        Confirme sua senha para continuar.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="field">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">

            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Confirmar</button>
    </form>
</x-guest-layout>
