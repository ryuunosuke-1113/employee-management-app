<div class="space-y-4">
    <div>
        <label for="name" class="mb-1 block text-sm font-medium text-gray-700">部署名</label>
        <input type="text" name="name" id="name" value="{{ old('name', $department->name ?? '') }}"
            class="w-full rounded border-gray-300 shadow-sm">

        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            保存
        </button>

        <a href="{{ route('departments.index') }}"
            class="rounded bg-gray-300 px-4 py-2 text-gray-800 hover:bg-gray-400">
            戻る
        </a>
    </div>
</div>