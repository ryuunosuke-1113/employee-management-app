<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>社員追加</title>
</head>

<body>

<h1>社員追加</h1>

@if ($errors->any())
    <div style="color: red; margin-bottom: 16px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('employees.store') }}">
@csrf

<div>
名前<br>
<input type="text" name="name" value="{{ old('name') }}">
</div>

<div>
メール<br>
<input type="text" name="email" value="{{ old('email') }}">
</div>

<div>
部署<br>

</div>
<select name="department_id">
    <option value="">選択してください</option>
    @foreach ($departments as $department)
        <option value="{{ $department->id }}"
            {{ old('department_id') == $department->id ? 'selected' : '' }}>
            {{ $department->name }}
        </option>
    @endforeach
</select>
<br>

<button type="submit">
登録
</button>

</form>

</body>
</html>