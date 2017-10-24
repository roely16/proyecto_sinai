<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->double('monto', 6, 2)->nullable();
            $table->integer('grado_pred_id')->unsigned()->nullable();
            $table->foreign('grado_pred_id')->references('id')->on('grados_pred');
            $table->integer('tipo_pago_id')->unsigned();
            $table->foreign('tipo_pago_id')->references('id')->on('tipos_pagos');
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
        Schema::dropIfExists('pagos');
    }
}
