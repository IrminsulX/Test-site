<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Irminsul Studio | Manage Posts</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminhomepage.css') }}">

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

                    @auth
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
                    @endauth

                </ul>
            </div>

        </nav>
    </nav>

    <div class="admin-heading-section">
        <div class="admin-heading">
            <span class="admin-star">&#9733;</span>
            <h2>MANAGE POSTS</h2>
            <span class="admin-star">&#9733;</span>
        </div>
    </div>

    <div class="admin-nav-row">
        <a href="{{ route('admin.games.index') }}"><button class="admin-nav-btn"><i class="fas fa-gamepad"></i> Games</button></a>
        <a href="{{ route('admin.posts.index') }}"><button class="admin-nav-btn"><i class="fas fa-newspaper"></i> News</button></a>
        <a href="{{ route('admin.team.index') }}"><button class="admin-nav-btn"><i class="fas fa-users"></i> Team</button></a>
        <a href="{{ route('admin.messages.index') }}"><button class="admin-nav-btn"><i class="fas fa-envelope"></i> Messages</button></a>
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
            <h3>Blog Posts</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.posts.create') }}">
                <button class="admin-upload-btn"><i class="fas fa-plus"></i> Create Post</button>
            </a>
        </div>

        <div class="admin-card">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->author->name ?? 'Unknown' }}</td>
                            <td>
                                @if($post->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>{{ $post->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="admin-actions">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}">
                                        <button class="admin-btn admin-btn-edit"><i class="fas fa-edit"></i> Edit</button>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn-delete"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No posts yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="admin-pagination">
            {{ $posts->links() }}
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

                            <div class="spinner-box">
                                <div class="configure-border-1">
                                    <div class="configure-core"></div>
                                </div>
                                <div class="configure-border-2">
                                    <div class="configure-core"></div>
                                </div>
                            </div>

                            <div class="copyright">
                                &copy; 2025 Irminsul Studio ツ
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
