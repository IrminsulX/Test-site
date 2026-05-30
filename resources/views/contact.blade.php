<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | Contact</title>

    <link rel="stylesheet" href="css/contact.css">
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

    

    <div class="contact-section">
        <div class="contact-container">
            <div class="contact-info">
                <div class="contact-heading">
                    <span class="contact-star">&#9733;</span>
                    <h2>CONTACT US</h2>
                    <span class="contact-star">&#9733;</span>
                </div>
                <p class="contact-subtitle">Have a question or a game idea you want us to build? We'd love to hear from you!</p>

                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-item-icon">&#9993;</div>
                        <div>
                            <h4>Email</h4>
                            <p>contact@irminsulstudio.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon">&#8962;</div>
                        <div>
                            <h4>Location</h4>
                            <p>United States</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon">&#8635;</div>
                        <div>
                            <h4>Response Time</h4>
                            <p>Within 24-48 hours</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <h3>Send Us a Message</h3>
                <form action="/send-message" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your name" required>
                    </div>
                    <div class="form-group">
                        <label for="companyname">Company Name <span>(optional)</span></label>
                        <input type="text" id="companyname" name="companyname" placeholder="Company name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Tell us about your project..." rows="6" required></textarea>
                    </div>
                    <button type="submit" class="send-message-button">Send Message</button>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
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

                            <!-- Administrator Page Button --> 
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

                        </div> <!-- Closed the div -->

                    </div>
                    
                </div>
            </div>
        </nav>
    </nav>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
