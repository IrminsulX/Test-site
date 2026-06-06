<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsubscribed | Irminsul Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .unsubscribed-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 200px);
            padding: 40px 20px;
        }
        .unsubscribed-card {
            background: #272930;
            padding: 40px;
            max-width: 460px;
            width: 100%;
            text-align: center;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.4);
        }
        .unsubscribed-card h2 {
            color: #ffd700;
            margin-bottom: 16px;
        }
        .unsubscribed-card p {
            color: #ccc;
            margin-bottom: 24px;
        }
        .unsubscribed-card a {
            color: #db4f56;
            text-decoration: none;
            font-weight: 600;
        }
        .unsubscribed-card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="unsubscribed-wrapper">
        <div class="unsubscribed-card">
            <h2>&#9733; UNSUBSCRIBED &#9733;</h2>
            <p>You have been successfully unsubscribed from our newsletter.</p>
            <a href="{{ route('home') }}">&#8592; Back to Home</a>
        </div>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
