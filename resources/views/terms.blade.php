<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | Terms of Service</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutpage.css') }}">
</head>
<body>

    @include('partials.navbar')

    <div class="about-section">
        <div class="about-heading">
            <span class="about-star">&#9733;</span>
            <h2>TERMS OF SERVICE</h2>
            <span class="about-star">&#9733;</span>
        </div>
        <div class="main-dashboard">
            <div class="about-container" style="flex-direction: column; max-width: 800px; margin: 0 auto;">
                <div class="about-content" style="padding: 30px 0;">
                    <h1>Terms of Service</h1>
                    <p class="about-lead">Last updated: May 2026</p>

                    <div class="content-section">
                        <h3>Acceptance of Terms</h3>
                        <p>By accessing or using Irminsul Studio's website and services, you agree to be bound by these Terms of Service.</p>
                    </div>

                    <div class="content-section">
                        <h3>User Accounts</h3>
                        <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account.</p>
                    </div>

                    <div class="content-section">
                        <h3>Acceptable Use</h3>
                        <p>You agree not to misuse our services, engage in harassment, post inappropriate content, or violate any applicable laws.</p>
                    </div>

                    <div class="content-section">
                        <h3>Intellectual Property</h3>
                        <p>All content, games, and materials on this site are the property of Irminsul Studio unless otherwise stated.</p>
                    </div>

                    <div class="content-section">
                        <h3>Limitation of Liability</h3>
                        <p>Irminsul Studio shall not be liable for any indirect damages arising from the use of our services.</p>
                    </div>

                    <div class="content-section">
                        <h3>Changes to Terms</h3>
                        <p>We reserve the right to modify these terms at any time. Users will be notified of material changes.</p>
                    </div>

                    <div class="content-section">
                        <h3>Contact</h3>
                        <p>For questions about these terms, please <a href="{{ route('contact') }}">contact us</a>.</p>
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
