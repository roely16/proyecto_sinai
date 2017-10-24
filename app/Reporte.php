<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';

	protected $fillable = [
		'asunto', 'mensaje', 'empleado_id', 'alumno_id',
	];

	public function alumno()
    {
        return $this->belongsTo('App\Alumno');
    }

    public function empleado(){
    	return $this->belongsTo('App\Empleado');
    }
}
