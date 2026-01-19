<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Contexto BD: Definición de Tabla Productos con restricciones estrictas de FK.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->integer('stock');

            // CLAVES FORÁNEAS (FK) - NO NULLABLE
            // Un producto no puede existir sin sus definiciones base.
            // La integridad histórica se resuelve con SoftDeletes en los padres, no dejando campos nulos aquí.
            $table->foreignId('categoria_id')->constrained('categorias'); // index automático por convention
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('unidad_id')->constrained('unidades');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
