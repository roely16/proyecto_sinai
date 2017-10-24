<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo_Inco extends Model
{
    protected $table = 'recibos_inco';

	protected $fillable = [
		'fecha', 'total', 'alumno_id',
	];

	public function pagos()
    {
        return $this->hasMany('App\Pago');
    }
}
