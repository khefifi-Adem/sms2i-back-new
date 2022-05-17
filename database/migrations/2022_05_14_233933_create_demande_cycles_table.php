<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_cycles', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('nb_personne');
            $table->string('message');
            $table->unsignedBigInteger('id_client_indus');
            $table->foreign('id_client_indus')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_niveau');
            $table->foreign('id_niveau')->references('id')->on('niveaux')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('demande_cycles');
    }
}
