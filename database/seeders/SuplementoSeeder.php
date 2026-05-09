<?php

namespace Database\Seeders;

use App\Models\Suplemento;
use Illuminate\Database\Seeder;

class SuplementoSeeder extends Seeder
{
    public function run(): void
    {
        // Datos de ejemplo para tener contenido nada más preparar la base de datos.
        $suplementos = [
            [
                'nombre' => 'Proteína Whey Isolate',
                'descripcion' => 'Proteína de suero de leche de alta pureza para la recuperación muscular.',
                'precio' => 45.99,
                'imagen' => null,
            ],
            [
                'nombre' => 'Creatina Monohidrato',
                'descripcion' => 'Aumenta tu fuerza y resistencia en los entrenamientos más intensos.',
                'precio' => 24.50,
                'imagen' => null,
            ],
        ];

        foreach ($suplementos as $suplemento) {
            // updateOrCreate evita duplicados si lanzo el seeder más de una vez.
            Suplemento::updateOrCreate(
                ['nombre' => $suplemento['nombre']],
                $suplemento
            );
        }
    }
}
