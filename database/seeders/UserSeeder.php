<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario de prueba para entrar al panel de administración.
        // La contraseña se guarda encriptada, nunca como texto normal.
        User::updateOrCreate(
            ['email' => 'admin@jefit.com'],
            [
                'name' => 'Alejo',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}
