<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
	protected $table = 'documentos';

    protected $fillable = [
    	'nombre', 'archivo', 'curso_id', 'nombre_archivo',
    ];

    public function curso(){
    	return $this->belongsTo('App\Curso');
    }
}
