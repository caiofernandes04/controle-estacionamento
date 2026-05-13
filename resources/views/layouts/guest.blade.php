<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login - Estacionamento Cavalini</title>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="auth-page">
        <main class="auth-wrapper">
            <section class="ticket auth-card">
                <div class="title">Estacionamento Cavalini</div>
                <div class="subtitle">Acesso ao sistema</div>

                {{ $slot }}
            </section>
        </main>
    </body>
</html>
