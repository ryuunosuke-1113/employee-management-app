<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\UrlGenerator;
use App\Models\Employee;
use App\Policies\EmployeePolicy;
use App\Models\Department;
use App\Policies\DepartmentPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url): void
    {
        Gate::policy(Employee::class, EmployeePolicy::class);
        Gate::policy(Department::class, DepartmentPolicy::class);

        if (env('APP_ENV') === 'production') {
            $url->forceScheme('https');
        }
    }
}