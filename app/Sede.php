<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sedes';

    protected $fillable = [
      'nombre',
    ];

    public function alumnos(){
      return $this->hasMany('App\Alumno');
    }

    public function grados_pred(){
      return $this->hasMany('App\Grado');
    }

    public function empleados(){
      return $this->hasMany('App\Empleado');
    }
}
