<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;

class EmployeeController extends Controller
{
public function index(Request $request)
{
    $query = Employee::with('department');

    if ($request->name) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->department_id) {
        $query->where('department_id', $request->department_id);
    }

    $employees = $query->paginate(10)->appends($request->query());
    $departments = Department::all();

    return view('employees.index', compact('employees', 'departments'));
}

    public function create()
    {
        $departments = Department::all();

        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:employees,email',
            'department_id' => 'required|exists:departments,id',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')
            ->with('success', '社員を追加しました');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();

        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:employees,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')
            ->with('success', '社員情報を更新しました');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', '社員を削除しました');
    }

    public function show($id)
{
    $employee = Employee::with('department')->findOrFail($id);

    return view('employees.show', compact('employee'));
}
}