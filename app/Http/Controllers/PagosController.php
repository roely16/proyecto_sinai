<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Alumno;
use App\Pago;
use App\Pago_Alumno;
use App\Pago_Alumno_Piedra;
use App\Pago_Alumno_Inco;
use App\Recibo;
use App\Recibo_Piedra;
use App\Recibo_Inco;

use Barryvdh\DomPDF\Facade as PDF;

class PagosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function ver_modulo_pagos(){
    	return view('platform.pagos.pagos')->with([
    		'busqueda'	=> false,
    		'termino_busqueda'	=>	'',
    		'alumnos'	=> null
    	]);
    }

    public function buscar_alumno(Request $request){

    	$usuario = Auth::user();

    	$alumnos = Alumno::where([['nombre', 'like', '%'.$request->buscar_alumno.'%'], ['sede_id', '=', $usuario->empleado->sede_id]])->paginate(5);

    	return view('platform.pagos.pagos')->with([
    		'busqueda'	=> 	true,
    		'termino_busqueda'	=> 	$request->buscar_alumno,
    		'alumnos'	=>	$alumnos
    	]);

    }

    public function generar_pago($id){

        $alumno = Alumno::find($id);

        if ($alumno->sede_id == 1) {
            $pagos_realizados = Pago_Alumno::where('alumno_id', '=', $alumno->id)->where('pago_id', '!=', null)->pluck('pago_id');    
        }elseif($alumno->sede_id == 2){

            $pagos_realizados = Pago_Alumno_Piedra::where('alumno_id', '=', $alumno->id)->where('pago_id', '!=', null)->pluck('pago_id');

        }elseif($alumno->sede_id == 3){

            $pagos_realizados = Pago_Alumno_Inco::where('alumno_id', '=', $alumno->id)->where('pago_id', '!=', null)->pluck('pago_id');
        }        

        $mensualidades = Pago::where('grado_pred_id', '=', $alumno->grado->grado_pred_id)->where('tipo_pago_id', '=', 1)->whereNotIn('id', $pagos_realizados)->get();

        $pagos_anuales = Pago::where('grado_pred_id', '=', $alumno->grado->grado_pred_id)->where('tipo_pago_id', '=', 2)->whereNotIn('id', $pagos_realizados)->get();
        

        return view('platform.pagos.generar_pago')->with([
            'alumno'    =>  $alumno,
            'mensualidades' =>  $mensualidades,
            'pagos_anuales' =>  $pagos_anuales
        ]);

    }

    public function procesar_pago(Request $request){

        $alumno_id = $request->alumno_id;

        $alumno = Alumno::find($alumno_id);

        $ciclo_escolar = $request->ciclo_escolar;

            if ($alumno->sede_id == 1) {
                
                //Se crea el recibo para Canalitos
                $recibo = new Recibo();
                $recibo->alumno_id = $alumno_id;
                $recibo->total = $request->total;
                $recibo->save();

                //Procesar todos los pagos y generar el recibo

                //Procesar Pagos Mensuales
                if (isset($request->mensualidad)) {

                    foreach ($request->mensualidad as $mensualidad) {
                        
                        //Se busca la informacion del pago
                        $pago = Pago::find($mensualidad);

                        $pago_alumno = new Pago_Alumno();

                        $concepto = $pago->nombre;

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = "Mensualidad " .$concepto;
                        $pago_alumno->monto = $pago->monto;
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->pago_id = $pago->id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();
                    }
                } 

                //Procesar Pagos Anuales
                if (isset($request->anualidad)) {

                    foreach ($request->anualidad as $anualidad) {

                        //Se busca la informacion del pago
                        $pago = Pago::find($anualidad);

                        $pago_alumno = new Pago_Alumno();

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = $pago->nombre ;
                        $pago_alumno->monto = $pago->monto;
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->pago_id = $pago->id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();

                    }
                }

                if (isset($request->concepto_otro)) {
                    
                    $i = 0;

                    foreach ($request->concepto_otro as $concepto_otro) {

                        $pago_alumno = new Pago_Alumno();

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = $concepto_otro;
                        $pago_alumno->monto = $request->monto_otro[$i];
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();

                        $i++;

                    }
                }
                
                $pagos = Pago_Alumno::where('recibo_id', '=', $recibo->id)->get();

                $pdf = PDF::loadView('platform.pdf.recibo', [
                    'recibo'    =>  $recibo,
                    'alumno'    =>  $alumno,
                    'pagos'     =>  $pagos
                ])->setPaper('letter', 'portrait')->setWarnings(false);

                return $pdf->download('recibo'.$recibo->id.'.pdf');


            }elseif($alumno->sede_id == 2){

                //Se crea el recibo para Piedra Parada
                $recibo = new Recibo_Piedra();
                $recibo->alumno_id = $alumno_id;
                $recibo->total = $request->total;
                $recibo->save();


                //Procesar Pagos Mensuales
                if (isset($request->mensualidad)) {

                    foreach ($request->mensualidad as $mensualidad) {
                        
                        //Se busca la informacion del pago
                        $pago = Pago::find($mensualidad);

                        $pago_alumno = new Pago_Alumno_Piedra();

                        $concepto = $pago->nombre;

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = "Mensualidad " .$concepto;
                        $pago_alumno->monto = $pago->monto;
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->pago_id = $pago->id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();
                    }
                } 

                //Procesar Pagos Anuales
                if (isset($request->anualidad)) {

                    foreach ($request->anualidad as $anualidad) {

                        //Se busca la informacion del pago
                        $pago = Pago::find($anualidad);

                        $pago_alumno = new Pago_Alumno_Piedra();

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = $pago->nombre ;
                        $pago_alumno->monto = $pago->monto;
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->pago_id = $pago->id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();

                    }
                }

                if (isset($request->concepto_otro)) {
                    
                    $i = 0;

                    foreach ($request->concepto_otro as $concepto_otro) {

                        $pago_alumno = new Pago_Alumno_Piedra();

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = $concepto_otro;
                        $pago_alumno->monto = $request->monto_otro[$i];
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();

                        $i++;

                    }
                }
                
                $pagos = Pago_Alumno_Piedra::where('recibo_id', '=', $recibo->id)->get();

                $pdf = PDF::loadView('platform.pdf.recibo_piedra', [
                    'recibo'    =>  $recibo,
                    'alumno'    =>  $alumno,
                    'pagos'     =>  $pagos
                ])->setPaper('letter', 'portrait')->setWarnings(false);

                return $pdf->download('recibo'.$recibo->id.'.pdf');

            }elseif($alumno->sede_id == 3){

                //Se crea el recibo para INCO
                $recibo = new Recibo_Inco();
                $recibo->alumno_id = $alumno_id;
                $recibo->total = $request->total;
                $recibo->save();

                //Procesar Pagos Mensuales
                if (isset($request->mensualidad)) {

                    foreach ($request->mensualidad as $mensualidad) {
                        
                        //Se busca la informacion del pago
                        $pago = Pago::find($mensualidad);

                        $pago_alumno = new Pago_Alumno_Inco();

                        $concepto = $pago->nombre;

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = "Mensualidad " .$concepto;
                        $pago_alumno->monto = $pago->monto;
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->pago_id = $pago->id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();
                    }
                } 

                //Procesar Pagos Anuales
                if (isset($request->anualidad)) {

                    foreach ($request->anualidad as $anualidad) {

                        //Se busca la informacion del pago
                        $pago = Pago::find($anualidad);

                        $pago_alumno = new Pago_Alumno_Inco();

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = $pago->nombre ;
                        $pago_alumno->monto = $pago->monto;
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->pago_id = $pago->id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();

                    }
                }

                if (isset($request->concepto_otro)) {
                    
                    $i = 0;

                    foreach ($request->concepto_otro as $concepto_otro) {

                        $pago_alumno = new Pago_Alumno_Inco();

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = $concepto_otro;
                        $pago_alumno->monto = $request->monto_otro[$i];
                        $pago_alumno->ciclo_escolar = $ciclo_escolar;
                        $pago_alumno->alumno_id = $alumno_id;
                        $pago_alumno->recibo_id = $recibo->id;

                        $pago_alumno->save();

                        $i++;

                    }
                }
                
                $pagos = Pago_Alumno_Inco::where('recibo_id', '=', $recibo->id)->get();

                $pdf = PDF::loadView('platform.pdf.recibo_inco', [
                    'recibo'    =>  $recibo,
                    'alumno'    =>  $alumno,
                    'pagos'     =>  $pagos
                ])->setPaper('letter', 'portrait')->setWarnings(false);

                return $pdf->download('recibo'.$recibo->id.'.pdf');

            }

    }

    public function estado_cuenta($id){

        $alumno = Alumno::find($id);

        if ($alumno->sede_id == 1) {
            
            $pagos = Pago_Alumno::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->paginate(5);

            return view('platform.pagos.estado_cuenta')->with([
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos
            ]);

        }elseif($alumno->sede_id == 2){
            $pagos = Pago_Alumno_Piedra::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->paginate(5);

            return view('platform.pagos.estado_cuenta')->with([
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos
            ]);
        }elseif($alumno->sede_id == 3){
            $pagos = Pago_Alumno_Inco::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->paginate(5);

            return view('platform.pagos.estado_cuenta')->with([
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos
            ]);
        }

    }
}
