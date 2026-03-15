<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');

Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');

Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');

Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');

Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

Route::resource('departments', DepartmentController::class);