<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado_Pred extends Model
{
    protected $table = 'grados_pred';

    protected $fillable = [
      'nombre', 'nivel_id', 'sede_id', 'jornada_id',
    ];

    public function nivel(){
      return $this->belongsTo('App\Nivel');
    }

    public function jornada(){
      return $this->belongsTo('App\Jornada');
    }

    public function grados(){
      return $this->hasMany('App\Grado', 'grado_pred_id');
    }

    public function cursos(){
      return $this->hasMany('App\Curso_Pred');
    }

    public function sede(){
      return $this->belongsTo('App\Sede');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

}
