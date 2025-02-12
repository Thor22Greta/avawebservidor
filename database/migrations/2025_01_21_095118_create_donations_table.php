<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  
            $table->decimal('amount', 8, 2);
            $table->unsignedBigInteger('animal_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();   
            $table->enum('payment_method', ['transaction_id', 'cash'])->nullable(); 
            $table->timestamps();

            // Relacion con 'users'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Relacion con 'animals'
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('set null');
            // Relacion con 'events'
            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
}
