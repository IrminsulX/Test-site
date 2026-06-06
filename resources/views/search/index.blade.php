<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | Search: {{ $query }}</title>
    <link rel="stylesheet" href="{{ asset('css/gamespage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .search-section { padding: 40px 20px 60px; max-width: 1000px; margin: 0 auto; }
        .search-heading { display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 30px; }
        .search-heading h2 { font-size: 1.8rem; font-weight: bold; color: #fff; letter-spacing: 2px; margin: 0; }
        .search-star { font-size: 1.4rem; color: #ffd700; }
        .search-result-card { background: #272930; padding: 20px 25px; margin-bottom: 15px; box-shadow: 0px 4px 8px rgba(0,0,0,0.3); }
        .search-result-card h4 { margin: 0 0 6px; }
        .search-result-card h4 a { color: #fff; text-decoration: none; }
        .search-result-card h4 a:hover { color: #db4f56; }
        .search-result-card p { color: #aaa; font-size: 0.9rem; margin: 0; }
        .search-section-label { color: #ffd700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; display: block; }
        .search-empty { text-align: center; padding: 60px 20px; color: #888; }
        .search-empty-icon { font-size: 3rem; color: #ffd700; margin-bottom: 12px; }
        .search-empty h3 { color: #fff; }
        .search-empty p { color: #aaa; }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="search-section">
        <div class="search-heading">
            <span class="search-star">&#9733;</span>
            <h2>SEARCH RESULTS</h2>
            <span class="search-star">&#9733;</span>
        </div>

        <form action="{{ route('search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="q" class="form-control" value="{{ $query }}" placeholder="Search games, news, forum..." style="background: #212121; border: 1px solid #333; color: #fff; padding: 14px 16px;">
                <button type="submit" class="btn" style="background: #db4f56; color: #fff; border: none; padding: 14px 24px;"><i class="fas fa-search"></i></button>
            </div>
        </form>

        @if($games->count())
            <span class="search-section-label">&#9733; Games</span>
            @foreach($games as $game)
                <div class="search-result-card">
                    <h4><a href="{{ route('games.show', $game) }}">{{ $game->name }}</a></h4>
                    <p>{{ Str::limit($game->description, 150) }}</p>
                </div>
            @endforeach
        @endif

        @if($posts->count())
            <span class="search-section-label">&#9733; News</span>
            @foreach($posts as $post)
                <div class="search-result-card">
                    <h4><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>
                    <p>{{ Str::limit($post->excerpt, 150) }}</p>
                </div>
            @endforeach
        @endif

        @if($threads->count())
            <span class="search-section-label">&#9733; Forum</span>
            @foreach($threads as $thread)
                <div class="search-result-card">
                    <h4><a href="{{ route('forum.show', $thread) }}">{{ $thread->title }}</a></h4>
                    <p>{{ Str::limit($thread->body, 150) }}</p>
                </div>
            @endforeach
        @endif

        @if(!$games->count() && !$posts->count() && !$threads->count())
            <div class="search-empty">
                <div class="search-empty-icon">&#128269;</div>
                <h3>No results found</h3>
                <p>Try a different search term.</p>
            </div>
        @endif
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
