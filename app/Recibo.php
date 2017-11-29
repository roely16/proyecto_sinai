<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = 'recibos_canalitos';

	protected $fillable = [
		'fecha', 'total', 'alumno_id', 'serie',
	];

	public function pagos()
    {
        return $this->hasMany('App\Pago');
    }
}
