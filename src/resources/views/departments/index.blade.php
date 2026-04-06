<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            部署一覧
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                @can('create', App\Models\Department::class)
                    <a href="{{ route('departments.create') }}"
                        class="inline-block rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        部署を登録
                    </a>
                @endcan
            </div>

            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">ID</th>
                            <th class="border px-4 py-2 text-left">部署名</th>
                            <th class="border px-4 py-2 text-left">所属社員数</th>
                            <th class="border px-4 py-2 text-left">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $department)
                            <tr>
                                <td class="border px-4 py-2">{{ $department->id }}</td>
                                <td class="border px-4 py-2">{{ $department->name }}</td>
                                <td class="border px-4 py-2">{{ $department->employees_count }}</td>
                                <td class="border px-4 py-2">
                                    <div class="flex gap-2">
                                        @can('update', $department)
                                            <a href="{{ route('departments.edit', $department) }}"
                                                class="rounded bg-yellow-500 px-3 py-1 text-white hover:bg-yellow-600">
                                                編集
                                            </a>
                                        @endcan
                                        @can('delete', $department)
                                            <form action="{{ route('departments.destroy', $department) }}" method="POST"
                                                onsubmit="return confirm('本当に削除しますか？');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">
                                                    削除
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border px-4 py-4 text-center text-gray-500">
                                    部署が登録されていません。
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
