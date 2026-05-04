<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
   
        public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            $table->string('prenom');
            $table->string('nom');

            $table->date('date_naissance')->nullable();

            $table->string('adresse')->nullable();

            $table->string('email')->unique();

            $table->string('role')->default('etudiant');

            $table->string('numero_etudiant')
                  ->nullable()
                  ->unique();

            $table->foreignId('filiere_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');

            $table->foreignId('semestre_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');

            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
