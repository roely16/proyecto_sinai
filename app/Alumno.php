<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
	 protected $table = 'alumnos';

	 protected $fillable = [
		'nombre', 'segundo_nombre', 'apellido', 'segundo_apellido', 'edad', 'telefono', 'direccion', 'grado_id', 'sede_id', 'descuento',
	 ];

	 public function grado(){
		return $this->belongsTo('App\Grado');
	 }

	 public function usuario(){
		return $this->hasOne('App\User');
	 }

	 public function sede(){
		return $this->belongsTo('App\Sede');
	 }

	 public function alumno_tareas(){
		return $this->hasMany('App\Alumno_Tarea');
	 }

	 public function alumno_encargados(){
		return $this->hasMany('App\Alumno_Encargado');
	 }

	 public function pagos()
	 {
		 return $this->hasMany('App\Pago');
	 }

	 public function reportes(){
		return $this->hasMany('App\Reporte');
	 }

	 public function pagos_alumno_canalitos(){
	 	return $this->hasMany('App\Pago_Alumno');
	 }

}
