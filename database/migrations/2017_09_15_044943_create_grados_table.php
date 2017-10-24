<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seccion');
            $table->integer('ciclo_escolar');
            $table->integer('jornada_id')->unsigned();
            $table->foreign('jornada_id')->references('id')->on('jornadas');
            $table->integer('maestro_id')->unsigned()->nullable();
            $table->foreign('maestro_id')->references('id')->on('empleados')->onDelete('set null');
            $table->integer('grado_pred_id')->unsigned();
            $table->foreign('grado_pred_id')->references('id')->on('grados_pred');
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
        Schema::dropIfExists('grados');
    }
}
