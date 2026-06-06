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

    @include('partials.navbar')

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

            <div class="profile-detail"><strong>Role:</strong> {{ ucfirst($user->role) }}</div>

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

        @if($user->favoritedGames->count() > 0)
        <div class="profile-card" style="margin-top: 30px;">
            <div class="profile-heading">
                <span class="profile-star">&#9733;</span>
                <h2>GAME LIBRARY</h2>
                <span class="profile-star">&#9733;</span>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; margin-top: 20px;">
                @foreach($user->favoritedGames as $favGame)
                    <a href="{{ route('games.show', $favGame->id) }}" style="text-decoration: none; text-align: center;">
                        <div style="background: #212121; border-radius: 8px; padding: 15px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                            @if($favGame->featured_image)
                                <img src="{{ asset('storage/' . $favGame->featured_image) }}" alt="{{ $favGame->name }}" style="width: 100%; height: 100px; object-fit: cover; border-radius: 4px;">
                            @else
                                <div style="width: 100%; height: 100px; background: #272930; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #555;">
                                    <i class="fas fa-gamepad fa-2x"></i>
                                </div>
                            @endif
                            <div style="color: #fff; margin-top: 8px; font-size: 0.85rem;">{{ $favGame->name }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
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
