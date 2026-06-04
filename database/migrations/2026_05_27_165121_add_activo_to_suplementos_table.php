<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suplementos', function (Blueprint $table) {
            // Añado este campo para poder mostrar u ocultar suplementos sin borrarlos
            if (!Schema::hasColumn('suplementos', 'activo')) {
                $table->boolean('activo')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('suplementos', function (Blueprint $table) {
            // Si deshago esta migración, quito la columna activo
            if (Schema::hasColumn('suplementos', 'activo')) {
                $table->dropColumn('activo');
            }
        });
    }
};