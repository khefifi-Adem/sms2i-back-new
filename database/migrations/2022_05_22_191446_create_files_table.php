<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->unsignedBigInteger('id_cycle')->nullable();
            $table->foreign('id_cycle')->references('id')->on('cycle_formations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_induses')->nullable();
            $table->foreign('id_induses')->references('id')->on('cycle_formation_induses')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('files');
    }
}
