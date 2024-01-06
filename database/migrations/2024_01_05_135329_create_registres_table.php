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
            $table->string('nomArticle');
            $table->text('designation')->nullable();
            $table->string('image')->nullable();
            $table->string('marque')->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('prixHT')->nullable();
            $table->integer('TVA')->nullable();
            $table->decimal('prixTTC')->nullable();
            $table->decimal('MtCommandeTTC')->nullable();
            $table->integer('quantitéArticle')->nullable();
            $table->integer('QteArticleTotal')->nullable();
            $table->string('MoyenDePaiement')->nullable();
            $table->string('OrigineDeVente')->nullable();
            $table->string('categorie')->nullable();
            $table->string('SousCategorie')->nullable();
            $table->bigInteger('idArticle')->unsigned()->nullable();
            $table->bigInteger('idMontantLibre')->unsigned()->nullable();
            $table->bigInteger('idCommande')->unsigned();
            $table->timestamps();

            $table->foreign('idArticle')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('idMontantLibre')->references('id')->on('montant_libres')->onDelete('cascade');
            $table->foreign('idCommande')->references('id')->on('commandes')->onDelete('cascade');

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
