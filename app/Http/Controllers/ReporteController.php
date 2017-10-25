<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Recibo;
use App\Recibo_Piedra;
use App\Recibo_Inco;
use Carbon\Carbon;

use App\Alumno;
use App\Grado;
use App\Pago_Alumno;
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
			$horas = Recibo::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('H');

            });
		}elseif($usuario->empleado->sede_id == 2){
			$horas = Recibo_Piedra::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('H');

            });

		}elseif($usuario->empleado->sede_id == 3){
			$horas = Recibo_Inco::whereDate('created_at', $request->dia)->orderBy('created_at', 'ASC')->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('H');

            });
		}

		return response()->json($horas);
	}

	public function reporte_mes(Request $request){

		$usuario = Auth::user();

		if ($usuario->empleado->sede_id == 1) {
			$mes = Recibo::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });

		}elseif($usuario->empleado->sede_id == 2){
			$mes = Recibo_Piedra::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });
		}elseif($usuario->empleado->sede_id == 3){
			$mes = Recibo_Inco::whereYear('created_at', $request->year)->whereMonth('created_at', $request->mes)->get()->groupBy(function($val) {
            	

            	return Carbon::parse($val->created_at)->format('d');

            });
		}

	
		return response()->json($mes);
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


		return $pdf->stream('asistencia.pdf');

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

}
