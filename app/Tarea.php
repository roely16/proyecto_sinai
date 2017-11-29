<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    protected $fillable = [
      'nombre', 'descripcion', 'fecha_creacion', 'fecha_entrega', 'punteo', 'curso_id', 'bimestre',
    ];

    public function curso(){
      return $this->belongsTo('App\Curso');
    }

    public function tareas_alumno(){
      return $this->hasMany('App\Alumno_Tarea');
    }
}
