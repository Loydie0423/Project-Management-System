<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['User', 'Admin'];
        for ($i = 0; $i <= 1; $i++) {
            Role::create([
                'name' => $roles[$i]
            ]);
        }

    }
}
