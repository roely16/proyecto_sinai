<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradosPredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados_pred', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('nivel_id')->unsigned();
            $table->foreign('nivel_id')->references('id')->on('niveles');
            $table->integer('sede_id')->unsigned();
            $table->foreign('sede_id')->references('id')->on('sedes');
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
        Schema::dropIfExists('grados_pred');
    }
}
