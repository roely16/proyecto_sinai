<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo_Inco_Otro extends Model
{
    protected $table = 'recibos_inco_otros';

	protected $fillable = [
		'fecha', 'total', 'alumno_id', 'serie',
	];

	public function pagos()
    {
        return $this->hasMany('App\Pago');
    }
}
