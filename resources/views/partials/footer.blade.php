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
                &copy; {{ date('Y') }} Irminsul Studio ツ
            </div>
        </div>
        <div class="footer-right">
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="footer-admin-btn">Admin</a>
                @endif
            @endauth
            <div class="footer-spinner"></div>
        </div>
    </div>
</footer>
