<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('edition');
            $table->string('description');
            $table->string('image_path');
            $table->unsignedBigInteger('id_marque');
            $table->foreign('id_marque')->references('id')->on('marques')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_categorie_utilisation');
            $table->foreign('id_categorie_utilisation')->references('id')->on('categorie_utilisations')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
