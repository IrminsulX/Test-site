<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Irminsul Studio | Edit Game</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminhomepage.css') }}">

</head>
<body>

    @include('partials.navbar')

    <div class="admin-heading-section">
        <div class="admin-heading">
            <span class="admin-star">&#9733;</span>
            <h2>EDIT GAME</h2>
            <span class="admin-star">&#9733;</span>
        </div>
    </div>

    <div class="admin-nav-row">
        <a href="{{ route('admin.games.index') }}"><button class="admin-nav-btn"><i class="fas fa-gamepad"></i> Games</button></a>
        <a href="{{ route('admin.posts.index') }}"><button class="admin-nav-btn"><i class="fas fa-newspaper"></i> News</button></a>
        <a href="{{ route('admin.team.index') }}"><button class="admin-nav-btn"><i class="fas fa-users"></i> Team</button></a>
        <a href="{{ route('admin.users') }}"><button class="admin-nav-btn"><i class="fas fa-user-cog"></i> Users</button></a>
        <a href="{{ route('admin.messages.index') }}"><button class="admin-nav-btn"><i class="fas fa-envelope"></i> Messages</button></a>
        <a href="{{ route('admin.newsletter.index') }}"><button class="admin-nav-btn"><i class="fas fa-mail-bulk"></i> Newsletter</button></a>
        <a href="{{ route('admin.logs') }}"><button class="admin-nav-btn"><i class="fas fa-history"></i> Activity</button></a>
        <a href="{{ route('adminhomepages') }}"><button class="admin-nav-btn"><i class="fas fa-tachometer-alt"></i> Dashboard</button></a>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="admin-alert admin-alert-error">{{ session('error') }}</div>
    @endif

    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>{{ $game->name }}</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card">
            <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="admin-upload-form">
                @csrf
                @method('PUT')

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" required>
                    </div>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="6" required>{{ old('description', $game->description) }}</textarea>
                    </div>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="play_url">Play URL</label>
                        <input type="url" name="play_url" id="play_url" value="{{ old('play_url', $game->play_url) }}" placeholder="https://...">
                    </div>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="released" {{ old('status', $game->status) === 'released' ? 'selected' : '' }}>Released</option>
                            <option value="beta" {{ old('status', $game->status) === 'beta' ? 'selected' : '' }}>Beta</option>
                            <option value="coming_soon" {{ old('status', $game->status) === 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                        </select>
                    </div>
                </div>

                @if($game->featured_image)
                    <div class="admin-form-row">
                        <div class="admin-form-group">
                            <label>Current Featured Image</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $game->featured_image) }}" alt="Featured" style="max-width: 200px;" class="img-thumbnail">
                                <p class="mt-1 text-muted">{{ $game->featured_image }}</p>
                            </div>
                            <label class="text-warning">
                                <input type="checkbox" name="delete_featured_image" value="1"> Delete featured image
                            </label>
                        </div>
                    </div>
                @endif

                <div class="admin-form-row">
                    <div class="admin-form-group">
                            <label for="featured_image">New Featured Image</label>
                            <div class="admin-file-wrap">
                                <input type="file" name="featured_image" id="featured_image" accept=".png, .jpg, .gif, .bmp, .webp" onchange="this.nextElementSibling.textContent = this.files[0].name">
                                <span class="admin-file-name">No file chosen</span>
                            </div>
                            @error('featured_image') <div style="color: #db4f56; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label class="d-block">Published</label>
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $game->is_published) ? 'checked' : '' }}>
                        <label for="is_published" class="ms-2">Published</label>
                    </div>
                </div>

                <button type="submit" class="admin-upload-btn"><i class="fas fa-save"></i> Update Game</button>
            </form>
        </div>

        <a href="{{ route('admin.games.index') }}">
            <button class="admin-btn admin-btn-edit mt-3"><i class="fas fa-arrow-left"></i> Back to Games</button>
        </a>
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
                <div class="footer-spinner"></div>
            </div>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
