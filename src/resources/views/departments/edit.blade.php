<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>部署編集</title>
</head>
<body>

<h1>部署編集</h1>

@if ($errors->any())
<div style="color:red">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form method="POST" action="{{ route('departments.update',$department->id) }}">

@csrf
@method('PUT')

<label>部署名</label><br>

<input
type="text"
name="name"
value="{{ old('name',$department->name) }}"
>

<br><br>

<button type="submit">
更新
</button>

</form>

<br>

<a href="{{ route('departments.index') }}">
一覧へ戻る
</a>

</body>
</html>