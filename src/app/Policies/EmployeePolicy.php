<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;

class EmployeePolicy
{
    /**
     * 一覧表示を許可
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * 詳細表示を許可
     */
    public function view(User $user, Employee $employee): bool
    {
        return true;
    }

    /**
     * 登録を許可
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * 編集を許可
     */
    public function update(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }

    /**
     * 削除は admin のみ許可
     */
    public function delete(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
        // または return $user->isAdmin();
    }
}