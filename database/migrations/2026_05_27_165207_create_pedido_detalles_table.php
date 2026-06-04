<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->id();

            // Guardo a qué pedido pertenece cada suplemento comprado
            $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete();

            // Guardo qué suplemento se ha añadido dentro del pedido
            $table->foreignId('suplemento_id')->constrained('suplementos')->cascadeOnDelete();

            // Cantidad elegida por el usuario desde el carrito
            $table->integer('cantidad');

            // Guardo el precio en el momento de la compra, por si luego cambia el precio del suplemento
            $table->decimal('precio_unitario', 8, 2);

            // Resultado de cantidad por precio unitario
            $table->decimal('subtotal', 8, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Si deshago la migración, elimino la tabla con los productos de cada pedido
        Schema::dropIfExists('pedido_detalles');
    }
};