<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
            FashionablyLate
            </div>
            <h2>確認画面</h2>
            <p>お名前: {{ $data['last_name'] }} {{ $data['first_name'] }}</p>
            <p>性別:
                @if ($data['gender'] == '1')
                    男性
                @elseif ($data['gender'] == '2')
                    女性
                @else
                    その他
                @endif
            </p>
            <p>メールアドレス: {{ $data['email'] }}</p>
            <p>電話番号: {{ $data['tel1'] }}-{{ $data['tel2'] }}-{{ $data['tel3'] }}</p>
            <p>住所: {{ $data['address'] }}</p>
            <p>建物名: {{ $data['building_name'] ?? 'なし' }}</p>
            <p>お問い合わせの種類: {{ $data['category_name'] }}</p>
            <p>お問い合わせ内容: {{ $data['textarea'] }}</p>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                @foreach ($data as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <input type="hidden" name="tel" value="{{ $data['tel1'] }}-{{ $data['tel2'] }}-{{ $data['tel3'] }}">
                <button type="submit">送信</button>
            </form>

            <button type="button" onclick="history.back()">修正する</button>

        </div>
</body>
</html>