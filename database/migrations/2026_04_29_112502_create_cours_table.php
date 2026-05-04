<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('cours', function (Blueprint $table) {

    $table->id();

    $table->string('nom');

    $table->foreignId('filiere_id')
          ->constrained()
          ->onDelete('cascade');

    $table->foreignId('semestre_id')
          ->constrained()
          ->onDelete('cascade');

    
    $table->foreignId('enseignant_id')
          ->constrained('users')
          ->onDelete('cascade');

    $table->integer('nombre_heures');

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
