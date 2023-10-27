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
        Schema::create('demmande_s', function (Blueprint $table) {
            $table->id();
            $table->string('titre_de_demmande') ;
            $table->string('description_de_demmande')->nullable() ;
            $table->string('type_demmande');
            $table->integer('status') ;
            $table->integer('dure_de_demmande') ;
            $table->date('date_de_debut') ;
            $table->date('date_de_suppression') ;
            $table->integer('id_utilisateur') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demmande_s');
    }
};
