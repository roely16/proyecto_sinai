<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago_Alumno_Piedra extends Model
{
    protected $table = 'pagos_alumnos_piedra';

	protected $fillable = [
		'concepto', 'monto', 'ciclo_escolar', 'alumno_id', 'pago_id', 'recibo_id',
	];

	public function pago()
    {
        return $this->belongsTo('App\Pago');
    }

	public function recibo()
    {
        return $this->belongsTo('App\Recibo_Piedra');
    }    
}
