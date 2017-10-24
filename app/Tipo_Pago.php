<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Pago extends Model
{
	protected $table = 'tipos_pagos';

	protected $fillable = [
		'nombre',
	];

	public function pagos()
    {
        return $this->hasMany('App\Pago');
    }
}
