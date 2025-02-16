<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>thanks</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>
<body>
    <div class="background">Thank you</div>
    <div class="wrapper">
    <h2>お問い合せありがとうございました</h2>

    <div class="home-button">
        <a href="{{ route('contact.create') }}">
        <button>HOME</button>
        </a>
    </div>
    </div>
</body>
</html>