<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | {{ $user->name }}</title>

    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        .profile-section {
            padding: 60px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-card {
            max-width: 600px;
            width: 100%;
            background: #272930;
            padding: 40px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .profile-heading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .profile-heading h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 2px;
            margin: 0;
        }

        .profile-star {
            font-size: 1.2rem;
            color: #ffd700;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #db4f56;
            margin-bottom: 20px;
            background: #212121;
        }

        .profile-avatar-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #212121;
            border: 3px solid #db4f56;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #555;
        }

        .profile-bio {
            color: #ccc;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 25px;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
        }

        .profile-detail {
            color: #aaa;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }

        .profile-detail a {
            color: #db4f56;
            text-decoration: none;
        }

        .profile-detail a:hover {
            text-decoration: underline;
        }

        .profile-detail strong {
            color: #fff;
        }

        .edit-profile-button {
            color: #ecf0f1;
            font-size: 16px;
            background-color: #212121;
            border: 1px solid #ffffff;
            border-radius: 5px;
            padding: 14px 35px;
            box-shadow: 0px 6px 0px #d67c7c;
            transition: all 80ms;
            cursor: pointer;
            font-weight: 600;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
        }

        .edit-profile-button:active {
            box-shadow: 0px 2px 0px #d67c7c;
            position: relative;
            top: 2px;
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

    <div class="profile-section">
        <div class="profile-card">
            <div class="profile-heading">
                <span class="profile-star">&#9733;</span>
                <h2>{{ $user->name }}</h2>
                <span class="profile-star">&#9733;</span>
            </div>

            @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="profile-avatar">
            @else
                <div class="profile-avatar-placeholder">
                    <i class="fas fa-user"></i>
                </div>
            @endif

            @if($user->bio)
                <p class="profile-bio">{{ $user->bio }}</p>
            @endif

            <div class="profile-detail"><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</div>

            @if($user->twitter)
                <div class="profile-detail">
                    <strong>Twitter:</strong>
                    <a href="https://twitter.com/{{ $user->twitter }}" target="_blank">@ {{ $user->twitter }}</a>
                </div>
            @endif

            @if($user->discord)
                <div class="profile-detail"><strong>Discord:</strong> {{ $user->discord }}</div>
            @endif

            @auth
                @if(auth()->id() === $user->id)
                    <a href="{{ route('profile.edit') }}" class="edit-profile-button">Edit Profile</a>
                @endif
            @endauth
        </div>
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
