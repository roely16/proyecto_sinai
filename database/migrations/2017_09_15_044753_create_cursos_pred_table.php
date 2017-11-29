<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosPredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_pred', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('grado_id')->unsigned();
            $table->foreign('grado_id')->references('id')->on('grados_pred');
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
        Schema::dropIfExists('cursos_pred');
    }
}
