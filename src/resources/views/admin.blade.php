<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
            FashionablyLate
            </div>
            <a class="header__button" href="{{ route('login') }}">logout</a>
        </div>
    </header>
    <main>
        <div class="admin-container">
        <h2>Admin</h2>
        <form action="{{ route('admin.search') }}" method="GET">
        @csrf
            <input type="text" name="query" placeholder="名前やメールアドレスを入力してください">
            <select name="gender">
                <option value="" disabled selected>性別</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
                <option value="all">全て</option>
            </select>
            <select name="category_id" required>
            <option value="" disabled {{ old('category_id') === null ? 'selected' : '' }}>選択してください</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $data['category_id'] ?? null) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
            </select>
                <label for="date"></label>
                    <input type="date" name="date" id="date">
                    <button type="submit">検索</button>
                    <button type="reset">リセット</button>
        </form>
        <div class="container mt-5">
        <h2>Contacts List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th></th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->first_name }}</td>
                        <td>{{ $contact->last_name }}</td>
                        <td>{{ $contact->gender_text }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category_id_text }}</td>
                        <td>
                            <button type="button" class="btn btn-primary detail-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal"
                                data-id="{{ $contact->id }}"
                                data-first-name="{{ $contact->first_name }}"
                                data-last-name="{{ $contact->last_name }}"
                                data-gender="{{ $contact->gender }}"
                                data-email="{{ $contact->email }}"
                                data-tel1="{{ $contact->tel1 }}"
                                data-tel2="{{ $contact->tel2 }}"
                                data-tel3="{{ $contact->tel3 }}"
                                data-address="{{ $contact->address }}"
                                data-building="{{ $contact->building }}"
                                data-category_id="{{ $contact->category_id }}"
                                data-textarea="{{ $contact->textarea }}">
                                詳細
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
        {{ $contacts->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
        @include('admin.modals.detail_modal')
</main>
</body>
</html>