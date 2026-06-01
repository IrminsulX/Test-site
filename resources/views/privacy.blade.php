<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | Privacy Policy</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutpage.css') }}">
</head>
<body>

    <nav class="header">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/StudioLogo.png') }}" alt="Studio Logo" class="logo-icon">
                <button class="studio-button">Irminsul Studio ツ</button>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavHeader" aria-controls="navbarNavHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavHeader">
                <ul class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ route('home') }}"><button class="homepage-button">Home</button></a>
                    <a class="nav-link" href="{{ route('games.index') }}"><button class="homepage-button">Games</button></a>
                    <a class="nav-link" href="{{ route('posts.index') }}"><button class="homepage-button">News</button></a>
                    <a class="nav-link" href="{{ route('forum.index') }}"><button class="homepage-button">Forum</button></a>
                    <a class="nav-link" href="{{ route('aboutpage') }}"><button class="homepage-button">About</button></a>
                    <a class="nav-link" href="{{ route('contact') }}"><button class="homepage-button">Contact</button></a>
                    <a class="nav-link" href="{{ route('search') }}"><button class="homepage-button" style="width: auto; padding: 10px 12px;"><i class="fas fa-search"></i></button></a>
                    <div class="header-border"></div>
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('register') }}"><button class="register-button">Sign up</button></a>
                            <a class="nav-link" href="{{ route('login') }}"><button class="register-button">Log in</button></a>
                        @endif
                    @else
                        <button class="log-out-button nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}</button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="sign-out-button" href="{{ route('profile.show', Auth::user()) }}">{{ __('Profile') }}</a>
                            <a class="sign-out-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Sign out') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    @endguest
                </ul>
            </div>
        </nav>
    </nav>

    <div class="about-section">
        <div class="about-heading">
            <span class="about-star">&#9733;</span>
            <h2>PRIVACY POLICY</h2>
            <span class="about-star">&#9733;</span>
        </div>
        <div class="main-dashboard">
            <div class="about-container" style="flex-direction: column; max-width: 800px; margin: 0 auto;">
                <div class="about-content" style="padding: 40px;">
                    <h1>Privacy Policy</h1>
                    <p class="about-lead">Last updated: May 2026</p>

                    <div class="content-section">
                        <h3>Information We Collect</h3>
                        <p>We collect information you provide directly to us, including your name, email address, and any content you submit when contacting us or registering on our platform.</p>
                    </div>

                    <div class="content-section">
                        <h3>How We Use Your Information</h3>
                        <p>We use your information to provide and improve our services, communicate with you about updates and news, and respond to your inquiries.</p>
                    </div>

                    <div class="content-section">
                        <h3>Data Protection</h3>
                        <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, or disclosure.</p>
                    </div>

                    <div class="content-section">
                        <h3>Third-Party Services</h3>
                        <p>We do not share your personal data with third parties except as necessary to operate our services or as required by law.</p>
                    </div>

                    <div class="content-section">
                        <h3>Cookies</h3>
                        <p>Our site may use cookies to enhance your browsing experience. You can control cookie settings through your browser.</p>
                    </div>

                    <div class="content-section">
                        <h3>Contact</h3>
                        <p>If you have questions about this policy, please <a href="{{ route('contact') }}">contact us</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                <div class="footer-spinner"></div>
            </div>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
