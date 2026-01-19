<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verificar si existe la columna 'precio' antes de renombrarla
        if (Schema::hasColumn('productos', 'precio')) {
            DB::statement('ALTER TABLE productos CHANGE precio precio_venta DECIMAL(10,2) NOT NULL');
        }

        // Verificar si existe 'precio_compra' antes de crearla
        if (!Schema::hasColumn('productos', 'precio_compra')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->decimal('precio_compra', 10, 2)->after('nombre');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('productos', 'precio_compra')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->dropColumn('precio_compra');
            });
        }

        if (Schema::hasColumn('productos', 'precio_venta')) {
            DB::statement('ALTER TABLE productos CHANGE precio_venta precio DECIMAL(10,2) NOT NULL');
        }
    }
};
