<div class="space-y-4">
    <div>
        <label for="employee_code" class="mb-1 block text-sm font-medium text-gray-700">社員番号</label>
        <input type="text" name="employee_code" id="employee_code"
            value="{{ old('employee_code', $employee->employee_code ?? '') }}"
            class="w-full rounded border-gray-300 shadow-sm">
        @error('employee_code')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="name" class="mb-1 block text-sm font-medium text-gray-700">氏名</label>
        <input type="text" name="name" id="name" value="{{ old('name', $employee->name ?? '') }}"
            class="w-full rounded border-gray-300 shadow-sm">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="mb-1 block text-sm font-medium text-gray-700">メールアドレス</label>
        <input type="email" name="email" id="email" value="{{ old('email', $employee->email ?? '') }}"
            class="w-full rounded border-gray-300 shadow-sm">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="department_id" class="mb-1 block text-sm font-medium text-gray-700">部署</label>
        <select name="department_id" id="department_id" class="w-full rounded border-gray-300 shadow-sm">
            <option value="">選択してください</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ (string) old('department_id', $employee->department_id ?? '') === (string) $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
        @error('department_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="joined_on" class="mb-1 block text-sm font-medium text-gray-700">入社日</label>
        <input type="date" name="joined_on" id="joined_on" value="{{ old('joined_on', $employee->joined_on ?? '') }}"
            class="w-full rounded border-gray-300 shadow-sm">
        @error('joined_on')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="mb-1 block text-sm font-medium text-gray-700">在籍状況</label>
        <select name="status" id="status" class="w-full rounded border-gray-300 shadow-sm">
            <option value="active" {{ old('status', $employee->status ?? 'active') === 'active' ? 'selected' : '' }}>在籍中
            </option>
            <option value="leave" {{ old('status', $employee->status ?? '') === 'leave' ? 'selected' : '' }}>休職中</option>
            <option value="retired" {{ old('status', $employee->status ?? '') === 'retired' ? 'selected' : '' }}>退職
            </option>
        </select>
        @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            保存
        </button>

        <a href="{{ route('employees.index') }}" class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
            戻る
        </a>
    </div>
</div>