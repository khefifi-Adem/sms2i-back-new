<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCycleFormationIndusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cycle_formation_induses', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('description');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nb_jours');
            $table->integer('nb_heures');
            $table->integer('nb_places');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_formateur');
            $table->foreign('id_formateur')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveaux')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('cout')->nullable();
            $table->string('link');
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
        Schema::dropIfExists('cycle_formation_induses');
    }
}
