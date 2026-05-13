<x-guest-layout>
    <div class="auth-text">
        Verifique seu email pelo link enviado. Se nao recebeu, envie novamente.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="success-message">
            Um novo link de verificacao foi enviado para seu email.
        </div>
    @endif

    <div class="auth-actions">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit">Enviar novamente</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="secondary-button">Sair</button>
        </form>
    </div>
</x-guest-layout>
