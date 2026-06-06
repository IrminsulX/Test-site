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

    @include('partials.navbar')

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
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
