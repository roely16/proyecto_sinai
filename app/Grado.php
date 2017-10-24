<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';

    protected $fillable = [
      'seccion', 'ciclo_escolar', 'jornada_id', 'maestro_id', 'grado_pred_id',
    ];

    public function alumnos(){
      return $this->hasMany('App\Alumno');
    }

    public function cursos(){
      return $this->hasMany('App\Curso');
    }

    public function jornada(){
      return $this->belongsTo('App\Jornada');
    }

    public function maestro(){
      return $this->belongsTo('App\Empleado');
    }

    public function grado_pred(){
      return $this->belongsTo('App\Grado_Pred', 'grado_pred_id');
    }

}
