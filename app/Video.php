<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	protected $table = 'videos';

    protected $fillable = [
    	'nombre', 'url', 'curso_id',
    ];

    public function curso(){
    	return $this->belongsTo('App\Curso');
    }
}
