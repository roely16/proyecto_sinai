<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno_Encargado extends Model
{
    protected $table = 'alumno_encargado';

    protected $fillable = [
      'alumno_id', 'encargado_id',
    ];

    public function alumno(){
      return $this->belongsTo('App\Alumno');
    }

    public function encargado(){
      return $this->belongsTo('App\Encargado');
    }
}
