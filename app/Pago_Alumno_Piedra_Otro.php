<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago_Alumno_Piedra_Otro extends Model
{
    protected $table = 'pagos_alumnos_piedra_otro';

	protected $fillable = [
		'concepto', 'monto', 'ciclo_escolar', 'alumno_id', 'pago_id', 'recibo_id',
	];

	public function pago()
    {
        return $this->belongsTo('App\Pago');
    }

	public function recibo()
    {
        return $this->belongsTo('App\Recibo_Piedra_Otro');
    }

    public function alumno(){
    	return $this->belongsTo('App\Alumno');
    }
}
