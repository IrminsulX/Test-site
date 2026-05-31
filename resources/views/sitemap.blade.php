<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ url('/') }}</loc><priority>1.0</priority></url>
    <url><loc>{{ url('/games') }}</loc><priority>0.9</priority></url>
    <url><loc>{{ url('/news') }}</loc><priority>0.9</priority></url>
    <url><loc>{{ url('/forum') }}</loc><priority>0.8</priority></url>
    <url><loc>{{ url('/aboutpage') }}</loc><priority>0.7</priority></url>
    <url><loc>{{ url('/contact') }}</loc><priority>0.6</priority></url>
    @foreach($games as $game)
    <url><loc>{{ url('/games/' . $game->id) }}</loc><priority>0.7</priority></url>
    @endforeach
    @foreach($posts as $post)
    <url><loc>{{ url('/news/' . $post->id) }}</loc><priority>0.8</priority></url>
    @endforeach
</urlset>
