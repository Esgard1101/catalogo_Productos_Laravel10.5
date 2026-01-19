<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // TABLE: unidades (User requirement: fix plural name)
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            // History constraint
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
