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
        Schema::create('montant_libres', function (Blueprint $table) {
            $table->id();
            $table->string('nomArticle')->nullable();
            $table->decimal('prixTTC')->nullable();
            $table->string('OrigineDeVente')->nullable();
            $table->string('categorie')->nullable();
            
            $table->timestamps();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('montant_libres');
    }
};
