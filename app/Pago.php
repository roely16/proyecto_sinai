<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
	protected $table = 'pagos';

	protected $fillable = [
		'nombre', 'monto', 'grado_pred_id', 'tipo_pago_id',
	];

	public function tipo_pago()
    {
        return $this->belongsTo('App\Tipo_Pago');
    }

    public function grado_pred()
    {
        return $this->belongsTo('App\Grado_Pred');
    }

    public function pagos_alumnos()
    {
        return $this->hasMany('App\Pago_Alumno');
    }
}
