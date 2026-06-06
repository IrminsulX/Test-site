<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | Categories</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminhomepage.css') }}">
</head>
<body>

    @include('partials.navbar')

    <div class="admin-heading-section">
        <div class="admin-heading">
            <span class="admin-star">&#9733;</span>
            <h2>ADMIN DASHBOARD</h2>
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
        <a href="{{ route('adminhomepages') }}"><button class="admin-nav-btn"><i class="fas fa-tachometer-alt"></i> Homepage</button></a>
    </div>

    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>Categories</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card" style="padding: 30px; margin-bottom: 30px;">
            <h5 style="color: #fff; margin-bottom: 20px;"><i class="fas fa-plus-circle"></i> Add New Category</h5>
            <form action="{{ route('admin.categories.store') }}" method="POST" style="display: flex; gap: 15px; align-items: flex-end;">
                @csrf
                <div style="flex: 1;">
                    <label for="name" style="color: #aaa; display: block; margin-bottom: 5px;">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required style="background: #212121; border: 1px solid #444; color: #fff;">
                </div>
                <button type="submit" class="btn btn-danger" style="padding: 10px 25px;"><i class="fas fa-plus"></i> Add Category</button>
            </form>
        </div>

        <div class="admin-card" style="padding: 30px;">
            <div class="table-responsive">
                <table class="table table-dark table-hover" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #444;">Name</th>
                            <th style="border-bottom: 1px solid #444;">Post Count</th>
                            <th style="border-bottom: 1px solid #444; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td style="vertical-align: middle;">{{ $category->name }}</td>
                            <td style="vertical-align: middle;">{{ $category->posts_count ?? $category->posts->count() }}</td>
                            <td style="text-align: right; vertical-align: middle;">
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: #aaa; padding: 30px;">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
                <div class="footer-spinner"></div>
            </div>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
