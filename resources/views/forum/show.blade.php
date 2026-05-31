<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | {{ $thread->title }}</title>

    <link rel="stylesheet" href="{{ asset('css/gamespage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        .forum-thread-section {
            padding: 40px 20px 60px;
            max-width: 900px;
            margin: 0 auto;
        }

        .forum-back-link {
            display: inline-block;
            color: #db4f56;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 20px;
            transition: color 0.2s;
        }

        .forum-back-link:hover {
            color: #ff6b72;
            text-decoration: underline;
        }

        .forum-thread-card {
            background: #272930;
            padding: 35px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
            margin-bottom: 30px;
        }

        .forum-thread-title {
            font-size: 1.6rem;
            font-weight: bold;
            color: #fff;
            margin: 0 0 10px;
        }

        .forum-thread-meta {
            color: #888;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .forum-thread-meta a {
            color: #db4f56;
            text-decoration: none;
        }

        .forum-thread-meta a:hover {
            text-decoration: underline;
        }

        .forum-thread-body {
            color: #ccc;
            font-size: 1rem;
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .forum-divider {
            height: 1px;
            background: #333;
            margin: 30px 0;
        }

        .forum-replies-heading {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .forum-reply {
            background: #272930;
            padding: 25px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        .forum-reply-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }

        .forum-reply-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            background: #212121;
            border: 2px solid #db4f56;
        }

        .forum-reply-avatar-placeholder {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #212121;
            border: 2px solid #db4f56;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #555;
        }

        .forum-reply-author {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }

        .forum-reply-author:hover {
            color: #db4f56;
        }

        .forum-reply-date {
            color: #888;
            font-size: 0.8rem;
            margin-left: auto;
        }

        .forum-reply-body {
            color: #ccc;
            font-size: 0.95rem;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .forum-reply-form {
            background: #272930;
            padding: 30px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
            margin-top: 30px;
        }

        .forum-reply-form h4 {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 20px;
            letter-spacing: 1px;
        }

        .forum-reply-form textarea {
            width: 100%;
            padding: 14px 16px;
            background: #212121;
            border: 1px solid #333;
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
            font-family: inherit;
            resize: vertical;
            min-height: 130px;
            border-radius: 0;
        }

        .forum-reply-form textarea:focus {
            border-color: #db4f56;
        }

        .forum-reply-form textarea::placeholder {
            color: #555;
        }

        .forum-reply-submit {
            color: #ecf0f1;
            font-size: 16px;
            background-color: #212121;
            border: 1px solid #ffffff;
            border-radius: 5px;
            padding: 12px 30px;
            box-shadow: 0px 6px 0px #d67c7c;
            transition: all 80ms;
            cursor: pointer;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-top: 16px;
            font-family: inherit;
        }

        .forum-reply-submit:active {
            box-shadow: 0px 2px 0px #d67c7c;
            position: relative;
            top: 2px;
        }

        .forum-login-prompt {
            background: #272930;
            padding: 30px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
            margin-top: 30px;
            text-align: center;
            color: #aaa;
            font-size: 1rem;
        }

        .forum-login-prompt a {
            color: #db4f56;
            text-decoration: none;
            font-weight: 600;
        }

        .forum-login-prompt a:hover {
            text-decoration: underline;
        }
    </style>
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

    <div class="forum-thread-section">
        <a href="{{ route('forum.index') }}" class="forum-back-link">&#8592; Back to Forum</a>

        <div class="forum-thread-card">
            <h1 class="forum-thread-title">{{ $thread->title }}</h1>
            <div class="forum-thread-meta">
                Posted by <a href="{{ route('profile.show', $thread->user) }}">{{ $thread->user->name }}</a>
                &middot; {{ $thread->created_at->format('F j, Y') }}
                @if($thread->category)
                    &middot; <span style="background: #212121; border: 1px solid #444; border-radius: 3px; padding: 2px 8px; font-size: 0.8rem;">{{ ucfirst(str_replace('-', ' ', $thread->category)) }}</span>
                @endif
            </div>
            <div class="forum-thread-body">{{ $thread->body }}</div>
        </div>

        <div class="forum-divider"></div>

        <div class="forum-replies-heading">Replies ({{ $thread->replies->count() }})</div>

        @forelse($thread->replies as $reply)
            <div class="forum-reply">
                <div class="forum-reply-header">
                    @if($reply->user->avatar)
                        <img src="{{ asset('storage/' . $reply->user->avatar) }}" alt="{{ $reply->user->name }}" class="forum-reply-avatar">
                    @else
                        <div class="forum-reply-avatar-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                    <a href="{{ route('profile.show', $reply->user) }}" class="forum-reply-author">{{ $reply->user->name }}</a>
                    <span class="forum-reply-date">{{ $reply->created_at->format('F j, Y') }}</span>
                </div>
                <div class="forum-reply-body">{{ $reply->body }}</div>
            </div>
        @empty
            <p style="color: #888; text-align: center; padding: 20px;">No replies yet. Be the first to respond!</p>
        @endforelse

        @auth
            <div class="forum-reply-form">
                <h4>Leave a Reply</h4>
                <form method="POST" action="{{ route('forum.reply', $thread) }}">
                    @csrf
                    <textarea name="body" placeholder="Write your reply..." required></textarea>
                    <br>
                    <button type="submit" class="forum-reply-submit">Post Reply</button>
                </form>
            </div>
        @else
            <div class="forum-login-prompt">
                Please <a href="{{ route('login') }}">log in</a> to reply.
            </div>
        @endauth
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

    <script src="{{ asset('js/homepage.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
