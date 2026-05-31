<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | News & Updates</title>

    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
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

    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="featured-star" style="color: #ffd700; font-size: 2rem;">&#9733;</span>
            <h2 class="d-inline mx-3" style="color: #fff; font-weight: bold;">NEWS & UPDATES</h2>
            <span class="featured-star" style="color: #ffd700; font-size: 2rem;">&#9733;</span>
        </div>

        <div class="row g-4">
            @forelse($posts as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="background-color: #272930; border: 1px solid #333; border-radius: 12px; overflow: hidden;">
                        <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                             alt="{{ $post->title }}"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="color: #fff;">{{ $post->title }}</h5>

                            <p class="card-text flex-grow-1" style="color: #aaa;">
                                {{ Str::limit($post->excerpt, 120) }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small style="color: #777;">
                                    <i class="far fa-calendar-alt me-1"></i>{{ $post->published_at->format('M d, Y') }}
                                </small>
                                @if($post->author)
                                    <small style="color: #777;">
                                        <i class="far fa-user me-1"></i>{{ $post->author->name ?? 'Unknown' }}
                                    </small>
                                @endif
                            </div>

                            <a href="{{ route('posts.show', $post) }}" class="btn w-100 mt-3" style="background-color: #212121; color: #fff; border: 1px solid #444; border-radius: 8px;">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div style="font-size: 3rem; color: #ffd700;">&#9733;</div>
                    <p style="color: #aaa; font-size: 1.2rem; margin-top: 1rem;">No news posts yet</p>
                    <span style="color: #777;">Check back soon for updates!</span>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    </div>

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
