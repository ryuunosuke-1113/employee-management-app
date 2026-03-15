<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;

class DashboardController extends Controller
{
    public function index()
    {
        $employeeCount = Employee::count();
        $departmentCount = Department::count();
        $recentEmployees = Employee::with('department')->latest()->take(5)->get();

        return view('dashboard', compact('employeeCount', 'departmentCount', 'recentEmployees'));
    }
}