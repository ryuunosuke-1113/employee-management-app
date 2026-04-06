<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            社員一覧
        </h2>
    </x-slot>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 検索・フィルタフォーム --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('employees.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">

                        <div>
                            <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">
                                キーワード
                            </label>
                            <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}"
                                placeholder="氏名 or メール"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">
                                部署
                            </label>
                            <select name="department_id" id="department_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">すべて</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                ステータス
                            </label>
                            <select name="status" id="status"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">すべて</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>在籍
                                </option>
                                <option value="leave" {{ request('status') === 'leave' ? 'selected' : '' }}>休職</option>
                                <option value="retired" {{ request('status') === 'retired' ? 'selected' : '' }}>退職
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">
                                並び替え項目
                            </label>
                            <select name="sort" id="sort"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="id" {{ request('sort', 'id') === 'id' ? 'selected' : '' }}>ID
                                </option>
                                <option value="employee_code"
                                    {{ request('sort') === 'employee_code' ? 'selected' : '' }}>社員コード</option>
                                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>氏名</option>
                                <option value="joined_on" {{ request('sort') === 'joined_on' ? 'selected' : '' }}>入社日
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="direction" class="block text-sm font-medium text-gray-700 mb-1">
                                順序
                            </label>
                            <select name="direction" id="direction"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="asc" {{ request('direction') === 'asc' ? 'selected' : '' }}>昇順
                                </option>
                                <option value="desc" {{ request('direction', 'desc') === 'desc' ? 'selected' : '' }}>
                                    降順</option>
                            </select>
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                検索
                            </button>

                            <a href="{{ route('employees.index') }}"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                リセット
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- 一覧 --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @can('create', App\Models\Employee::class)
                    <div class="mb-4">
                        <a href="{{ route('employees.create') }}"
                            class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            社員を登録
                        </a>
                    @endcan
                    <a href="{{ route('employees.export.csv', request()->query()) }}"
                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        CSV出力
                    </a>
                </div>


                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">
                                    <a
                                        href="{{ route(
                                            'employees.index',
                                            array_merge(request()->query(), [
                                                'sort' => 'employee_code',
                                                'direction' => request('sort') === 'employee_code' && request('direction') === 'asc' ? 'desc' : 'asc',
                                            ]),
                                        ) }}">
                                        社員コード
                                        @if (request('sort') === 'employee_code')
                                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="px-4 py-2 border">
                                    <a
                                        href="{{ route(
                                            'employees.index',
                                            array_merge(request()->query(), [
                                                'sort' => 'name',
                                                'direction' => request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 'asc',
                                            ]),
                                        ) }}">
                                        氏名
                                        @if (request('sort') === 'name')
                                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="px-4 py-2 border">メール</th>
                                <th class="px-4 py-2 border">部署</th>
                                <th class="px-4 py-2 border">
                                    <a
                                        href="{{ route(
                                            'employees.index',
                                            array_merge(request()->query(), [
                                                'sort' => 'joined_on',
                                                'direction' => request('sort') === 'joined_on' && request('direction') === 'asc' ? 'desc' : 'asc',
                                            ]),
                                        ) }}">
                                        入社日
                                        @if (request('sort') === 'joined_on')
                                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                        @endif
                                    </a>
                                </th>
                                <th class="px-4 py-2 border">ステータス</th>
                                <th class="px-4 py-2 border">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $employee->employee_code }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->name }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->email }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->department->name ?? '未所属' }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->joined_on }}</td>
                                    <td class="px-4 py-2 border">
                                        @switch($employee->status)
                                            @case('active')
                                                在籍
                                            @break

                                            @case('leave')
                                                休職
                                            @break

                                            @case('retired')
                                                退職
                                            @break

                                            @default
                                                -
                                        @endswitch
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <div class="flex gap-2">
                                            <a href="{{ route('employees.show', $employee) }}"
                                                class="text-blue-600 hover:underline">
                                                詳細
                                            </a>

                                            @can('update', $employee)
                                                <a href="{{ route('employees.edit', $employee) }}"
                                                    class="text-yellow-600 hover:underline">
                                                    編集
                                                </a>
                                            @endcan

                                            @can('delete', $employee)
                                                <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('本当に削除しますか？')"
                                                        class="text-red-600 hover:underline">
                                                        削除
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-6 border text-center text-gray-500">
                                            該当する社員がいません。
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
