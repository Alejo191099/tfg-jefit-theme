<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Al ejecutar php artisan db:seed se crean el admin y algunos suplementos de ejemplo.
        $this->call([
            UserSeeder::class,
            SuplementoSeeder::class,
        ]);
    }
}
