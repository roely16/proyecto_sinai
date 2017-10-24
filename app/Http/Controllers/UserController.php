<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Empleado;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{
		$usuario = Auth::user();
	
		$users = 	User::whereHas('empleado', function ($query) use ($usuario){
    					$query->where('sede_id', '=', $usuario->empleado->sede_id);
					});

		$encargados = 	User::whereHas('encargado', function ($query) use ($usuario){
    						$query->where('sede_id', '=', $usuario->empleado->sede_id);
						});

		$alumnos = User::whereHas('alumno', function ($query) use ($usuario){
    					$query->where('sede_id', '=', $usuario->empleado->sede_id);
					})->union($users)->union($encargados)->get();

		return view('platform.usuarios')->with([
		  'usuarios'  =>  $alumnos,
		  'busqueda'  =>  false
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		$user->password = bcrypt($user->usuario);

		$user->save();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
	  $user = User::find($id);

	  if (Hash::check($request->clave_actual, $user->password))
	  {
		if($request->clave_nueva1 == $request->clave_nueva2){

		  //Actualizar password
		  $user->password = bcrypt($request->clave_nueva2);
		  $user->save();

		  Auth::logout();

		}else{
		}
	  }else {
	  }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}

	public function buscar_usuario(Request $request){

		$usuarios = User::where('usuario', 'like', '%'.$request->buscar_usuario.'%')->get();

		$usuario = Auth::user();

		return view('platform.usuarios')->with([
		  'usuarios'  => $usuarios,
		  'busqueda'  => true
		]);

	}
}
