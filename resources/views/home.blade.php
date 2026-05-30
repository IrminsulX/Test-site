<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | Home</title>

    <link rel="stylesheet" href="css/main.css">
    <script src="/js/homepage.js"></script>
    
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
                            <button class="sign-out-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Sign out') }}
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest

                </ul>
            </div>
            
        </nav>
    </nav>

    <!-- Hero Gallery Section -->

    <section class="hero-gallery">
        <div class="hero-gallery-inner">
            @forelse (\App\Models\AdminHomepageImages::all() as $image)
                <div class="hero-item">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->game_name }}">
                    <div class="hero-item-overlay">
                        <span>{{ $image->game_name }}</span>
                    </div>
                </div>
            @empty
                <div class="hero-empty">
                    <div class="hero-empty-icon">&#9733;</div>
                    <h2>Irminsul Studio</h2>
                    <p>Games that bring players together</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Stats Strip -->

    <section class="stats-strip">
        <div class="stats-item">
            <span class="stats-number">5+</span>
            <span class="stats-label">Games Released</span>
        </div>
        <div class="stats-divider"></div>
        <div class="stats-item">
            <span class="stats-number">10K+</span>
            <span class="stats-label">Active Players</span>
        </div>
        <div class="stats-divider"></div>
        <div class="stats-item">
            <span class="stats-number">24/7</span>
            <span class="stats-label">Community Driven</span>
        </div>
    </section>

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



    





    <!-- Community Section -->

    <section class="community-panel">
        <div class="community-heading">
            <span class="community-star">&#9733;</span>
            <h2>COMMUNITY</h2>
            <span class="community-star">&#9733;</span>
        </div>
        <div class="community-content">
            <div class="community-text">
                <p>Join thousands of players in our growing community. Stay connected through Discord and social media for game updates, events, and discussions.</p>
                <div class="community-links">
                    <a href="https://discord.com/" target="_blank" class="community-link">
                        <img src="{{ asset('images/discord-white-icon.png') }}" alt="Discord">
                        <span>Join Discord</span>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" class="community-link">
                        <img src="{{ asset('images/instagram-white-icon.png') }}" alt="Instagram">
                        <span>Follow Us</span>
                    </a>
                    <a href="https://x.com/?mx=2" target="_blank" class="community-link">
                        <img src="{{ asset('images/x-social-media-white-icon.png') }}" alt="Twitter">
                        <span>Twitter</span>
                    </a>
                </div>
            </div>
            <div class="community-brand">
                <img src="{{ asset('images/StudioLogo.png') }}" alt="Irminsul Studio">
            </div>
        </div>
    </section>

    

    <!-- Footer's section -->

    <nav class="footer">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                
                <div class="navbar-collapse" id="navbarNav">

                    <button class="social-media-buttons instagram">
                        <a href="https://www.instagram.com" target="_blank">
                            <img src="{{ asset('images/instagram-white-icon.png') }}" alt="Instagram">
                        </a>
                    </button>

                    <button class="social-media-buttons youtube">
                        <a href="https://www.youtube.com" target="_blank">
                            <img src="{{ asset('images/youtube-app-white-icon.png') }}" alt="YouTube">
                        </a>
                    </button>

                    <button class="social-media-buttons twitter">
                        <a href="https://x.com/?mx=2" target="_blank">
                            <img src="{{ asset('images/x-social-media-white-icon.png') }}" alt="twitter">
                        </a>
                    </button>

                    <button class="social-media-buttons discord">
                        <a href="https://discord.com/" target="_blank">
                            <img src="{{ asset('images/discord-white-icon.png') }}" alt="twitter">
                        </a>
                    </button>

                    <button class="social-media-buttons bluesky">
                        <a href="https://bsky.app/" target="_blank">
                            <img src="{{ asset('images/bluesky-icon.png') }}" alt="bluesky">
                        </a>
                    </button>

                    <div class="ms-auto" id="navbarSupportedContent">
                        <div class="navbar-container"> 

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('adminhomepages') }}">
                                        <button class="admin-dashboard-button">
                                            <span> Administrator Page </span>
                                        </button>
                                    </a>
                                @endif
                            @endauth

                            <div class="spinner-box">
                                <div class="configure-border-1">  
                                    <div class="configure-core"></div>
                                </div>  
                                <div class="configure-border-2">
                                    <div class="configure-core"></div>
                                </div> 
                            </div>

                            <div class="copyright">
                                © 2025 Irminsul Studio ツ
                            </div>

                        </div> 

                    </div>
                    
                </div>
            </div>
        </nav>
    </nav>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
