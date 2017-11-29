<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_empleado extends Model
{
    protected $table = 'tipos_empleados';

    protected $fillable = [
      'nombre',
    ];

    public function empleados(){
      return $this->hasMany('App\Empleado');
    }
}
