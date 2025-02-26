<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">

</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
            FashionablyLate
            </div>
        </div>
    </header>
    <div class="confirm-container">
        <h2>Confirm</h2>
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $data['last_name'] }} {{ $data['first_name'] }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if ($data['gender'] == '1')
                        男性
                    @elseif ($data['gender'] == '2')
                        女性
                    @else
                        その他
                    @endif
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $data['email'] }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $data['tel'] }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $data['address'] }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $data['building_name'] ?? 'なし' }}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>{{ $data['category_name'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td class="textarea-cell">{{ $data['textarea'] }}</td>
            </tr>
        </table>
    </div>
        <div class="button-container">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                @foreach ($data as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <input type="hidden" name="tel" value="{{ $data['tel'] }}">
                <button type="submit" class="btn">送信</button>
            </form>

            <button type="button" class="btn" onclick="history.back()">修正</button>
        </div>
</body>
</html>