<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | New Thread</title>

    <link rel="stylesheet" href="{{ asset('css/gamespage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        .forum-create-section {
            padding: 60px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .forum-create-card {
            max-width: 700px;
            width: 100%;
            background: #272930;
            padding: 40px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
        }

        .forum-create-heading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .forum-create-heading h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 2px;
            margin: 0;
        }

        .forum-create-star {
            font-size: 1.2rem;
            color: #ffd700;
        }

        .forum-create-form-group {
            margin-bottom: 22px;
        }

        .forum-create-form-group label {
            display: block;
            color: #ccc;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .forum-create-form-group input,
        .forum-create-form-group textarea,
        .forum-create-form-group select {
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
            border-radius: 0;
        }

        .forum-create-form-group input:focus,
        .forum-create-form-group textarea:focus,
        .forum-create-form-group select:focus {
            border-color: #db4f56;
        }

        .forum-create-form-group input::placeholder,
        .forum-create-form-group textarea::placeholder {
            color: #555;
        }

        .forum-create-form-group textarea {
            resize: vertical;
            min-height: 200px;
        }

        .forum-create-form-group select {
            cursor: pointer;
            appearance: auto;
        }

        .forum-create-form-group select option {
            background: #212121;
            color: #fff;
        }

        .forum-create-submit {
            width: 100%;
            padding: 14px;
            background-color: #212121;
            border: 1px solid #fff;
            border-radius: 5px;
            color: #ecf0f1;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            box-shadow: 0px 6px 0px #d67c7c;
            transition: all 80ms;
            font-family: inherit;
        }

        .forum-create-submit:active {
            box-shadow: 0px 2px 0px #d67c7c;
            position: relative;
            top: 2px;
        }

        .forum-create-back {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #db4f56;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forum-create-back:hover {
            color: #ff6b72;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    @include('partials.navbar')

    <div class="forum-create-section">
        <div class="forum-create-card">
            <div class="forum-create-heading">
                <span class="forum-create-star">&#9733;</span>
                <h2>NEW THREAD</h2>
                <span class="forum-create-star">&#9733;</span>
            </div>

            <form method="POST" action="{{ route('forum.store') }}">
                @csrf

                <div class="forum-create-form-group">
                    <label for="title">Title</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" placeholder="Thread title" required>
                    @error('title')
                        <span style="color: #f08a92; font-size: 0.8rem; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="forum-create-form-group">
                    <label for="game_id">Game <span style="color: #666; text-transform: none; letter-spacing: 0;">(optional)</span></label>
                    <select id="game_id" name="game_id">
                        <option value="">-- Select a Game --</option>
                        @foreach($games as $game)
                            <option value="{{ $game->id }}" {{ old('game_id') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                        @endforeach
                    </select>
                    @error('game_id')
                        <span style="color: #f08a92; font-size: 0.8rem; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="forum-create-form-group">
                    <label for="category">Category <span style="color: #666; text-transform: none; letter-spacing: 0;">(optional)</span></label>
                    <select id="category" name="category">
                        <option value="">-- Select a Category --</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span style="color: #f08a92; font-size: 0.8rem; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="forum-create-form-group">
                    <label for="body">Body</label>
                    <textarea id="body" name="body" placeholder="Write your thread content..." required>{{ old('body') }}</textarea>
                    @error('body')
                        <span style="color: #f08a92; font-size: 0.8rem; margin-top: 6px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="forum-create-submit">Create Thread</button>
            </form>

            <a href="{{ route('forum.index') }}" class="forum-create-back">&#8592; Back to Forum</a>
        </div>
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
