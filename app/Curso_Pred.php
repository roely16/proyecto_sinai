<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso_Pred extends Model
{
    protected $table = 'cursos_pred';

    protected $fillable = [
      'nombre', 'grado_id',
    ];

    public function grado(){
      return $this->belongsTo('App\Grado_Pred');
    }

    public function cursos(){
      return $this->hasMany('App\Curso');
    }
}
