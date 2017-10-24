<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno_Tarea extends Model
{
    protected $table = 'alumno_tarea';

    protected $fillable = [
      'calificacion', 'archivo', 'alumno_id', 'tarea_id', 'observaciones', 'nombre_archivo',
    ];

    public function tarea(){
      return $this->belongsTo('App\Tarea');
    }

    public function alumno(){
      return $this->belongsTo('App\Alumno');
    }
}
