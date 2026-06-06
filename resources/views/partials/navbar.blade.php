<!-- Header section -->
<nav class="header">
    <nav class="navbar navbar-expand-lg">

        <!-- Logo and Brand -->
        <a class="navbar d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/StudioLogo.png') }}" alt="Studio Logo" class="logo-icon">
            <button class="studio-button">Irminsul Studio ツ</button>
        </a>

        <!-- Hamburger Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavHeader" aria-controls="navbarNavHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Right Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarNavHeader">
            <ul class="navbar-nav ms-auto">

                <a class="nav-link" href="{{ route('home') }}">
                    <button class="homepage-button">Home</button>
                </a>

                <a class="nav-link" href="{{ route('games.index') }}">
                    <button class="homepage-button">Games</button>
                </a>

                <a class="nav-link" href="{{ route('posts.index') }}">
                    <button class="homepage-button">News</button>
                </a>

                <a class="nav-link" href="{{ route('forum.index') }}">
                    <button class="homepage-button">Forum</button>
                </a>

                <a class="nav-link" href="{{ route('aboutpage') }}">
                    <button class="homepage-button">About</button>
                </a>

                <a class="nav-link" href="{{ route('contact') }}">
                    <button class="homepage-button">Contact</button>
                </a>

                <a class="nav-link" href="{{ route('search') }}">
                    <button class="homepage-button" style="width: auto; padding: 10px 12px;"><i class="fas fa-search"></i></button>
                </a>

                <div class="header-border"></div>

                @guest
                    @if (Route::has('login'))
                        <a class="nav-link" href="{{ route('register') }}">
                            <button class="register-button">Sign up</button>
                        </a>
                        
                        <a class="nav-link" href="{{ route('login') }}">
                            <button class="register-button">Log in</button>
                        </a>
                    @endif

                @else
                    
                    <button class="log-out-button nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </button>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="sign-out-button" href="{{ route('profile.show', Auth::user()) }}">
                            {{ __('Profile') }}
                        </a>
                        <a class="sign-out-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
