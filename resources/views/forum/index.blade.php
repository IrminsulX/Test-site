<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | Forum</title>

    <link rel="stylesheet" href="{{ asset('css/gamespage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        .forum-section {
            padding: 40px 20px 60px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .forum-heading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .forum-heading h2 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 2px;
            margin: 0;
        }

        .forum-star {
            font-size: 1.4rem;
            color: #ffd700;
        }

        .forum-toolbar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 25px;
        }

        .new-thread-button {
            color: #ecf0f1;
            font-size: 15px;
            background-color: #212121;
            border: 1px solid #ffffff;
            border-radius: 5px;
            padding: 12px 24px;
            box-shadow: 0px 6px 0px #d67c7c;
            transition: all 80ms;
            cursor: pointer;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-decoration: none;
            display: inline-block;
        }

        .new-thread-button:active {
            box-shadow: 0px 2px 0px #d67c7c;
            position: relative;
            top: 2px;
        }

        .forum-table {
            width: 100%;
            background: #272930;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
        }

        .forum-table th {
            background: #212121;
            color: #ccc;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        .forum-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #2a2b33;
            color: #ccc;
            font-size: 0.95rem;
            vertical-align: middle;
        }

        .forum-table tr:hover td {
            background: rgba(255, 255, 255, 0.03);
        }

        .forum-thread-title {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            font-size: 1.05rem;
        }

        .forum-thread-title:hover {
            color: #db4f56;
        }

        .forum-pin-icon {
            color: #ffd700;
            margin-right: 8px;
            font-size: 0.9rem;
        }

        .forum-meta {
            color: #888;
            font-size: 0.85rem;
        }

        .forum-meta a {
            color: #db4f56;
            text-decoration: none;
        }

        .forum-meta a:hover {
            text-decoration: underline;
        }

        .forum-empty {
            text-align: center;
            padding: 80px 20px;
            color: #888;
            background: #272930;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
        }

        .forum-empty-icon {
            font-size: 3rem;
            color: #ffd700;
            margin-bottom: 16px;
        }

        .forum-empty h3 {
            color: #fff;
            font-size: 1.4rem;
            margin-bottom: 8px;
        }

        .forum-empty p {
            color: #aaa;
            font-size: 1rem;
        }

        .forum-pagination {
            margin-top: 25px;
            display: flex;
            justify-content: center;
        }

        .forum-pagination nav .pagination {
            display: flex;
            gap: 5px;
            list-style: none;
            padding: 0;
        }

        .forum-pagination nav .pagination .page-item .page-link {
            background: #212121;
            border: 1px solid #333;
            color: #ccc;
            padding: 10px 16px;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
        }

        .forum-pagination nav .pagination .page-item .page-link:hover {
            background: #2a2a2a;
            border-color: #db4f56;
            color: #fff;
        }

        .forum-pagination nav .pagination .page-item.active .page-link {
            background: #db4f56;
            border-color: #db4f56;
            color: #fff;
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

    <div class="forum-section">
        <div class="forum-heading">
            <span class="forum-star">&#9733;</span>
            <h2>FORUM</h2>
            <span class="forum-star">&#9733;</span>
        </div>

        @auth
            <div class="forum-toolbar" style="justify-content: space-between; align-items: center; gap: 10px;">
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <a href="{{ route('forum.index') }}" class="btn" style="background: {{ !$category ? '#db4f56' : '#212121' }}; color: #fff; border: 1px solid #444; border-radius: 5px; padding: 8px 16px; font-size: 0.85rem; text-decoration: none;">All</a>
                    @foreach($categories as $key => $label)
                        <a href="{{ route('forum.index', ['category' => $key]) }}" class="btn" style="background: {{ $category === $key ? '#db4f56' : '#212121' }}; color: #fff; border: 1px solid #444; border-radius: 5px; padding: 8px 16px; font-size: 0.85rem; text-decoration: none;">{{ $label }}</a>
                    @endforeach
                </div>
                <a href="{{ route('forum.create') }}" class="new-thread-button">+ New Thread</a>
            </div>
        @else
            <div class="forum-toolbar" style="justify-content: center; gap: 8px; flex-wrap: wrap;">
                <a href="{{ route('forum.index') }}" class="btn" style="background: {{ !$category ? '#db4f56' : '#212121' }}; color: #fff; border: 1px solid #444; border-radius: 5px; padding: 8px 16px; font-size: 0.85rem; text-decoration: none;">All</a>
                @foreach($categories as $key => $label)
                    <a href="{{ route('forum.index', ['category' => $key]) }}" class="btn" style="background: {{ $category === $key ? '#db4f56' : '#212121' }}; color: #fff; border: 1px solid #444; border-radius: 5px; padding: 8px 16px; font-size: 0.85rem; text-decoration: none;">{{ $label }}</a>
                @endforeach
            </div>
        @endauth

        @forelse($threads as $thread)
            <table class="forum-table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Thread</th>
                        <th style="width: 12%;">Category</th>
                        <th style="width: 13%;">Author</th>
                        <th style="width: 10%;">Replies</th>
                        <th style="width: 25%;">Latest Reply</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if($thread->is_pinned)
                                <span class="forum-pin-icon">&#9733;</span>
                            @endif
                            <a href="{{ route('forum.show', $thread) }}" class="forum-thread-title">{{ $thread->title }}</a>
                        </td>
                        <td class="forum-meta">
                            @if($thread->category)
                                <span style="background: #212121; border: 1px solid #444; border-radius: 3px; padding: 3px 10px; font-size: 0.8rem;">{{ ucfirst(str_replace('-', ' ', $thread->category)) }}</span>
                            @else
                                <span style="color: #555;">-</span>
                            @endif
                        </td>
                        <td class="forum-meta">
                            <a href="{{ route('profile.show', $thread->user) }}">{{ $thread->user->name }}</a>
                        </td>
                        <td class="forum-meta">{{ $thread->replies_count ?? $thread->replies->count() }}</td>
                        <td class="forum-meta">
                            @if($thread->latestReply)
                                by <a href="{{ route('profile.show', $thread->latestReply->user) }}">{{ $thread->latestReply->user->name }}</a>
                                <br>{{ $thread->latestReply->created_at->diffForHumans() }}
                            @else
                                No replies yet
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @empty
            <div class="forum-empty">
                <div class="forum-empty-icon">&#9993;</div>
                <h3>No threads yet</h3>
                <p>Be the first to start a discussion!</p>
            </div>
        @endforelse

        @if($threads->hasPages())
            <div class="forum-pagination">
                {{ $threads->links() }}
            </div>
        @endif
    </div>

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
                                <a href="{{ route('privacy') }}" style="color: #888; text-decoration: none; margin-right: 15px; font-size: 0.8rem;">Privacy</a>
                                <a href="{{ route('terms') }}" style="color: #888; text-decoration: none; margin-right: 15px; font-size: 0.8rem;">Terms</a>
                                <a href="{{ route('press-kit') }}" style="color: #888; text-decoration: none; margin-right: 15px; font-size: 0.8rem;">Press Kit</a>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </nav>
    </nav>

    <script src="{{ asset('js/homepage.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
