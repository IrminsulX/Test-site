<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | Administrator</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/adminhomepage.css">
    <script src="/js/homepage.js"></script>
    
</head>
<body>

    <!-- Header section -->
    <nav class="header">
        <nav class="navbar navbar-expand-lg">

            <a class="navbar d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/StudioLogo.png') }}" alt="Studio Logo" class="logo-icon">
                <button class="studio-button">Irminsul Studio ツ</button>
            </a>

            <!-- Hamburger Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavHeader" aria-controls="navbarNavHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavHeader">
                <ul class="navbar-nav ms-auto">

                    <a class="nav-link" href="{{ route('home') }}">
                        <button class="homepage-button">Home</button>
                    </a>

                    <a class="nav-link" href="{{ route('gamespage') }}">
                        <button class="homepage-button">Games</button>
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
                            <button class="sign-out-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Sign out') }}
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endauth

                </ul>
            </div>
            
        </nav>
    </nav>

    <!-- Admin Heading -->
    <div class="admin-heading-section">
        <div class="admin-heading">
            <span class="admin-star">&#9733;</span>
            <h2>ADMIN DASHBOARD</h2>
            <span class="admin-star">&#9733;</span>
        </div>
    </div>

    <!-- Dashboard Images Section -->
    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>Dashboard Images</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card">
            <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data" class="admin-upload-form">
                @csrf
                <input type="hidden" name="type" value="dashboard">

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="gameNameDashboard">Game Name</label>
                        <input type="text" name="gameName" id="gameNameDashboard" placeholder="Enter game name" required>
                    </div>

                    <div class="admin-form-group">
                        <label for="fileUploadDashboard">Image</label>
                        <div class="admin-file-wrap">
                            <input type="file" name="fileUpload" id="fileUploadDashboard" accept=".png, .jpg, .gif, .bmp, .webp" required onchange="this.nextElementSibling.textContent = this.files[0].name">
                            <span class="admin-file-name">No file chosen</span>
                        </div>
                    </div>

                    <button type="submit" class="admin-upload-btn">
                        <i class="fas fa-cloud-upload-alt"></i> Upload
                    </button>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="admin-alert admin-alert-error">{{ session('error') }}</div>
        @endif

        <div class="admin-grid">
            @php $dashboardImages = \App\Models\AdminHomepageImages::where('type', 'dashboard')->paginate(10); @endphp
            @forelse ($dashboardImages as $image)
                <div class="admin-card admin-image-card">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->game_name }}">
                    <p class="admin-image-title">{{ $image->game_name }}</p>

                    <form action="{{ url('/edit/' . $image->id) }}" method="POST" enctype="multipart/form-data" class="admin-inline-form">
                        @csrf
                        <input type="text" name="gameName" value="{{ $image->game_name }}" required>
                        <div class="admin-file-wrap admin-file-small">
                            <input type="file" name="fileUpload" id="editDashboard{{ $image->id }}" accept=".png, .jpg, .gif, .bmp, .webp" onchange="this.nextElementSibling.textContent = this.files[0].name">
                            <span class="admin-file-name">Change image</span>
                        </div>
                        <button type="submit" class="admin-btn admin-btn-edit"><i class="fas fa-edit"></i> Edit</button>
                    </form>

                    <form action="{{ url('/delete/' . $image->id) }}" method="POST" class="admin-inline-form" onsubmit="return confirm('Delete this image?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-btn admin-btn-delete"><i class="fas fa-trash"></i> Remove</button>
                    </form>
                </div>
            @empty
                <div class="admin-empty">No dashboard images yet. Upload one above.</div>
            @endforelse
        </div>

        <div class="admin-pagination">
            {{ $dashboardImages->links() }}
        </div>
    </div>

    <!-- Featured Games Section -->
    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>Featured Games</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card">
            <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data" class="admin-upload-form">
                @csrf
                <input type="hidden" name="type" value="featured">

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="gameNameFeatured">Game Name</label>
                        <input type="text" name="gameName" id="gameNameFeatured" placeholder="Enter game name" required>
                    </div>

                    <div class="admin-form-group">
                        <label for="fileUploadFeatured">Image</label>
                        <div class="admin-file-wrap">
                            <input type="file" name="fileUpload" id="fileUploadFeatured" accept=".png, .jpg, .gif, .bmp, .webp" required onchange="this.nextElementSibling.textContent = this.files[0].name">
                            <span class="admin-file-name">No file chosen</span>
                        </div>
                    </div>

                    <button type="submit" class="admin-upload-btn">
                        <i class="fas fa-cloud-upload-alt"></i> Upload
                    </button>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="admin-alert admin-alert-error">{{ session('error') }}</div>
        @endif

        <div class="admin-grid">
            @php $featuredImages = \App\Models\AdminHomepageImages::where('type', 'featured')->paginate(10); @endphp
            @forelse ($featuredImages as $image)
                <div class="admin-card admin-image-card">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->game_name }}">
                    <p class="admin-image-title">{{ $image->game_name }}</p>

                    <form action="{{ url('/edit/' . $image->id) }}" method="POST" enctype="multipart/form-data" class="admin-inline-form">
                        @csrf
                        <input type="text" name="gameName" value="{{ $image->game_name }}" required>
                        <div class="admin-file-wrap admin-file-small">
                            <input type="file" name="fileUpload" id="editFeatured{{ $image->id }}" accept=".png, .jpg, .gif, .bmp, .webp" onchange="this.nextElementSibling.textContent = this.files[0].name">
                            <span class="admin-file-name">Change image</span>
                        </div>
                        <button type="submit" class="admin-btn admin-btn-edit"><i class="fas fa-edit"></i> Edit</button>
                    </form>

                    <form action="{{ url('/delete/' . $image->id) }}" method="POST" class="admin-inline-form" onsubmit="return confirm('Delete this image?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-btn admin-btn-delete"><i class="fas fa-trash"></i> Remove</button>
                    </form>
                </div>
            @empty
                <div class="admin-empty">No featured games yet. Upload one above.</div>
            @endforelse
        </div>

        <div class="admin-pagination">
            {{ $featuredImages->links() }}
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
