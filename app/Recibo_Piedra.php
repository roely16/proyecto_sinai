<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo_Piedra extends Model
{
    protected $table = 'recibos_piedra';

	protected $fillable = [
		'fecha', 'total', 'alumno_id', 'serie',
	];

	public function pagos()
    {
        return $this->hasMany('App\Pago');
    }
}
