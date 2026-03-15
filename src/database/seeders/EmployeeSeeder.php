<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['name' => '山田 太郎', 'email' => 'yamada@example.com', 'department_id' => 1],
            ['name' => '佐藤 花子', 'email' => 'sato@example.com', 'department_id' => 2],
            ['name' => '田中 一郎', 'email' => 'tanaka@example.com', 'department_id' => 3],
            ['name' => '鈴木 次郎', 'email' => 'suzuki@example.com', 'department_id' => 4],
            ['name' => '高橋 美咲', 'email' => 'takahashi@example.com', 'department_id' => 5],
            ['name' => '伊藤 健', 'email' => 'ito@example.com', 'department_id' => 1],
            ['name' => '渡辺 葵', 'email' => 'watanabe@example.com', 'department_id' => 2],
            ['name' => '中村 翼', 'email' => 'nakamura@example.com', 'department_id' => 3],
            ['name' => '小林 優', 'email' => 'kobayashi@example.com', 'department_id' => 4],
            ['name' => '加藤 翔', 'email' => 'kato@example.com', 'department_id' => 5],
            ['name' => '吉田 彩', 'email' => 'yoshida@example.com', 'department_id' => 1],
            ['name' => '山本 誠', 'email' => 'yamamoto@example.com', 'department_id' => 2],
            ['name' => '松本 陽菜', 'email' => 'matsumoto@example.com', 'department_id' => 3],
            ['name' => '井上 大輔', 'email' => 'inoue@example.com', 'department_id' => 4],
            ['name' => '木村 真央', 'email' => 'kimura@example.com', 'department_id' => 5],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}