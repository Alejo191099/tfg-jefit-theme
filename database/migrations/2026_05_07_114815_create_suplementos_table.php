<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suplementos', function (Blueprint $table) {
            $table->id(); // Crea un ID automático (1, 2, 3...)
            $table->string('nombre'); // Para el nombre del suplemento
            $table->text('descripcion'); // Para un texto más largo
            $table->decimal('precio', 8, 2); // Para el precio con dos decimales
            $table->string('imagen')->nullable(); // Para guardar la ruta de la foto
            $table->timestamps(); // Guarda automáticamente cuándo se creó o editó
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suplementos');
    }
};
