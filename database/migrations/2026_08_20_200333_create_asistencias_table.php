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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
             $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('dia');
            $table->time('hora_entrada');
            $table->time('hora_salida')->nullable(); 
            $table->integer('minuto_retraso')->default(0);
            $table->enum('stado',['Presente','Tardanza','Aucente','Justificado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};