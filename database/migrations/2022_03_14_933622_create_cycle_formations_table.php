<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCycleFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cycle_formations', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('description');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nb_jours');
            $table->integer('nb_heures');
            $table->integer('nb_places');
            $table->integer('nb_places_dispo');
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveaux')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('formateur_id');
            $table->foreign('formateur_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('cout')->nullable();
            $table->string('etat');
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
        Schema::dropIfExists('formations');
    }
}
