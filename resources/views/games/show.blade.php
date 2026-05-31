<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | {{ $game->name }}</title>

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

    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="featured-star" style="color: #ffd700; font-size: 2rem;">&#9733;</span>
            <h2 class="d-inline mx-3" style="color: #fff;">{{ $game->name }}</h2>
            <span class="featured-star" style="color: #ffd700; font-size: 2rem;">&#9733;</span>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card mb-4" style="background-color: #272930; border: 1px solid #333; border-radius: 12px; overflow: hidden;">
                    <img src="{{ $game->featured_image ? asset('storage/' . $game->featured_image) : 'https://via.placeholder.com/800x400?text=No+Image' }}"
                         alt="{{ $game->name }}"
                         class="card-img-top"
                         style="width: 100%; height: auto; object-fit: cover;">

                    <div class="card-body">
                        @php
                            $statusColors = ['released' => '#28a745', 'beta' => '#fd7e14', 'coming_soon' => '#007bff'];
                            $statusColor = $statusColors[$game->status] ?? '#6c757d';
                        @endphp
                        <span class="badge mb-3" style="background-color: {{ $statusColor }}; color: #fff; font-size: 0.9rem;">
                            {{ ucfirst(str_replace('_', ' ', $game->status)) }}
                        </span>

                        <p class="card-text" style="color: #ccc; font-size: 1.1rem; line-height: 1.7;">{{ $game->description }}</p>

                        @if($game->play_url)
                            <a href="{{ $game->play_url }}" target="_blank" class="btn btn-lg w-100 mt-3" style="background-color: #db4f56; color: #fff; border: none; border-radius: 8px;">
                                <i class="fas fa-play me-2"></i>Play Now
                            </a>
                        @endif
                    </div>
                </div>

                @if($game->images && $game->images->count() > 0)
                    <div class="mb-4">
                        <h4 style="color: #fff; margin-bottom: 1rem;">
                            <span style="color: #ffd700;">&#9733;</span> Gallery
                        </h4>
                        <div class="row g-3">
                            @foreach($game->images as $image)
                                <div class="col-md-4 col-sm-6">
                                    <div style="background-color: #272930; border: 1px solid #333; border-radius: 8px; overflow: hidden; cursor: pointer;" onclick="openLightbox('{{ asset('storage/' . $image->image_path) }}')">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                             alt="{{ $image->caption ?? 'Gallery image' }}"
                                             style="width: 100%; height: 180px; object-fit: cover; display: block;">
                                        @if($image->caption)
                                            <div style="padding: 8px 12px; color: #aaa; font-size: 0.85rem;">{{ $image->caption }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="d-flex gap-3 justify-content-center mt-4">
                    @auth
                        <form action="{{ route('library.toggle', $game->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn" style="background-color: {{ $game->is_favorited ? '#db4f56' : '#212121' }}; color: #fff; border: 1px solid #444; border-radius: 8px;">
                                <i class="fas fa-{{ $game->is_favorited ? 'check' : 'plus' }} me-2"></i>{{ $game->is_favorited ? 'In Library' : 'Add to Library' }}
                            </button>
                        </form>
                    @endauth
                    <a href="{{ route('games.index') }}" class="btn" style="background-color: #212121; color: #fff; border: 1px solid #444; border-radius: 8px;">
                        <i class="fas fa-arrow-left me-2"></i>Back to Games
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; cursor: pointer; display: none; align-items: center; justify-content: center;" onclick="closeLightbox(event)">
        <img id="lightboxImage" src="" alt="Full size" style="max-width: 90%; max-height: 90%; object-fit: contain; border-radius: 4px;">
        <button style="position: absolute; top: 20px; right: 30px; font-size: 2rem; color: #fff; background: none; border: none; cursor: pointer;" onclick="closeLightbox()">&times;</button>
    </div>

    <script>
        function openLightbox(src) {
            const modal = document.getElementById('lightboxModal');
            document.getElementById('lightboxImage').src = src;
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeLightbox(e) {
            if (e && e.target !== document.getElementById('lightboxImage')) {
                document.getElementById('lightboxModal').style.display = 'none';
                document.body.style.overflow = '';
            }
        }
    </script>

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
