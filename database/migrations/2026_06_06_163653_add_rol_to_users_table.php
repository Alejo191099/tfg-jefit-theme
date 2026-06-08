<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Uso este campo para diferenciar al administrador de los usuarios normales
            if (!Schema::hasColumn('users', 'rol')) {
                $table->string('rol')->default('user');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Si deshago la migración, elimino el campo rol
            if (Schema::hasColumn('users', 'rol')) {
                $table->dropColumn('rol');
            }
        });
    }
};