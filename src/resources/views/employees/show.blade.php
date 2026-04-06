<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            社員詳細
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <dl class="grid grid-cols-1 gap-4">
                    <div>
                        <dt class="font-semibold text-gray-700">社員番号</dt>
                        <dd>{{ $employee->employee_code }}</dd>
                    </div>

                    <div>
                        <dt class="font-semibold text-gray-700">氏名</dt>
                        <dd>{{ $employee->name }}</dd>
                    </div>

                    <div>
                        <dt class="font-semibold text-gray-700">メールアドレス</dt>
                        <dd>{{ $employee->email }}</dd>
                    </div>

                    <div>
                        <dt class="font-semibold text-gray-700">部署</dt>
                        <dd>{{ $employee->department->name }}</dd>
                    </div>

                    <div>
                        <dt class="font-semibold text-gray-700">入社日</dt>
                        <dd>{{ $employee->joined_on }}</dd>
                    </div>

                    <div>
                        <dt class="font-semibold text-gray-700">在籍状況</dt>
                        <dd>
                            @if ($employee->status === 'active')
                                在籍中
                            @elseif ($employee->status === 'leave')
                                休職中
                            @else
                                退職
                            @endif
                        </dd>
                    </div>

                    <div>
                        <dt class="font-semibold text-gray-700">作成日時</dt>
                        <dd>{{ $employee->created_at }}</dd>
                    </div>

                    <div>
                        <dt class="font-semibold text-gray-700">更新日時</dt>
                        <dd>{{ $employee->updated_at }}</dd>
                    </div>
                </dl>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('employees.edit', $employee) }}"
                        class="rounded bg-yellow-500 px-4 py-2 text-white hover:bg-yellow-600">
                        編集
                    </a>

                    <a href="{{ route('employees.index') }}"
                        class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
                        一覧へ戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>