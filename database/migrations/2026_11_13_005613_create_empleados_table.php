<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('identidad', 13)->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->unique();
            $table->string('cargo', 50);
            $table->decimal('salario', 10, 2);
            $table->date('fecha_ingreso');
            $table->string('estado', 10);
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
