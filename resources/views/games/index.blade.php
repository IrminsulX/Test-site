<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | Our Games</title>

    <link rel="stylesheet" href="{{ asset('css/gamespage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    
</head>

<body>

    @include('partials.navbar')

    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="featured-star" style="color: #ffd700; font-size: 2rem;">&#9733;</span>
            <h2 class="d-inline mx-3" style="color: #fff; font-weight: bold;">OUR GAMES</h2>
            <span class="featured-star" style="color: #ffd700; font-size: 2rem;">&#9733;</span>
        </div>

        <div class="row g-4">
            @forelse($games as $game)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="background-color: #272930; border: 1px solid #333; border-radius: 12px; overflow: hidden;">
                        <img src="{{ $game->featured_image ? asset('storage/' . $game->featured_image) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                             alt="{{ $game->name }}"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0" style="color: #fff;">{{ $game->name }}</h5>
                                @php
                                    $statusColors = ['released' => '#28a745', 'beta' => '#fd7e14', 'coming_soon' => '#007bff'];
                                    $statusColor = $statusColors[$game->status] ?? '#6c757d';
                                @endphp
                                <span class="badge" style="background-color: {{ $statusColor }}; color: #fff;">
                                    {{ ucfirst(str_replace('_', ' ', $game->status)) }}
                                </span>
                            </div>

                            <p class="card-text flex-grow-1" style="color: #aaa;">
                                {{ Str::limit($game->description, 120) }}
                            </p>

                            <a href="{{ route('games.show', $game) }}" class="btn w-100" style="background-color: #212121; color: #fff; border: 1px solid #444; border-radius: 8px;">
                                View Game
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div style="font-size: 3rem; color: #ffd700;">&#9733;</div>
                    <p style="color: #aaa; font-size: 1.2rem; margin-top: 1rem;">No games available yet</p>
                    <span style="color: #777;">Check back soon for exciting new releases!</span>
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
    
<script src="/js/homepage.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
