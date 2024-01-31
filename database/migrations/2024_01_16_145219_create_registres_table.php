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
        Schema::create('registres', function (Blueprint $table) {
            $table->id();
            $table->string('RefCommande')->nullable();
            $table->integer('RefArticle')->nullable();
            $table->string('nomArticle')->nullable();
            $table->string('marque')->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('prixHT',10,2)->nullable();
            $table->decimal('TVA',10,2)->nullable();
            $table->decimal('prixTTC',10,2)->nullable();
            $table->decimal('MtCommandeTTC',10,2)->nullable();
            $table->integer('quantitéArticle')->nullable();
            $table->integer('QteArticleTotal')->nullable();
            $table->string('MoyenDePaiement')->nullable();
            $table->string('OrigineDeVente')->nullable();
            $table->string('categorie')->nullable();
            $table->string('SousCategorie')->nullable();
            $table->bigInteger('idArticle')->unsigned()->nullable();
            $table->bigInteger('idMontantLibre')->unsigned()->nullable();
            $table->bigInteger('idCommande')->unsigned()->nullable();
            $table->bigInteger('idBoutique')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('idArticle')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('idMontantLibre')->references('id')->on('montant_libres')->onDelete('cascade');
            $table->foreign('idCommande')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreign('idBoutique')->references('id')->on('boutiques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registres');
    }
};
