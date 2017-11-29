<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
		protected $table = 'encargados';

		protected $fillable = [
			'nombre', 'segundo_nombre', 'apellido', 'segundo_apellido', 'telefono', 'direccion', 'email', 'sede_id',
		];

		public function usuario(){
			return $this->hasOne('App\User');
		}

		public function encargado_alumnos(){
			return $this->hasMany('App\Alumno_Encargado');
		}

		public function sede(){
			return $this->belongsTo('App\Sede');
		}
}
