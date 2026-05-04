<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
       
        Schema::create('emplois', function (Blueprint $table) {

            $table->id();

            //  cours
            $table->foreignId('cours_id')
                  ->constrained()
                  ->onDelete('cascade');

            // salle
            $table->foreignId('salle_id')
                  ->constrained()
                  ->onDelete('cascade');

            // jour (Lundi, Mardi...)
            $table->string('jour');

            //  pour les heures
            $table->time('heure_debut');
            $table->time('heure_fin');

            $table->timestamps();

           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emplois');
    }
};

