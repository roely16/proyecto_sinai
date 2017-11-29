<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $table = 'jornadas';

    protected $fillable = [
      'nombre',
    ];

}
