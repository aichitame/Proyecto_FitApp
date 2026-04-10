<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crear el administrador
        User::create([
            'name' => 'Admin FitApp',
            'email' => 'admin@fitapp.com',
            'password' => Hash::make('Admin123!'), //cumple con el RF-01
            'role' => 'admin',
        ]);

        //crear un cliente de prueba
        User::create([
            'name' => 'Cliente Aixa',
            'email' => 'client@test.com',
            'password' => Hash::make('Cliente123!'),
            'role' => 'client',
        ]);
    }
}
