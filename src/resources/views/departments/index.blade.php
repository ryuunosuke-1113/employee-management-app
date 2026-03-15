@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

<h2 class="text-2xl font-bold">
部署一覧
</h2>

<a href="{{ route('departments.create') }}"
class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

部署追加

</a>

</div>


@if (session('success'))
<p class="text-green-600 mb-4">
{{ session('success') }}
</p>
@endif

@if (session('error'))
<p class="text-red-600 mb-4">
{{ session('error') }}
</p>
@endif


<table class="w-full bg-white shadow rounded-lg overflow-hidden">

<thead class="bg-gray-200">

<tr>

<th class="px-4 py-2 text-left">
ID
</th>

<th class="px-4 py-2 text-left">
部署名
</th>

<th class="px-4 py-2 text-left">
編集
</th>

<th class="px-4 py-2 text-left">
削除
</th>

</tr>

</thead>

<tbody>

@forelse ($departments as $department)

<tr class="border-t">

<td class="px-4 py-2">
{{ $department->id }}
</td>

<td class="px-4 py-2">
{{ $department->name }}
</td>

<td class="px-4 py-2">

<a href="{{ route('departments.edit',$department->id) }}"
class="text-blue-600 hover:underline">

編集

</a>

</td>

<td class="px-4 py-2">

<form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        onclick="return confirm('本当にこの部署を削除しますか？')"
        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
    >
        削除
    </button>
</form>
</td>

</tr>

@empty

<tr>

<td colspan="4"
class="px-4 py-4 text-center text-gray-500">

部署データがありません

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-6">

{{ $departments->links() }}

</div>

@endsection