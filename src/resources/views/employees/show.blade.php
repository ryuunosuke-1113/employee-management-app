@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        社員詳細
    </h1>

    <div class="bg-white shadow rounded p-6 space-y-4">

        <div>
            <p class="text-gray-500">名前</p>
            <p class="text-lg font-semibold">{{ $employee->name }}</p>
        </div>

        <div>
            <p class="text-gray-500">メールアドレス</p>
            <p>{{ $employee->email }}</p>
        </div>

        <div>
            <p class="text-gray-500">部署</p>
            <p>{{ $employee->department->name }}</p>
        </div>

        <div>
            <p class="text-gray-500">登録日</p>
            <p>{{ $employee->created_at->format('Y-m-d') }}</p>
        </div>

    </div>

    <div class="mt-6 flex gap-3">

        <a href="{{ route('employees.edit', $employee->id) }}"
           class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded">
            編集
        </a>

        <a href="{{ route('employees.index') }}"
           class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
            一覧へ戻る
        </a>

    </div>

</div>

@endsection