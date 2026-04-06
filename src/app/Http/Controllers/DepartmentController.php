<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DepartmentController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $departments = Department::withCount('employees')
            ->latest()
            ->get();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $this->authorize('create', Department::class);

        return view('departments.create');
    }
    public function store(Request $request)
    {
        $this->authorize('create', Department::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:departments,name'],
        ]);

        Department::create($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', '部署を登録しました。');
    }
    public function edit(Department $department)
    {
        $this->authorize('update', $department);

        return view('departments.edit', compact('department'));
    }
    public function update(Request $request, Department $department)
    {
        $this->authorize('update', $department);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:departments,name,' . $department->id],
        ]);

        $department->update($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', '部署を更新しました。');
    }
    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        if ($department->employees()->exists()) {
            return redirect()
                ->route('departments.index')
                ->with('error', '社員が所属している部署は削除できません。');
        }

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', '部署を削除しました。');
    }
}