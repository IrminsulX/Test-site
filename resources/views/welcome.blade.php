<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | Welcome</title>

    <link rel="stylesheet" href="css/main.css">
    <script src="\js\homepage.js"></script>
</head>

<body>

    <!-- Header section -->
    <nav class="header">
        <nav class="navbar navbar-expand-lg">

            <!-- Logo and Brand -->
            <a class="navbar d-flex align-items-center" href="{{ route('welcome') }}">
                <img src="{{ asset('images/StudioLogo.png') }}" alt="Studio Logo" class="logo-icon">
                <button class="studio-button">Irminsul Studio ツ</button>
            </a>

            <!-- Left Side Content (Empty for now) -->
            <ul class="navbar-nav">
                <!-- Left Side Content -->
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                <a class="nav-link" href="{{ route('welcome') }}">
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
            
                <a class="nav-link" href="{{ route('register') }}">
                    <button class="register-button">Sign up</button>
                </a>
                
                <a class="nav-link" href="{{ route('login') }}">
                    <button class="register-button">Log in</button>
                </a>

            </ul>
            
        </nav>
    </nav>
    
    <!-- Dashboard Images Section -->
    <div class="dashboard-container">
        <div class="dashboard">
            @foreach (\App\Models\AdminHomepageImages::all() as $image)
                <div class="home-image">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->game_name }}">
                    <p>{{ $image->game_name }}</p>
                </div>
            @endforeach
        </div>
    </div>


    <div class="games-dashboard">
        <h2>
            <a href="https://www.roblox.com" target="_blank">
                <img src="{{ asset('images/HD New Roblox Logo Icon PNG - 800x800.png') }}" alt="Roblox Logo" class="game-icon">
            </a>
            ROBLOX GAMES
        </h2>
    </div>

    <div class="container games-dashboard-background">
        <div class="slider">

            <div class="slides">
                <div class="slide">
                    <div class="games-selector-dashboard" style="background-image: url('https://media.discordapp.net/attachments/640577423766978570/1337617764306915421/noFilter.webp?ex=67a8191e&is=67a6c79e&hm=fac9fb317797f44793ddf2bc38d8a4d8c03527e1e69c4b8783fec9714e20d093&=&format=webp');">
                        <h2>Block 123</h2>
                    </div>
                </div>
                
                <div class="slide">
                    <div class="games-selector-dashboard" style="background-image: url('https://media.discordapp.net/attachments/640577423766978570/1337618392336568330/noFilter.webp?ex=67a819b4&is=67a6c834&hm=2b4867fcccf2381ec158265cb4aa0f088067343ae18923d58c49bffd8cbd1563&=&format=webp');">
                        <h2>Freeze Tag</h2>
                    </div>
                </div>

                <div class="slide">
                    <div class="games-selector-dashboard" style="background-image: url('https://media.discordapp.net/attachments/640577423766978570/1337618743941136556/noFilter.jpg?ex=67a81a08&is=67a6c888&hm=3459b1d677654569baf0abbeeb29011059360090597803cfb33d6a889eee6fe4&=&format=webp');">
                        <h2>Better Obby</h2>
                    </div>
                </div>

                <div class="slide">
                    <div class="games-selector-dashboard" style="background-image: url('https://images-ext-1.discordapp.net/external/l8K9qr6mtxXCm8i5-L4rI_rlnOE-Y1dW9xQek6ygFRg/https/static.wikia.nocookie.net/fisch/images/1/10/Roslitbay.png?format=webp&quality=lossless&width=1112&height=671');">
                        <h2>2D Zombie</h2>
                    </div>
                </div>

                <div class="slide">
                    <div class="games-selector-dashboard" style="background-image: url('https://images-ext-1.discordapp.net/external/l8K9qr6mtxXCm8i5-L4rI_rlnOE-Y1dW9xQek6ygFRg/https/static.wikia.nocookie.net/fisch/images/1/10/Roslitbay.png?format=webp&quality=lossless&width=1112&height=671');">
                        <h2>Animation Testing</h2>
                    </div>
                </div>

            </div>
            <a class="prev" onclick="moveSlide(-1)">&#10094;</a>
            <a class="next" onclick="moveSlide(1)">&#10095;</a>
        </div>
    </div>

    <!-- Part of ROBLOX Games Selector Slide Bar

    <script>
        let slideIndex = 0;

        function moveSlide(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            const slides = document.querySelectorAll('.slide');
            if (n >= slides.length) { slideIndex = 0 }
            if (n < 0) { slideIndex = slides.length - 1 }
            const offset = -slideIndex * 25; // Adjust to match .slide flex-basis
            document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
        }
    </script> -->

    <div class="community-dashboard">
        <h2>
            <a>
                <img src="{{ asset('images/StudioLogo.png') }}" alt="Studio Logo" class="logo-icon">
            </a>
            COMMUNITY
        </h2>
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
                        <div class="navbar-container"> <!-- Changed from <ul> to <div> -->

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('adminhomepages') }}">
                                        <!-- Administrator Page Button --> 
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

                        </div> <!-- Closed the div -->

                    </div>
                    
                </div>
            </div>
        </nav>
    </nav>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
