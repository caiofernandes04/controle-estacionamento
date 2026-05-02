<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

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