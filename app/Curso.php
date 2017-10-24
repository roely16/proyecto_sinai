<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
      'id', 'grado_id', 'curso_pred_id', 'maestro_id',
    ];

    public function grado(){
      return $this->belongsTo('App\Grado');
    }

    public function maestro(){
      return $this->belongsTo('App\Empleado');
    }

    public function curso_pred(){
      return $this->belongsTo('App\Curso_Pred');
    }

    public function tareas(){
      return $this->hasMany('App\Tarea');
    }

    public function videos(){
      return $this->hasMany('App\Video');
    }

    public function documentos(){
      return $this->hasMany('App\Documento');
    }
}
