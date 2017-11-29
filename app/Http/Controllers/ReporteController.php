<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Recibo;
use App\Recibo_Otro;
use App\Recibo_Piedra;
use App\Recibo_Piedra_Otro;
use App\Recibo_Inco;
use App\Recibo_Inco_Otro;
use Carbon\Carbon;

use App\Alumno;
use App\Grado;
use App\Pago_Alumno;
use App\Pago_Alumno_Otro;
use App\Pago_Alumno_Inco;
use App\Pago_Alumno_Inco_Otro;
use App\Pago_Alumno_Piedra;
use App\Pago_Alumno_Piedra_Otro;

use Barryvdh\DomPDF\Facade as PDF;

class ReporteController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function ver_modulo(){

		$usuario = Auth::user();

		$grados = DB::table('grados_pred')
			->join('grados', function ($join) use ($usuario){
					$join->on('grados.grado_pred_id', '=', 'grados_pred.id')
							 ->where('grados_pred.sede_id', '=', $usuario->empleado->sede_id);
			})->orderBy('grados.ciclo_escolar', 'DESC')->get();

		return view('platform.reportes.modulo_reportes')->with([
			'grados'	=>	$grados
		]);

	}

	public function reporte_dia(Request $request){

		$usuario = Auth::user();

		if ($usuario->empleado->sede_id == 1) {

			$horas_otro = Recibo_Otro::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	
            	return Carbon::parse($val->created_at)->format('H');

            });
						

			$horas = Recibo::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	
            	return Carbon::parse($val->created_at)->format('H');

            });


		}elseif($usuario->empleado->sede_id == 2){
			
			$horas = Recibo_Piedra::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	
            	return Carbon::parse($val->created_at)->format('H');

            });

            $horas_otro = Recibo_Piedra_Otro::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	
            	return Carbon::parse($val->created_at)->format('H');

            });


		}elseif($usuario->empleado->sede_id == 3){
			
			$horas = Recibo_Inco::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	
            	return Carbon::parse($val->created_at)->format('H');

            });

            $horas_otro = Recibo_Inco_Otro::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('H');

            });

		}

		$todos = $horas->concat($horas_otro);

		return response()->json($todos);
	}

	public function reporte_mes(Request $request){

		$usuario = Auth::user();

		if ($usuario->empleado->sede_id == 1) {
			
			$mes = Recibo::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });

            $mes_ = Recibo_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });


		}elseif($usuario->empleado->sede_id == 2){
			
			$mes = Recibo_Piedra::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });

            $mes_ = Recibo_Piedra_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });


		}elseif($usuario->empleado->sede_id == 3){
			
			$mes = Recibo_Inco::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });

            $mes_ = Recibo_Inco_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });

		}

		$todos = $mes->concat($mes_);
	
		return response()->json($todos);
	}

	public function hoja_asistencia(Request $request){

		$usuario = Auth::user();

		$alumnos = Alumno::where('grado_id', '=', $request->grado_id)->orderBy('id', 'ASC')->get();

		$grado = Grado::find($request->grado_id);

		$pdf = PDF::loadView('platform.pdf.asistencia', [
			'alumnos'	=>	$alumnos,
			'mes'		=>	$request->mes,
			'year'		=>	$request->year,
			'grado'		=>	$grado,
			'sede_id'	=>	$usuario->empleado->sede_id
		])->setPaper('letter', 'landscape')->setWarnings(false);


		return $pdf->download('asistencia.pdf');

	}

	public function alumnos_solventes(Request $request){

		$usuario = Auth::user();

		$grado = Grado::find($request->grado_id);
		

		if ($usuario->empleado->sede_id == 1) {

			$alumnos = Alumno::where('grado_id', '=', $request->grado_id)->orderBy('id', 'ASC')->with('pagos_alumno_canalitos')->get();	
		}

		dd($alumnos);

		$grado = Grado::find($request->grado_id);

		$pdf = PDF::loadView('platform.pdf.informe_solvencia', [
			'alumnos'	=>	$alumnos,
			'mes'		=>	$request->mes,
			'year'		=>	$request->year,
			'grado'		=>	$grado,
			'sede_id'	=>	$usuario->empleado->sede_id
		])->setPaper('letter', 'landscape')->setWarnings(false);


		return $pdf->stream('informe_solvencia.pdf');

	}

	public function detalles_reporte_dia(Request $request){

		$usuario = Auth::user();

		if ($usuario->empleado->sede_id == 1) {

			$pagos = Pago_Alumno::whereDate('created_at', $request->fecha_dia)->orderBy('id', 'ASC')->get();

			$pagos_ = Pago_Alumno_Otro::whereDate('created_at', $request->fecha_dia)->orderBy('id', 'ASC')->get();

		}elseif($usuario->empleado->sede_id == 2){
			
			$pagos = Pago_Alumno_Piedra::whereDate('created_at', $request->fecha_dia)->orderBy('id', 'ASC')->get();

			$pagos_ = Pago_Alumno_Piedra_Otro::whereDate('created_at', $request->fecha_dia)->orderBy('id', 'ASC')->get();

		}elseif($usuario->empleado->sede_id == 3){
			
			$pagos = Pago_Alumno_Inco::whereDate('created_at', $request->fecha_dia)->orderBy('id', 'ASC')->get();

			$pagos_ = Pago_Alumno_Inco_Otro::whereDate('created_at', $request->fecha_dia)->orderBy('id', 'ASC')->get();

		}

		return view('platform.reportes.detalles_ingresos')->with([
			'fecha_reporte'	=>	$request->fecha_dia,
			'mes'			=>	'',
			'year'			=>	'',
			'pagos'			=>	$pagos,
			'otros_pagos'	=>	$pagos_,
			'tipo'			=>	'dia'
		]);
	}

	public function detalles_reporte_mes(Request $request){

		$usuario = Auth::user();

		if ($usuario->empleado->sede_id == 1) {

			$pagos = Pago_Alumno::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

			$pagos_ = Pago_Alumno_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

		}elseif($usuario->empleado->sede_id == 2){
			
			$pagos = Pago_Alumno_Piedra::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

			$pagos_ = Pago_Alumno_Piedra_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

		}elseif($usuario->empleado->sede_id == 3){
			
			$pagos = Pago_Alumno_Inco::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

			$pagos_ = Pago_Alumno_Inco_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

		}

		return view('platform.reportes.detalles_ingresos')->with([
			'fecha_reporte'	=>	$request->mes."/".$request->year,
			'mes'			=>	$request->mes,
			'year'			=>	$request->year,
			'pagos'			=>	$pagos,
			'otros_pagos'	=>	$pagos_,
			'tipo'			=>	'mes'
		]);

	}

	public function imprimir_reporte(Request $request){

		$usuario = Auth::user();

		if ($request->tipo == 'dia') {

			if ($usuario->empleado->sede_id == 1) {

				$pagos = Pago_Alumno::whereDate('created_at', $request->fecha)->orderBy('id', 'ASC')->get();

				$pagos_ = Pago_Alumno_Otro::whereDate('created_at', $request->fecha)->orderBy('id', 'ASC')->get();

			}elseif($usuario->empleado->sede_id == 2){
				
				$pagos = Pago_Alumno_Piedra::whereDate('created_at', $request->fecha)->orderBy('id', 'ASC')->get();

				$pagos_ = Pago_Alumno_Piedra_Otro::whereDate('created_at', $request->fecha)->orderBy('id', 'ASC')->get();

			}elseif($usuario->empleado->sede_id == 3){
				
				$pagos = Pago_Alumno_Inco::whereDate('created_at', $request->fecha)->orderBy('id', 'ASC')->get();

				$pagos_ = Pago_Alumno_Inco_Otro::whereDate('created_at', $request->fecha)->orderBy('id', 'ASC')->get();

			}

			$todos_pagos = $pagos->concat($pagos_);
			$total = $todos_pagos->sum('monto');

		}elseif($request->tipo == 'mes'){

			if ($usuario->empleado->sede_id == 1) {

			$pagos = Pago_Alumno::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

			$pagos_ = Pago_Alumno_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

			}elseif($usuario->empleado->sede_id == 2){
				
				$pagos = Pago_Alumno_Piedra::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

				$pagos_ = Pago_Alumno_Piedra_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

			}elseif($usuario->empleado->sede_id == 3){
				
				$pagos = Pago_Alumno_Inco::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

				$pagos_ = Pago_Alumno_Inco_Otro::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->orderBy('id', 'ASC')->get();

			}

			$todos_pagos = $pagos->concat($pagos_);
			$total = $todos_pagos->sum('monto');

		}

		$pdf = PDF::loadView('platform.pdf.reporte_ingresos', [
                'pagos'    	=>  $todos_pagos,
                'fecha'		=>	$request->fecha,
                'total'		=>	$total
            ])->setPaper('letter', 'landscape')->setWarnings(false);

        return $pdf->download('Reporte de Ingresos - '.$request->fecha.'.pdf');
       		

	}

}
