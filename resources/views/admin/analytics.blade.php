<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Irminsul Studio | Analytics</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminhomepage.css') }}">
</head>
<body>

    @include('partials.navbar')

    <div class="admin-heading-section">
        <div class="admin-heading">
            <span class="admin-star">&#9733;</span>
            <h2>ANALYTICS</h2>
            <span class="admin-star">&#9733;</span>
        </div>
    </div>

    <div class="admin-nav-row">
        <a href="{{ route('admin.dashboard') }}"><button class="admin-nav-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</button></a>
    </div>

    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>Overview</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; padding: 30px;">
            <div style="text-align: center; background: #212121; padding: 25px; border-radius: 8px;">
                <div style="font-size: 2rem; color: #db4f56;"><i class="fas fa-eye"></i></div>
                <div style="font-size: 1.8rem; font-weight: bold; color: #fff; margin: 10px 0;">{{ number_format($totalViews) }}</div>
                <div style="color: #aaa;">Total Page Views</div>
            </div>
            <div style="text-align: center; background: #212121; padding: 25px; border-radius: 8px;">
                <div style="font-size: 2rem; color: #ffd700;"><i class="fas fa-users"></i></div>
                <div style="font-size: 1.8rem; font-weight: bold; color: #fff; margin: 10px 0;">{{ number_format($uniqueIps) }}</div>
                <div style="color: #aaa;">Unique Visitors</div>
            </div>
        </div>
    </div>

    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>Popular Games</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card" style="padding: 20px;">
            @if($popularGames->isEmpty())
                <p style="color: #aaa; text-align: center; padding: 20px;">No data yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover" style="margin: 0;">
                        <thead>
                            <tr>
                                <th>Game Name</th>
                                <th class="text-end">Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($popularGames as $game)
                                <tr>
                                    <td>{{ $game->game_name ?? $game->name ?? '-' }}</td>
                                    <td class="text-end">{{ number_format($game->views) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>Popular Posts</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card" style="padding: 20px;">
            @if($popularPosts->isEmpty())
                <p style="color: #aaa; text-align: center; padding: 20px;">No data yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover" style="margin: 0;">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th class="text-end">Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($popularPosts as $post)
                                <tr>
                                    <td>{{ $post->title ?? '-' }}</td>
                                    <td class="text-end">{{ number_format($post->views) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>Views by Day</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card" style="padding: 20px;">
            @if($viewsByDay->isEmpty())
                <p style="color: #aaa; text-align: center; padding: 20px;">No data yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover" style="margin: 0;">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th class="text-end">Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewsByDay as $day)
                                <tr>
                                    <td>{{ $day->date }}</td>
                                    <td class="text-end">{{ number_format($day->count) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="admin-section">
        <div class="admin-section-header">
            <span class="admin-section-star">&#9733;</span>
            <h3>Views by Page Type</h3>
            <span class="admin-section-star">&#9733;</span>
        </div>

        <div class="admin-card" style="padding: 20px;">
            @if($viewsByPage->isEmpty())
                <p style="color: #aaa; text-align: center; padding: 20px;">No data yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover" style="margin: 0;">
                        <thead>
                            <tr>
                                <th>Page Type</th>
                                <th class="text-end">Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewsByPage as $page)
                                <tr>
                                    <td>{{ ucfirst($page->page_type) }}</td>
                                    <td class="text-end">{{ number_format($page->count) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
