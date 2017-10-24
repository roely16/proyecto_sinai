<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->tipo_usuario_id == 1 || $user->tipo_usuario_id == 2) {
          return redirect()->route('alumnos.index');
        }elseif ($user->tipo_usuario_id == 3) {
          return redirect()->route('maestro.mis_cursos');
        }elseif ($user->tipo_usuario_id == 4) {
          return redirect()->route('encargado.mis_alumnos');
        }elseif ($user->tipo_usuario_id == 5) {
          return redirect()->route('alumno.mis_cursos');
        }

        //return view('platform.home');
    }
}
