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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nomArticle');
            $table->text('designation');
            $table->string('photo');
            $table->string('marque');
            $table->integer('stock')->unsigned();
            $table->decimal('prixHT');
            $table->integer('TVA');
            $table->decimal('prixTTC');
            $table->string('slug')->unique();
            $table->bigInteger('idSousCategorie')->unsigned();
            $table->timestamps();

            $table->foreign('idSousCategorie')->references('id')->on('sous_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
