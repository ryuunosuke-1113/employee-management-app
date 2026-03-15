<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::paginate(10);

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:departments,name',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')
            ->with('success', '部署を追加しました');
    }

    public function show(string $id)
    {
        //
    }

public function edit($id)
{
    $department = Department::findOrFail($id);

    return view('departments.edit', compact('department'));
}

public function update(Request $request, $id)
{
    $department = Department::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|max:50|unique:departments,name,' . $department->id
    ]);

    $department->update($validated);

    return redirect()->route('departments.index')
        ->with('success','部署を更新しました');
}

public function destroy($id)
{
    $department = Department::findOrFail($id);

    if ($department->employees()->exists()) {
        return redirect()->route('departments.index')
            ->with('error', '社員が所属している部署は削除できません。');
    }

    $department->delete();

    return redirect()->route('departments.index')
        ->with('success', '部署を削除しました');
}
}