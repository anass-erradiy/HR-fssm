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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->integer('som') ;
            $table->string('cin') ;
            $table->date('birthday')->nullable();
            $table->string('email',30)->unique();
            $table->string('number',14)->unique()->nullable();
            $table->string('sex',6)->nullable() ;
            $table->string('pays',20)->nullable() ;
            $table->string('region',50)->nullable() ;
            $table->integer('postalCode')->nullable() ;
            $table->string('adress')->nullable() ;
            $table->integer('admin');
            $table->enum('departement', ['MATH', 'GEO', 'INFO','CHIMIE','PHYS','BIO','HUM']);
            $table->enum('grade', ['A', 'B', 'C']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->softDeletes() ;
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
