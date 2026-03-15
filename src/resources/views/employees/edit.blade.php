<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>社員編集</title>
</head>

<body>

<h1>社員編集</h1>

@if ($errors->any())
    <div style="color: red; margin-bottom: 16px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('employees.update',$employee->id) }}">
@csrf
@method('PUT')

<div>
名前<br>
<input type="text" name="name" value="{{ $employee->name }}">
</div>

<div>
メール<br>
<input type="email" name="email" value="{{ $employee->email }}">
</div>

<div>
部署<br>
<select name="department_id">

@foreach($departments as $department)

<option value="{{ $department->id }}"
@if($employee->department_id == $department->id) selected @endif>

{{ $department->name }}

</option>

@endforeach

</select>

</div>

<br>

<button type="submit">
更新
</button>

</form>

</body>
</html>