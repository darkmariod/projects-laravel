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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('clientes');
            $table->decimal('diario', 10,2);
            $table->decimal('porcentaje_60')->nullable();
            $table->decimal('adelanto', 10, 2)->nullable();
            $table->decimal('incentivos', 10, 2)->nullable();
            $table->decimal('porcentaje_incentivos, 10,2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
