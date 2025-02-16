<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
            FashionablyLate
            </div>
            <a class="header__button" href="{{ route('login') }}">login</a>
        </div>
    </header>
    <div class="register-container">
        <h2>Register</h2>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <form class="form_container" method="POST" action="{{ route('register') }}">
                @csrf
            <div class="input-group">
                <label class="content_name" for="name">お名前</label>
                <input class="content_name-form" type="text" name="name" placeholder="例: 山田太郎">
                @error('name')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
                <br>
            <div class="input-group">
                <label class="content_email" for="email">メールアドレス</label>
                <input class="content_email__form" type="email" name="email" placeholder="例: test@example.com">
                @error('email')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
                <br>
            <div class="input-group">
                <label class="content_pass" for="password">パスワード</label>
                <input class="content_pass__form" type="password" name="password" placeholder="例: coachtech">
                @error('password')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
                <button class="content_button" type="submit">登録</button>
        </form>
    </div>
</body>
</html>