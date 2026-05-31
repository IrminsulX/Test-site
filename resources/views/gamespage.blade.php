<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | Games Page</title>

    <link rel="stylesheet" href="{{ asset('css/gamespage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    
</head>

<body>

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

    <div class="games-dashboard">
        <h2>
            <a href="https://www.roblox.com" target="_blank">
                <img src="{{ asset('images/HD New Roblox Logo Icon PNG - 800x800.png') }}" alt="Roblox Logo" class="game-icon">
            </a>
            ROBLOX GAMES
        </h2>
    </div>

    <div class="container games-dashboard-background">

        <!-- 1st Row Left Image Section -->
        <div class="left-image">
            <img src="https://via.placeholder.com/100" alt="Left Image">
        </div>

        <!-- Center Content -->
        <div class="center-content">
            <div class="title">TITLE</div>
            <div class="description"><span>DESCRIPTION</span></div>
        </div>

        <!-- Right Image Section -->
        <div class="right-image">
            <img src="https://via.placeholder.com/100" alt="Right Image">
        </div>
        
        <!-- 2nd Row Left Image Section -->
        <div class="left-image">
            <img src="https://via.placeholder.com/100" alt="Left Image">
        </div>

        <!-- Center Content -->
        <div class="center-content">
            <div class="title">TITLE</div>
            <div class="description"><span>DESCRIPTION</span></div>
        </div>

        <!-- Right Image Section -->
        <div class="right-image">
            <img src="https://via.placeholder.com/100" alt="Right Image">
        </div>

    </div>

    <!-- Featured Games Section -->
    <div class="featured-section">
        <div class="featured-heading">
            <span class="featured-star">&#9733;</span>
            <h2>FEATURED GAMES</h2>
            <span class="featured-star">&#9733;</span>
        </div>

        <div class="featured-wrapper" id="featuredWrapper">
            <button class="featured-arrow prev" aria-label="Previous slide">&#10094;</button>

            <div class="featured-slider" id="featuredSlider">
                @forelse (\App\Models\AdminHomepageImages::where('type', 'featured')->get() as $image)
                    <div class="featured-slide">
                        <div class="featured-card-image">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->game_name }}" loading="lazy">
                            <div class="featured-card-overlay">
                                <h3 class="featured-card-title">{{ $image->game_name }}</h3>
                                <span class="featured-card-cta">View Game &#10132;</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="featured-empty">
                        <div class="featured-empty-icon">&#9733;</div>
                        <p>No featured games yet</p>
                        <span>Check back soon for exciting new releases!</span>
                    </div>
                @endforelse
            </div>

            <button class="featured-arrow next" aria-label="Next slide">&#10095;</button>

            <div class="featured-dots" id="featuredDots"></div>
        </div>
    </div>

    <!-- Footer's section -->

    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-social">
                <a href="https://www.instagram.com" target="_blank" class="social-btn instagram">
                        <img src="{{ asset('images/instagram-white-icon.png') }}" alt="Instagram">
                </a>
                <a href="https://www.youtube.com" target="_blank" class="social-btn youtube">
                        <img src="{{ asset('images/youtube-app-white-icon.png') }}" alt="YouTube">
                </a>
                <a href="https://x.com/?mx=2" target="_blank" class="social-btn twitter">
                        <img src="{{ asset('images/x-social-media-white-icon.png') }}" alt="twitter">
                </a>
                <a href="https://discord.com/" target="_blank" class="social-btn discord">
                        <img src="{{ asset('images/discord-white-icon.png') }}" alt="discord">
                </a>
                <a href="https://bsky.app/" target="_blank" class="social-btn bluesky">
                        <img src="{{ asset('images/bluesky-icon.png') }}" alt="bluesky">
                </a>
            </div>
            <div class="footer-center">
                <div class="footer-links">
                    <a href="{{ route('privacy') }}">Privacy</a>
                    <span class="sep">·</span>
                    <a href="{{ route('terms') }}">Terms</a>
                    <span class="sep">·</span>
                    <a href="{{ route('press-kit') }}">Press Kit</a>
                </div>
                <div class="footer-copyright">
                    &copy; 2025 Irminsul Studio ツ
                </div>
            </div>
            <div class="footer-right">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('adminhomepages') }}" class="footer-admin-btn">Admin</a>
                    @endif
                @endauth
                <div class="footer-spinner"></div>
            </div>
        </div>
    </footer>
    
<script src="/js/homepage.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
