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
        Schema::create('productos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre', 50);
    $table->enum('especie', ['perro', 'gato', 'ave', 'pez', 'otro']);
    $table->string('raza', 80)->nullable();
    $table->integer('edad')->unsigned(); // en meses
    $table->decimal('peso', 5, 2)->unsigned();
    $table->string('color', 50);
    $table->string('propietario', 100);
    $table->boolean('vacunas')->default(false);
    $table->boolean('estado')->default(true); // true = activo, false = fallecido
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
