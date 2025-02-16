<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
            FashionablyLate
            </div>
        </div>
    </header>
    <div class="contact-container">
        <h2>Contact</h2>
        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <form class="form_container" action="{{ route('contact.confirm') }}" method="POST">
                @csrf
                <p>
                    <label for="name">お名前<span style="color: red;">※</span></label>
                    <div class="name-group">
                        <input type="text" name="last_name" value="{{ old('last_name', session('contact_data.last_name')) }}" placeholder="例: 山田">
                        <input type="text" name="first_name" value="{{ old('first_name', session('contact_data.first_name')) }}" placeholder="例: 太郎">
                    </div>
                </p>
                <p>
                    <label class="gender" for="gender">性別<span style="color: red;">※</span></label>
                    <input type="radio" name="gender" value="1" {{ old('gender', session('contact_data.gender')) == '1' ? 'checked' : '' }}> 男性
                    <input class="content_gender-form" type="radio" name="gender" value="2" {{ old('gender', session('contact_data.gender')) == '2' ? 'checked' : '' }}> 女性
                    <input class="content_gender-form" type="radio" name="gender" value="3" {{ old('gender', session('contact_data.gender')) == '3' ? 'checked' : '' }}> その他
                    @error('gender')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </p>
                <p>
                    <label class="email" for="email">メールアドレス<span style="color: red;">※</span></label>
                    <input type="email" name="email" value="{{ old('email', session('contact_data.email')) }}" placeholder="例 test@example.com">
                    @error('email')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </p>
                <p>
                    <label class="content_tel" for="tel">電話番号<span style="color: red;">※</span></label>
                    <input type="text" name="tel1" maxlength="4" required value="{{ old('tel1', session('contact_data.tel1')) }}"  placeholder="080"> -
                    <input type="text" name="tel2" maxlength="4" required value="{{ old('tel2', session('contact_data.tel2')) }}"  placeholder="1234"> -
                    <input type="text" name="tel3" maxlength="4" required value="{{ old('tel3', session('contact_data.tel3')) }}"  placeholder="5678">
                    @error('tel')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </p>
                <p>
                    <label class="address" for="address">住所<span style="color: red;">※</span></label>
                    <input type="text" name="address" value="{{ old('address', session('contact_data.address')) }}" placeholder="例 東京都渋谷区千駄ケ谷1-2-3">
                    @error('address')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </p>
                <p>
                    <label class="building" for="building">建物名</label>
                    <input type="text" name="building" value="{{ old('building', session('contact_data.building')) }}" placeholder="例 千駄ケ谷マンション101">
                </p>
                <p>
                    <label class="category-id" for="category_id">お問い合わせの種類<span style="color: red;">※</span></label>
                    <select name="category_id" id="category_id" required>
                        <option value="" disabled {{ old('category_id') == '' ? 'selected' : '' }}>選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </p>
                <p>
                    <label class="textarea" for="textarea">お問い合わせ内容<span style="color: red;">※</span></label>
                    <textarea name="textarea" cols="30" rows="3" placeholder="お問い合わせ内容をご記載ください">{{ old('textarea', session('contact_data.textarea')) }}</textarea>
                    @error('textarea')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </p>
                <p>
                    <input type="submit" class="content_submit" name="confirm" value="確認画面">
                </p>
            </form>
    </div>
</body>
</html>