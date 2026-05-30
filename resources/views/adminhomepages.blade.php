<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <title>Irminsul Studio | Administrator Home</title>

    <link rel="stylesheet" href="css/adminhomepage.css">
    <script src="/js/homepage.js"></script>
    
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

            <!-- Left Side Content (Empty for now) -->
            <ul class="navbar-nav">
                <!-- Left Side Content -->
            </ul>

            <!-- Right Side Of Navbar -->
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
                        <button class="sign-out-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Sign out') }}
                        </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest

            </ul>
            
        </nav>
    </nav>

    <!-- Dashboard Image Changer Section -->
<div class="container">
    <h2>Dashboard Images</h2>

    <!-- Upload Form -->
    <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data" class="upload-form">
        @csrf
        <div class="input-group">
            <label for="gameNameDashboard">Game Name:</label>
            <input type="text" name="gameName" id="gameNameDashboard" required placeholder="Enter game name">
        </div>

        <input type="hidden" name="type" value="dashboard">

        <div class="input-group">
            <label for="fileUploadDashboard" class="custom-file-upload">
                <i class="fas fa-upload"></i> Choose Image
            </label>
            <input type="file" name="fileUpload" id="fileUploadDashboard" accept=".png, .jpg, .gif, .bmp, .webp" required>
        </div>

        <button type="submit" class="btn upload-btn">
            <i class="fas fa-cloud-upload-alt"></i> Upload
        </button>
    </form>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Display Images -->
    <div class="image-grid">
        @foreach (\App\Models\AdminHomepageImages::where('type', 'dashboard')->paginate(10) as $image)
            <div class="image-card">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->game_name }}" class="image-preview">
                <p class="game-title">{{ $image->game_name }}</p>

                <!-- Edit Form -->
                <form action="{{ url('/edit/' . $image->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
                    @csrf
                    <input type="text" name="gameName" value="{{ $image->game_name }}" required>
                    <input type="file" name="fileUpload" accept=".png, .jpg, .gif, .bmp, .webp">
                    <button type="submit" class="btn edit-btn">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>

                <!-- Delete Form -->
                <form action="{{ url('/delete/' . $image->id) }}" method="POST" class="delete-form" onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn remove-btn">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </form>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ \App\Models\AdminHomepageImages::where('type', 'dashboard')->paginate(10)->links() }}
    </div>
</div>

<!-- Loading Spinner -->
<div id="loadingSpinner" class="spinner">
    <div class="spinner-icon"></div>
</div>




    <!-- Games Indicator  -->

    <div class="games-dashboard">
        <h2>
            <a href="https://www.roblox.com" target="_blank">
            <img src="{{ asset('images/HD New Roblox Logo Icon PNG - 800x800.png') }}" alt="Roblox Logo" class="game-icon">
            </a>
            Games Available
        </h2>
    </div>

   <!-- Featured Games Section -->
<div class="container games-dashboard-background">
    <h2>Featured Games</h2>

    <!-- Upload Form -->
    <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data" class="upload-form">
        @csrf
        <div class="input-group">
            <label for="gameNameFeatured">Game Name:</label>
            <input type="text" name="gameName" id="gameNameFeatured" required placeholder="Enter game name">
        </div>

        <input type="hidden" name="type" value="featured">

        <div class="input-group">
            <label for="fileUploadFeatured" class="custom-file-upload">
                <i class="fas fa-upload"></i> Choose Image
            </label>
            <input type="file" name="fileUpload" id="fileUploadFeatured" accept=".png, .jpg, .gif, .bmp, .webp" required>
        </div>

        <button type="submit" class="btn upload-btn">
            <i class="fas fa-cloud-upload-alt"></i> Upload
        </button>
    </form>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Image Management Grid -->
    <div class="image-grid">
    @forelse (\App\Models\AdminHomepageImages::where('type', 'featured')->paginate(10) as $image)
        <div class="image-card">
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->game_name }}" class="image-preview">
            <p class="game-title">{{ $image->game_name }}</p>

            <!-- Edit Form -->
            <form action="{{ url('/edit/' . $image->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
                @csrf
                <input type="text" name="gameName" value="{{ $image->game_name }}" required>
                <input type="file" name="fileUpload" accept=".png, .jpg, .gif, .bmp, .webp">
                <button type="submit" class="btn edit-btn">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </form>

            <!-- Delete Form -->
            <form action="{{ url('/delete/' . $image->id) }}" method="POST" class="delete-form" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn remove-btn">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </form>
        </div>
    @empty
        <p>No images available</p>
    @endforelse
</div>

    <!-- Pagination -->
    <div class="pagination">
        {{ \App\Models\AdminHomepageImages::where('type', 'featured')->paginate(10)->links() }}
    </div>
</div>

<!-- Loading Spinner -->
<div id="loadingSpinner" class="spinner">
    <div class="spinner-icon"></div>
</div>
















    <!-- Footer's section -->

    <nav class="footer">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                
                <!-- Left Side Of Navbar -->
                <div class="collapse navbar-collapse" id="navbarNav">

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

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
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