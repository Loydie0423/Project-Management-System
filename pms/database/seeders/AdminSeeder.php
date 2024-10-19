<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'gender' => 'Male',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'profile_image' => null
        ]);
    }
}
