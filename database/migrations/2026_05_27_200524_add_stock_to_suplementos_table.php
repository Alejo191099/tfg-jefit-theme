<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suplementos', function (Blueprint $table) {
            // Añado el stock para controlar cuántas unidades quedan de cada suplemento
            if (!Schema::hasColumn('suplementos', 'stock')) {
                $table->integer('stock')->default(10);
            }
        });
    }

    public function down(): void
    {
        Schema::table('suplementos', function (Blueprint $table) {
            // Si deshago esta migración, elimino la columna stock
            if (Schema::hasColumn('suplementos', 'stock')) {
                $table->dropColumn('stock');
            }
        });
    }
};
