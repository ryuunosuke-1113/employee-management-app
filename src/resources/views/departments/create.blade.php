<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>部署追加</title>
</head>
<body>
    <h1>部署追加</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 16px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('departments.store') }}">
        @csrf

        <div style="margin-bottom: 12px;">
            <label>部署名</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <button type="submit">登録</button>
    </form>

    <br>
    <a href="{{ route('departments.index') }}">部署一覧へ戻る</a>
</body>
</html>