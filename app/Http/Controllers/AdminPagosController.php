<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Grado_Pred;
use App\Pago;

class AdminPagosController extends Controller
{

	public function __construct()
    {
       	$this->middleware('auth');
    }

	public function ver_modulo(){
		return view('platform.admin_pagos.pagos')->with([
			'busqueda'	=>	false
		]);
	}

	public function buscar_grados(Request $request){

		$sede = Auth::user()->empleado->sede_id;

		if ($request->nivel == 0 && $request->jornada == 0) {
			
			//Buscar todos los grados de esa sede

			$grados = Grado_Pred::where('sede_id', '=', $sede)->orderBy('id', 'ASC')->get();

		} elseif($request->nivel != 0 && $request->jornada != 0) {
			
			//Buscar grado por nivel y por jornada

			$grados = Grado_Pred::where('sede_id', '=', $sede)->where('nivel_id', '=', $request->nivel)->where('jornada_id', '=', $request->jornada)->orderBy('id', 'ASC')->get();

		} elseif($request->nivel != 0 && $request->jornada == 0) {

			//Buscar grados en un nivel especifico y todas las jornadas
			$grados = Grado_Pred::where('sede_id', '=', $sede)->where('nivel_id', '=', $request->nivel)->orderBy('id', 'ASC')->get();

		} elseif($request->nivel == 0 && $request->jornada != 0) {

			//Buscar grados en todos los niveles y en una jornada especifica
			$grados = Grado_Pred::where('sede_id', '=', $sede)->where('jornada_id', '=', $request->jornada)->orderBy('id', 'ASC')->get();
		}

		return view('platform.admin_pagos.pagos')->with([
			'busqueda'	=>	true,
			'grados'	=>	$grados
		]);
	}

	public function ver_grado($id){

		$grado = Grado_Pred::find($id);

		$mensualidades = Pago::where('grado_pred_id', '=', $id)->where('tipo_pago_id', '=', 1)->get();

		$anualidades = Pago::where('grado_pred_id', '=', $id)->where('tipo_pago_id', '=', 2)->get();

		return view('platform.admin_pagos.ver_grado')->with([
			'grado'				=>		$grado,
			'mensualidades'		=>		$mensualidades,
			'anualidades'		=>		$anualidades
		]);
	}
}
