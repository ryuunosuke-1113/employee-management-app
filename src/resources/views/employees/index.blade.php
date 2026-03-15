@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">社員一覧</h2>
        <a href="{{ route('employees.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            社員追加
        </a>
    </div>

    <form method="GET" action="{{ route('employees.index') }}" class="bg-white shadow rounded p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">社員名</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ request('name') }}"
                    class="w-full border rounded px-3 py-2"
                    placeholder="社員名を入力"
                >
            </div>

            <div>
                <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">部署</label>
                <select
                    name="department_id"
                    id="department_id"
                    class="w-full border rounded px-3 py-2"
                >
                    <option value="">すべて</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ request('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                >
                    検索
                </button>

                <a
                    href="{{ route('employees.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded"
                >
                    リセット
                </a>
            </div>

        </div>
    </form>


    <table class="w-full bg-white shadow rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">氏名</th>
                <th class="px-4 py-2 text-left">メールアドレス</th>
                <th class="px-4 py-2 text-left">部署</th>
                <th class="px-4 py-2 text-left">編集</th>
                <th class="px-4 py-2 text-left">削除</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $employee->id }}</td>
                    <td class="px-4 py-2"><a href="{{ route('employees.show', $employee->id) }}"
       class="text-blue-600 hover:underline">
        {{ $employee->name }}
    </a></td>
                    <td class="px-4 py-2">{{ $employee->email }}</td>
                    <td class="px-4 py-2">{{ $employee->department->name ?? '未所属' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('employees.edit', $employee->id) }}"
                           class="text-blue-600 hover:underline">
                            編集
                        </a>
                    </td>
                    <td class="px-4 py-2">
<form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        onclick="return confirm('本当にこの社員を削除しますか？')"
        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
    >
        削除
    </button>
</form>                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                        社員データがありません
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        {{ $employees->links() }}
    </div>
@endsection