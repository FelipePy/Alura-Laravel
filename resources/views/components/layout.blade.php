<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>

            @auth
                <a class="text-decoration-none text-black" href="{{ route('logout') }}">Sair</a>
            @endauth

            @if($title != 'Login')
                @guest
                    <a class="text-decoration-none text-black" href="{{ route('login') }}">Entrar</a>
                @endguest
            @endif


        </div>
    </nav>

        <div class="container">
            <h1>{{ $title }}</h1>

            @isset($successMessage)
                <div class="alert alert-success">
                    {{ $successMessage }}
                </div>
            @endisset

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </div>

    </body>
</html>
