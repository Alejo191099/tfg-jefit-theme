<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            // Guardo el usuario si está iniciado sesión. Si compra como invitado, este campo puede quedar vacío
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Datos básicos del cliente que confirma el pedido
            $table->string('nombre_cliente');
            $table->string('email_cliente');

            // Total final calculado desde el carrito
            $table->decimal('total', 8, 2);

            // Estado del pedido para poder gestionarlo desde el panel de administrador
            $table->string('estado')->default('pendiente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Si deshago la migración, se elimina la tabla de pedidos
        Schema::dropIfExists('pedidos');
    }
};