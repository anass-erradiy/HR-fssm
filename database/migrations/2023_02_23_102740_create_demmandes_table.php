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
        Schema::create('demmandes', function (Blueprint $table) {
            $table->id();
            $table->string('titre',50) ;
            $table->text('description')->nullable();
            $table->integer('type');
            $table->integer('status')->default(0);
            $table->date('date_D')->nullable() ;
            $table->date('date_F')->nullable() ;
            $table->string('filePath')->nullable() ;
            $table->date('date_traitement')->nullable() ;
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('titre_reponse')->nullable() ;
            $table->text('justification')->nullable() ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demmandes');
    }
};
