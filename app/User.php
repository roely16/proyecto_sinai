<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'usuarios';

    protected $fillable = [
        'usuario', 'password', 'tipo_usuario_id', 'alumno_id', 'empleado_id', 'encargado_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function empleado(){
      return $this->belongsTo('App\Empleado');
    }

    public function encargado(){
      return $this->belongsTo('App\Encargado');
    }

    public function alumno(){
      return $this->belongsTo('App\Alumno');
    }

    public function tipo_usuario(){
        return $this->belongsTo('App\Tipo_usuario');
    }
}
