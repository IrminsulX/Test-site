<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | About us</title>

    <link rel="stylesheet" href="{{ asset('css/aboutpage.css') }}">
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

    <!-- About Studio section -->

    <div class="about-section">
        <div class="about-heading">
            <span class="about-star">&#9733;</span>
            <h2>ABOUT US</h2>
            <span class="about-star">&#9733;</span>
        </div>

        <div class="main-dashboard">
            <div class="about-container">
                <div class="about-content">
                    <h1>Irminsul Studio ツ</h1>
                    <p class="about-lead">Irminsul Studio is committed to creating engaging, high-quality games that bring players together. We provide frequent updates, listen to player feedback, and foster a community-driven environment where gamers' voices shape the evolution of our games.</p>
                    <p>At Irminsul Studio, our mission goes beyond creating games — we aim to build a thriving, inclusive, and creative gaming community. Through our games, we provide immersive storytelling, innovative gameplay, and spaces where players can connect, collaborate, and share their experiences.</p>
                    <p>We actively listen to player feedback, using it to shape game updates and future projects, ensuring that our community's voice drives the evolution of our content. Beyond the games themselves, we foster engagement through interactive events, forums, and social media channels, giving players opportunities to showcase their creativity, share strategies, and participate in discussions that shape the games they love.</p>
                    <p>Irminsul Studio also believes in empowering aspiring developers and content creators by offering insights into game development, collaborating on community-driven content, and supporting fan-driven projects. Our commitment is to not only entertain but to inspire and uplift the gaming community, creating a space where every player feels valued and involved.</p>
                </div>
                <div class="about-image">
                    <img src="{{ asset('images/StudioLogo.png') }}" alt="Studio Logo">
                </div>
            </div>
        </div>

        <div class="about-stats">
            <div class="stat-card">
                <span class="stat-number">5+</span>
                <span class="stat-label">Games Released</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">10K+</span>
                <span class="stat-label">Active Players</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Community Driven</span>
            </div>
        </div>
    </div>

    <!-- Team Sign section -->

    <div class="about-section">
        <div class="about-heading">
            <span class="about-star">&#9733;</span>
            <h2>DEVELOPERS</h2>
            <span class="about-star">&#9733;</span>
        </div>

        <div class="devteam-container">

            @forelse ($teamMembers as $member)
            <div class="devteam-card">
                <b></b>

                <div class="profile-container">
                    <img class="profile-img" src="{{ $member->image_path ? asset('storage/' . $member->image_path) : asset('images/StudioLogo.png') }}" alt="{{ $member->name }}">
                </div>

                <div class="devteam-content">
                    <p class="title">{{ $member->name }}<br><span>{{ $member->role }}</span></p>
                    @if($member->instagram || $member->twitter || $member->discord || $member->bluesky)
                    <ul class="sci">
                        @if($member->instagram)
                        <li>
                            <a href="{{ $member->instagram }}" target="_blank">
                                <img src="{{ asset('images/instagram-white-icon.png') }}" alt="Instagram">
                            </a>
                        </li>
                        @endif
                        @if($member->bluesky)
                        <li>
                            <a href="{{ $member->bluesky }}" target="_blank">
                                <img src="{{ asset('images/bluesky-icon.png') }}" alt="bluesky">
                            </a>
                        </li>
                        @endif
                        @if($member->twitter)
                        <li>
                            <a href="{{ $member->twitter }}" target="_blank">
                                <img src="{{ asset('images/x-social-media-white-icon.png') }}" alt="twitter">
                            </a>
                        </li>
                        @endif
                        @if($member->discord)
                        <li>
                            <a href="{{ $member->discord }}" target="_blank">
                                <img src="{{ asset('images/discord-white-icon.png') }}" alt="discord">
                            </a>
                        </li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888;">
                    <p>No team members listed yet.</p>
                </div>
            @endforelse

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
                            <img src="{{ asset('images/discord-white-icon.png') }}" alt="discord">
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
                                <a href="{{ route('privacy') }}" class="footer-link">Privacy</a>
                                <span class="footer-sep">|</span>
                                <a href="{{ route('terms') }}" class="footer-link">Terms</a>
                                <span class="footer-sep">|</span>
                                <a href="{{ route('press-kit') }}" class="footer-link">Press Kit</a>
                                &copy; 2025 Irminsul Studio ツ
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
