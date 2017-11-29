<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario')->unique();
            $table->string('password');
            $table->integer('tipo_usuario_id')->unsigned();
            $table->foreign('tipo_usuario_id')->references('id')->on('tipos_usuarios');
            $table->integer('alumno_id')->unsigned()->nullable();
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->integer('encargado_id')->unsigned()->nullable();
            $table->foreign('encargado_id')->references('id')->on('encargados')->onDelete('cascade');
            $table->string('remember_token', 100)->nullable();
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
        Schema::dropIfExists('usuarios');
    }
}
