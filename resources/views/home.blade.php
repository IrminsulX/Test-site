<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | Home</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="/js/homepage.js"></script>
    
</head>

<body>

    @include('partials.navbar')

    <!-- Hero Gallery Section -->

    <section class="hero-gallery">
        <div class="hero-gallery-inner">
            @forelse (\App\Models\AdminHomepageImages::where('type', 'dashboard')->get() as $image)
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
            <span class="stats-number">{{ $gameCount }}+</span>
            <span class="stats-label">Games Released</span>
        </div>
        <div class="stats-divider"></div>
        <div class="stats-item">
            <span class="stats-number">{{ number_format($userCount) }}+</span>
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

    <section style="padding: 40px 20px; text-align: center; max-width: 600px; margin: 0 auto;">
        <div style="background: #272930; padding: 30px; border-radius: 8px;">
            <h3 style="color: #ffd700; margin-bottom: 10px;">&#9733; STAY UPDATED &#9733;</h3>
            <p style="color: #aaa; margin-bottom: 20px; font-size: 0.95rem;">Subscribe to our newsletter for game updates and news.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display: flex; gap: 10px; max-width: 450px; margin: 0 auto;">
                @csrf
                <input type="email" name="email" placeholder="Your email address" required style="flex: 1; padding: 12px 16px; background: #212121; color: #fff; border: 1px solid #444; border-radius: 4px;">
                <button type="submit" style="padding: 12px 24px; background: #db4f56; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Subscribe</button>
            </form>
            @if(session('success'))
                <div style="color: #4caf50; margin-top: 15px; font-size: 0.9rem;">{{ session('success') }}</div>
            @endif
        </div>
    </section>

    @include('partials.footer')
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
