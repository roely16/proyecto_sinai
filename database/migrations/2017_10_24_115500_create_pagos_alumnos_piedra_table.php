<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosAlumnosPiedraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_alumnos_piedra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('concepto');
            $table->double('monto', 6,2);
            $table->integer('ciclo_escolar');
            $table->integer('alumno_id')->unsigned();
            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->integer('pago_id')->unsigned();
            $table->foreign('pago_id')->references('id')->on('pagos');
            $table->integer('recibo_id')->unsigned();
            $table->foreign('recibo_id')->references('id')->on('recibos_piedra');
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
        Schema::dropIfExists('pagos_alumnos_piedra');
    }
}
