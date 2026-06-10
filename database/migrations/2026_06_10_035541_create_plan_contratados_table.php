<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuto la migración para crear la tabla de planes contratados.
     */
    public function up(): void
    {
        Schema::create('plan_contratados', function (Blueprint $table) {
            $table->id();

            // Guardo el usuario que ha contratado el plan
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Guardo los datos principales del plan elegido
            $table->string('nombre_plan');
            $table->string('slug_plan');
            $table->decimal('precio', 8, 2);

            // Estado del plan contratado
            $table->string('estado')->default('activo');

            $table->timestamps();
        });
    }

    /**
     * Borro la tabla si se revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_contratados');
    }
};