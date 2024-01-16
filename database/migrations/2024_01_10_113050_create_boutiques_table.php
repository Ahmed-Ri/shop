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
        Schema::create('boutiques', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('nomBoutique');
            $table->string('adresse');
            $table->integer('telephone');
            $table->string('mail');
            $table->bigInteger('idRegistre')->unsigned()->nullable();
            $table->bigInteger('idDepense')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('idRegistre')->references('id')->on('registres')->onDelete('cascade');
            $table->foreign('idDepense')->references('id')->on('depenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boutiques');
    }
};


