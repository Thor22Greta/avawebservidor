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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nombre del animal
            $table->string('raza');  // Raza del animal
            $table->string('chip')->nullable();  // Chip del animal, puede ser nulo
            $table->integer('age')->nullable();  // Edad del animal, puede ser nulo
            $table->unsignedBigInteger('user_id')->nullable();  // Relación con el usuario, puede ser nulo
            $table->boolean('adopted')->nullable();  // Adoptado como un timestamp o null
            $table->string('poster_image_url')->nullable();  // URL de la imagen del cartel, puede ser nula
            $table->timestamps();  // Timestamps

            // Relación con 'users'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
