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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('nomDepense');
            $table->decimal('MtDepense',10,2);
            $table->string('CategorieDepense');
            $table->bigInteger('idBoutique')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('idBoutique')->references('id')->on('boutiques')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
