<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ダッシュボード
        </h2>
    </x-slot>
    <div class="mb-6 flex gap-4">
        <a href="{{ route('employees.index') }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            社員一覧へ
        </a>

        <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            部署一覧へ
        </a>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">社員総数</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalEmployees }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">在籍者数</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $activeEmployees }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">休職者数</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $leaveEmployees }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">退職者数</p>
                    <p class="text-3xl font-bold text-gray-600 mt-2">{{ $retiredEmployees }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">部署数</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalDepartments }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">最近入社した社員</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">社員コード</th>
                                <th class="px-4 py-2 border">氏名</th>
                                <th class="px-4 py-2 border">部署</th>
                                <th class="px-4 py-2 border">入社日</th>
                                <th class="px-4 py-2 border">ステータス</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentEmployees as $employee)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $employee->employee_code }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->name }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->department->name ?? '未所属' }}</td>
                                    <td class="px-4 py-2 border">{{ $employee->joined_on }}</td>
                                    <td class="px-4 py-2 border">
                                        @if ($employee->status === 'active')
                                            <span
                                                class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">在籍</span>
                                        @elseif ($employee->status === 'leave')
                                            <span
                                                class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">休職</span>
                                        @elseif ($employee->status === 'retired')
                                            <span class="px-2 py-1 text-xs bg-gray-200 text-gray-800 rounded">退職</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 border text-center text-gray-500">
                                        社員データがありません。
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
