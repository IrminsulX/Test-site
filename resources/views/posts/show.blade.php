<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | {{ $post->title }}</title>

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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card mb-4" style="background-color: #272930; border: 1px solid #333; border-radius: 12px; overflow: hidden;">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                             alt="{{ $post->title }}"
                             class="card-img-top"
                             style="width: 100%; height: auto; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <div class="text-center mb-4">
                            <span class="featured-star" style="color: #ffd700; font-size: 1.5rem;">&#9733;</span>
                            <h2 class="d-inline mx-3" style="color: #fff;">{{ $post->title }}</h2>
                            <span class="featured-star" style="color: #ffd700; font-size: 1.5rem;">&#9733;</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4" style="color: #777;">
                            @if($post->author)
                                <small><i class="far fa-user me-1"></i>{{ $post->author->name ?? 'Unknown' }}</small>
                            @endif
                            <small><i class="far fa-calendar-alt me-1"></i>{{ $post->published_at->format('M d, Y') }}</small>
                        </div>

                        <div class="post-content" style="color: #ccc; font-size: 1.05rem; line-height: 1.8;">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                </div>

                <div class="card mb-4" style="background-color: #272930; border: 1px solid #333; border-radius: 12px; overflow: hidden;">
                    <div class="card-body">
                        <h4 style="color: #fff; margin-bottom: 20px;">
                            <span style="color: #ffd700;">&#9733;</span> Comments ({{ $post->comments->count() }})
                        </h4>

                        @forelse($post->comments as $comment)
                            <div style="padding: 15px 0; border-bottom: 1px solid #333;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                                    <strong style="color: #fff;">
                                        <a href="{{ route('profile.show', $comment->user) }}" style="color: #db4f56; text-decoration: none;">{{ $comment->user->name }}</a>
                                    </strong>
                                    <span style="color: #777; font-size: 0.8rem;">{{ $comment->created_at->diffForHumans() }}</span>
                                    @if(Auth::id() === $comment->user_id || (Auth::check() && Auth::user()->isAdmin()))
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="ms-auto" onsubmit="return confirm('Delete this comment?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" style="background: none; border: none; color: #f08a92; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                                <p style="color: #ccc; margin: 0; font-size: 0.95rem;">{{ $comment->body }}</p>
                            </div>
                        @empty
                            <p style="color: #888; text-align: center; padding: 20px;">No comments yet. Be the first!</p>
                        @endforelse

                        @auth
                            <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-4">
                                @csrf
                                <textarea name="body" rows="3" placeholder="Write a comment..." required style="width: 100%; padding: 14px 16px; background: #212121; border: 1px solid #333; color: #fff; font-size: 1rem; outline: none; resize: vertical; font-family: inherit; box-sizing: border-box; border-radius: 0;" onfocus="this.style.borderColor='#db4f56'" onblur="this.style.borderColor='#333'"></textarea>
                                @error('body')
                                    <span style="color: #f08a92; font-size: 0.8rem;">{{ $message }}</span>
                                @enderror
                                <button type="submit" class="btn mt-2" style="background-color: #212121; color: #fff; border: 1px solid #fff; border-radius: 5px; padding: 10px 24px; box-shadow: 0px 4px 0px #d67c7c; font-weight: 600;">Post Comment</button>
                            </form>
                        @else
                            <div class="mt-4 text-center" style="padding: 20px; color: #888;">
                                Please <a href="{{ route('login') }}" style="color: #db4f56;">log in</a> to comment.
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('posts.index') }}" class="btn" style="background-color: #212121; color: #fff; border: 1px solid #444; border-radius: 8px;">
                        <i class="fas fa-arrow-left me-2"></i>Back to News
                    </a>
                </div>
            </div>
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
