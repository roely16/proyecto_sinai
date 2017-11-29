<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago_Alumno extends Model
{
	protected $table = 'pagos_alumnos_canalitos';

	protected $fillable = [
		'concepto', 'monto', 'ciclo_escolar', 'alumno_id', 'pago_id', 'recibo_id',
	];

	public function pago()
    {
        return $this->belongsTo('App\Pago');
    }

	public function recibo()
    {
        return $this->belongsTo('App\Recibo');
    }

    public function alumno(){
    	return $this->belongsTo('App\Alumno');
    }    
}
