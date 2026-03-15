<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => '総務'],
            ['name' => '人事'],
            ['name' => '経理'],
            ['name' => '営業'],
            ['name' => '情報システム'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}