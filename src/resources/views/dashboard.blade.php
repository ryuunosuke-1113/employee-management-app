@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        社員管理ダッシュボード
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-white shadow rounded p-6 text-center">
            <p class="text-gray-500">社員数</p>
            <p class="text-3xl font-bold">{{ $employeeCount }}</p>
        </div>

        <div class="bg-white shadow rounded p-6 text-center">
            <p class="text-gray-500">部署数</p>
            <p class="text-3xl font-bold">{{ $departmentCount }}</p>
        </div>

    </div>

    <div class="bg-white shadow rounded p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">最近追加した社員</h2>

        @if($recentEmployees->isEmpty())
            <p class="text-gray-500">社員データがありません。</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2 text-left">名前</th>
                        <th class="border px-4 py-2 text-left">メールアドレス</th>
                        <th class="border px-4 py-2 text-left">部署</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentEmployees as $employee)
                        <tr>
                            <td class="border px-4 py-2">
                                <a href="{{ route('employees.show', $employee->id) }}"
                                   class="text-blue-600 hover:underline">
                                    {{ $employee->name }}
                                </a>
                            </td>
                            <td class="border px-4 py-2">{{ $employee->email }}</td>
                            <td class="border px-4 py-2">{{ $employee->department->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="flex gap-4">
        <a href="{{ route('employees.index') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            社員一覧へ
        </a>

        <a href="{{ route('departments.index') }}"
           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            部署一覧へ
        </a>
    </div>

</div>

@endsection