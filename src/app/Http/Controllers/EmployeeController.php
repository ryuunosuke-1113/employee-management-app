<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EmployeeController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->validateEmployeeFilters($request);

        $employees = $this->buildEmployeeQuery($request)
            ->paginate(10)
            ->withQueryString();

        $departments = Department::orderBy('name')->get();

        return view('employees.index', compact('employees', 'departments'));
    }

    public function create()
    {
        $this->authorize('create', Employee::class);

        $departments = Department::orderBy('name')->get();

        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Employee::class);

        $validated = $request->validate(
            $this->employeeValidationRules(),
            $this->employeeValidationMessages()
        );

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', '社員を登録しました。');
    }

    public function show(Employee $employee)
    {
        $employee->load('department');

        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);

        $departments = Department::orderBy('name')->get();

        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $this->authorize('update', $employee);

        $validated = $request->validate(
            $this->employeeValidationRules($employee),
            $this->employeeValidationMessages()
        );

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', '社員情報を更新しました。');
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', '社員を削除しました。');
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $this->authorize('viewAny', Employee::class);

        $this->validateEmployeeFilters($request);

        $employees = $this->buildEmployeeQuery($request)->get();

        $fileName = 'employees_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($employees) {
            $handle = fopen('php://output', 'w');

            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                '社員コード',
                '氏名',
                'メールアドレス',
                '部署',
                '入社日',
                'ステータス',
            ]);

            foreach ($employees as $employee) {
                $statusLabel = match ($employee->status) {
                    'active' => '在籍',
                    'leave' => '休職',
                    'retired' => '退職',
                    default => '',
                };

                fputcsv($handle, [
                    $employee->employee_code,
                    $employee->name,
                    $employee->email,
                    $employee->department->name ?? '',
                    $employee->joined_on,
                    $statusLabel,
                ]);
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function validateEmployeeFilters(Request $request): void
    {
        $request->validate([
            'keyword' => ['nullable', 'string', 'max:100'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'status' => ['nullable', 'in:active,leave,retired'],
            'sort' => ['nullable', 'in:id,employee_code,name,joined_on'],
            'direction' => ['nullable', 'in:asc,desc'],
        ]);
    }

    private function buildEmployeeQuery(Request $request): Builder
    {
        $keyword = $request->query('keyword');
        $departmentId = $request->query('department_id');
        $status = $request->query('status');
        $sort = $request->query('sort', 'id');
        $direction = $request->query('direction', 'desc');

        return Employee::with('department')
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%');
                });
            })
            ->when($departmentId, function ($query, $departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy($sort, $direction);
    }

    private function employeeValidationRules(?Employee $employee = null): array
    {
        $employeeId = $employee?->id;

        return [
            'employee_code' => ['required', 'string', 'max:50', 'unique:employees,employee_code,' . $employeeId],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:employees,email,' . $employeeId],
            'department_id' => ['required', 'exists:departments,id'],
            'joined_on' => ['required', 'date'],
            'status' => ['required', 'in:active,leave,retired'],
        ];
    }

    private function employeeValidationMessages(): array
    {
        return [
            'employee_code.required' => '社員番号を入力してください。',
            'employee_code.unique' => 'この社員番号はすでに登録されています。',
            'name.required' => '氏名を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'email.unique' => 'このメールアドレスはすでに登録されています。',
            'department_id.required' => '部署を選択してください。',
            'department_id.exists' => '正しい部署を選択してください。',
            'joined_on.required' => '入社日を入力してください。',
            'joined_on.date' => '正しい日付を入力してください。',
            'status.required' => 'ステータスを選択してください。',
            'status.in' => '正しいステータスを選択してください。',
        ];
    }
}