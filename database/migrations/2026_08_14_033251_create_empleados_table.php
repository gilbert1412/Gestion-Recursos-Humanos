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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('numero_documento',15)->unique();
            $table->string('nombre_completo',100);
            $table->string('apellidos_completos',100);
            $table->string('email',150)->unique();
            $table->string('telefono',20)->nullable();
            $table->date('fecha_ingreso');
            $table->enum('estado',['ACTIVADO','INACTIVO'])->default('ACTIVADO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
