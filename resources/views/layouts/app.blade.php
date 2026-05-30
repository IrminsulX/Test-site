<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Irminsul Studio | {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <nav class="header">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/StudioLogo.png') }}" alt="Studio Logo" class="logo-icon">
                <button class="studio-button">Irminsul Studio ツ</button>
            </a>

            <!-- Hamburger Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavHeader" aria-controls="navbarNavHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavHeader">
                <ul class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ route('home') }}">
                        <button class="homepage-button">Home</button>
                    </a>
                    <a class="nav-link" href="{{ route('gamespage') }}">
                        <button class="homepage-button">Games</button>
                    </a>
                    <a class="nav-link" href="{{ route('aboutpage') }}">
                        <button class="homepage-button">About</button>
                    </a>
                    <a class="nav-link" href="{{ route('contact') }}">
                        <button class="homepage-button">Contact</button>
                    </a>

                    <div class="header-border"></div>

                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">
                                <button class="register-button">Log in</button>
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">
                                <button class="register-button">Sign up</button>
                            </a>
                        @endif
                    @else
                        <button class="auth-user-name nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-end auth-dropdown" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item auth-dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Sign out') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </ul>
            </div>
        </nav>
    </nav>

    <main class="auth-main">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
