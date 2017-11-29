<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo_Otro extends Model
{
	protected $table = 'recibos_canalitos_otros';

	protected $fillable = [
		'fecha', 'total', 'alumno_id', 'serie',
	];

	public function pagos()
    {
        return $this->hasMany('App\Pago');
    }
}
