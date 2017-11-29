<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    protected $table = 'tipos_usuarios';

    protected $fillable = [
      'tipos',
    ];

    public function usuarios(){
    	$this->hasMany('App\User');
    }
}
