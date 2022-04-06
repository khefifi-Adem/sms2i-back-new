<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table-> string('title');
            $table->string('description');
            $table->string('image');
            $table->unsignedBigInteger('id_soc');
            $table->foreign('id_soc')->references('id')->on('groupe_sms2is')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_client_indus');
            $table->foreign('id_client_indus')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_domaine_indus');
            $table->foreign('id_domaine_indus')->references('id')->on('domaine_induses')->onUpdate('cascade')->onDelete('cascade');


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
        Schema::dropIfExists('projects');
    }
}
