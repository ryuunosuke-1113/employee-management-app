<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 'active')->count();
        $leaveEmployees = Employee::where('status', 'leave')->count();
        $retiredEmployees = Employee::where('status', 'retired')->count();
        $totalDepartments = Department::count();

        $recentEmployees = Employee::with('department')
            ->orderBy('joined_on', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'leaveEmployees',
            'retiredEmployees',
            'totalDepartments',
            'recentEmployees'
        ));
    }
}