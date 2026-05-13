<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    @include('includes.sidebar')

    <div class="content">

        @include('includes.alerts')

        @yield('content')

    </div>

</body>

</html>
