<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectCategory::create([
            'name' => 'Accounting Software',
            'description' => "Accounting software is a computer program that assists bookkeepers and accountants in recording and reporting a firm's financial transactions."
        ]);
    }
}
