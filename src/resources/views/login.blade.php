<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
            FashionablyLate
            </div>
            <a class="header__button" href="{{ route('register') }}">register</a>
        </div>
    </header>
    <div class="login-container">
        <h2>Login</h2>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
            <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label class="content_email" for="email">メールアドレス</label>
                <input class="content_email-form" type="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-group">
                <label class="content_password" for="password">パスワード</label>
                <input class="content_password-form" type="password" name="password" value="{{ old('password') }}">
                @error('email')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-group">
                <input class="content_submit" type="submit" value="ログイン">
            </div>
            </form>
</body>
</html>