<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Alumno_Encargado;
use App\Reporte;
use App\Alumno;
use App\Pago_Alumno;
use App\Pago_Alumno_Otro;
use App\Pago_Alumno_Piedra;
use App\Pago_Alumno_Piedra_Otro;
use App\Pago_Alumno_Inco;
use App\Pago_Alumno_Inco_Otro;
use App\Pago;

class PerfilEncargadoController extends Controller
{
		public function __construct()
		{
				$this->middleware('auth');
		}
		
		public function mis_alumnos(){

			$encargado = Auth::user();

			$alumnos = Alumno_Encargado::where('encargado_id', '=', $encargado->encargado_id)->get();


			return view('platform.encargado.mis_alumnos')->with([
				'alumnos'   =>  $alumnos
			]);
		}

		public function detalle_alumno($id){

			$reportes = Reporte::where('alumno_id', '=', $id)->get();

			$alumno = Alumno::find($id);

			if ($alumno->sede_id == 1) {
            
            	$pagos = Pago_Alumno::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

            	$otros_pagos = Pago_Alumno_Otro::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

            	$pagos_realizados = Pago_Alumno::where('alumno_id', '=', $alumno->id)->where('pago_id', '!=', null)->pluck('pago_id');

	        }elseif($alumno->sede_id == 2){
	            
	            $pagos = Pago_Alumno_Piedra::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

	        }elseif($alumno->sede_id == 3){
	            
	            $pagos = Pago_Alumno_Inco::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

	        }

	        $mensualidades = Pago::where('grado_pred_id', '=', $alumno->grado->grado_pred_id)->where('tipo_pago_id', '=', 1)->whereNotIn('id', $pagos_realizados)->get();

        	$pagos_anuales = Pago::where('grado_pred_id', '=', $alumno->grado->grado_pred_id)->where('tipo_pago_id', '=', 2)->whereNotIn('id', $pagos_realizados)->get();

			return view('platform.encargado.detalle_alumno')->with([

				'alumno'		=>		$alumno,
				'reportes'		=>		$reportes,
				'mensualidades'	=>		$mensualidades,
				'pagos_anuales'	=>		$pagos_anuales,
				'pagos_realizados'	=>	$pagos,
				'otros_pagos'	=>		$otros_pagos

			]);
		}
}
