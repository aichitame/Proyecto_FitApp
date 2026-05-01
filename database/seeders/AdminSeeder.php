<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@fitapp.com'],
            [
                'name' => 'Admin FitApp',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'client@test.com'],
            [
                'name' => 'Cliente Aixa',
                'password' => Hash::make('Cliente123!'),
                'role' => 'client',
            ]
        );
    }
}