<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
      'nombre', 'segundo_nombre', 'apellido', 'segundo_apellido', 'edad', 'telefono', 'direccion', 'email', 'area_profesional', 'tipo_empleado_id', 'sede_id',
    ];

    public function tipo_empleado(){
      return $this->belongsTo('App\Tipo_empleado');
    }

    public function sede(){
      return $this->belongsTo('App\Sede');
    }

    public function usuario(){
      return $this->hasOne('App\User');
    }

    public function grado(){
      return $this->hasMany('App\Grado');
    }

    public function cursos(){
      return $this->hasMany('App\Curso');
    }
}
