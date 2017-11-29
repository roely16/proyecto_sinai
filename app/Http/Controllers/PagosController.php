<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Alumno;
use App\Pago;
use App\Pago_Alumno;
use App\Pago_Alumno_Otro;
use App\Pago_Alumno_Piedra;
use App\Pago_Alumno_Piedra_Otro;
use App\Pago_Alumno_Inco;
use App\Pago_Alumno_Inco_Otro;
use App\Recibo;
use App\Recibo_Otro;
use App\Recibo_Piedra;
use App\Recibo_Piedra_Otro;
use App\Recibo_Inco;
use App\Recibo_Inco_Otro;

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
        
        if ($alumno->descuento != 0) {
            foreach ($mensualidades as $mensualidad) {
                $mensualidad->monto = $mensualidad->monto - ($mensualidad->monto * ($alumno->descuento / 100));
            }
        }

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

                        list($id_mensualidad,$monto) = explode('|', $mensualidad);

                        //Se busca la informacion del pago
                        $pago = Pago::find($id_mensualidad);

                        $pago_alumno = new Pago_Alumno();

                        $concepto = $pago->nombre;

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = "Mensualidad " .$concepto;
                        $pago_alumno->monto = $monto;
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
<<<<<<< HEAD

                //Procesar moras
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

=======
>>>>>>> fafc38926884afa2e178209e8ccb5cd0855e0d7b
                
                $pagos = Pago_Alumno::where('recibo_id', '=', $recibo->id)->get();

                $pdf = PDF::loadView('platform.pdf.recibo', [
                    'recibo'    =>  $recibo,
                    'alumno'    =>  $alumno,
                    'pagos'     =>  $pagos
                ])->setPaper('letter', 'portrait')->setWarnings(false);

<<<<<<< HEAD
                return $pdf->download('Recibo A-'.$recibo->id.'.pdf');
=======
                return $pdf->download('recibo A-'.$recibo->id.'.pdf');
>>>>>>> fafc38926884afa2e178209e8ccb5cd0855e0d7b


            }elseif($alumno->sede_id == 2){

                //Se crea el recibo para Piedra Parada
                $recibo = new Recibo_Piedra();
                $recibo->alumno_id = $alumno_id;
                $recibo->total = $request->total;
                $recibo->save();


                //Procesar Pagos Mensuales
                if (isset($request->mensualidad)) {

                    foreach ($request->mensualidad as $mensualidad) {
                        
                        list($id_mensualidad,$monto) = explode('|', $mensualidad);

                        //Se busca la informacion del pago
                        $pago = Pago::find($id_mensualidad);

                        $pago_alumno = new Pago_Alumno_Piedra();

                        $concepto = $pago->nombre;

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = "Mensualidad " .$concepto;
                        $pago_alumno->monto = $monto;
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
<<<<<<< HEAD

                //Procesar moras
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
=======
>>>>>>> fafc38926884afa2e178209e8ccb5cd0855e0d7b
                
                $pagos = Pago_Alumno_Piedra::where('recibo_id', '=', $recibo->id)->get();

                $pdf = PDF::loadView('platform.pdf.recibo_piedra', [
                    'recibo'    =>  $recibo,
                    'alumno'    =>  $alumno,
                    'pagos'     =>  $pagos
                ])->setPaper('letter', 'portrait')->setWarnings(false);

<<<<<<< HEAD
                return $pdf->download('Recibo A-'.$recibo->id.'.pdf');
=======
                return $pdf->download('recibo A-'.$recibo->id.'.pdf');
>>>>>>> fafc38926884afa2e178209e8ccb5cd0855e0d7b

            }elseif($alumno->sede_id == 3){

                //Se crea el recibo para INCO
                $recibo = new Recibo_Inco();
                $recibo->alumno_id = $alumno_id;
                $recibo->total = $request->total;
                $recibo->save();

                //Procesar Pagos Mensuales
                if (isset($request->mensualidad)) {

                    foreach ($request->mensualidad as $mensualidad) {

                        list($id_mensualidad,$monto) = explode('|', $mensualidad);
                        
                        //Se busca la informacion del pago
                        $pago = Pago::find($id_mensualidad);

                        $pago_alumno = new Pago_Alumno_Inco();

                        $concepto = $pago->nombre;

                        //Se registra la informacion del pago
                        $pago_alumno->concepto = "Mensualidad " .$concepto;
                        $pago_alumno->monto = $monto;
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
                
                $pagos = Pago_Alumno_Inco::where('recibo_id', '=', $recibo->id)->get();

                $pdf = PDF::loadView('platform.pdf.recibo_inco', [
                    'recibo'    =>  $recibo,
                    'alumno'    =>  $alumno,
                    'pagos'     =>  $pagos
                ])->setPaper('letter', 'portrait')->setWarnings(false);

                return $pdf->download('recibo A-'.$recibo->id.'.pdf');

            }

    }

    public function procesar_pago_otro(Request $request){

        $alumno_id = $request->alumno_id;

<<<<<<< HEAD
                //Procesar moras
                if (isset($request->concepto_otro)) {
=======
        $alumno = Alumno::find($alumno_id);

        $ciclo_escolar = $request->ciclo_escolar;

        if ($alumno->sede_id == 1) {

            //Crear recibo
            $recibo = new Recibo_Otro();
            $recibo->alumno_id = $alumno_id;
            $recibo->total = $request->total;
            $recibo->save();   

            if (isset($request->concepto_otro)) {
>>>>>>> fafc38926884afa2e178209e8ccb5cd0855e0d7b
                    
                $i = 0;

                foreach ($request->concepto_otro as $concepto_otro) {

                    $pago_alumno = new Pago_Alumno_Otro();

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

<<<<<<< HEAD
                        $i++;
                    }
=======
            $pagos = Pago_Alumno_Otro::where('recibo_id', '=', $recibo->id)->get();

            $pdf = PDF::loadView('platform.pdf.recibo_otro', [
                'recibo'    =>  $recibo,
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos
            ])->setPaper('letter', 'portrait')->setWarnings(false);

            return $pdf->download('recibo B-'.$recibo->id.'.pdf');


        }elseif($alumno->sede_id == 2){

            //Crear recibo Piedra
            $recibo = new Recibo_Piedra_Otro();
            $recibo->alumno_id = $alumno_id;
            $recibo->total = $request->total;
            $recibo->save();   

            if (isset($request->concepto_otro)) {
                    
                $i = 0;

                foreach ($request->concepto_otro as $concepto_otro) {

                    $pago_alumno = new Pago_Alumno_Piedra_Otro();

                    //Se registra la informacion del pago
                    $pago_alumno->concepto = $concepto_otro;
                    $pago_alumno->monto = $request->monto_otro[$i];
                    $pago_alumno->ciclo_escolar = $ciclo_escolar;
                    $pago_alumno->alumno_id = $alumno_id;
                    $pago_alumno->recibo_id = $recibo->id;

                    $pago_alumno->save();

                    $i++;
>>>>>>> fafc38926884afa2e178209e8ccb5cd0855e0d7b
                }
            }

            $pagos = Pago_Alumno_Piedra_Otro::where('recibo_id', '=', $recibo->id)->get();

            $pdf = PDF::loadView('platform.pdf.recibo_piedra_otro', [
                'recibo'    =>  $recibo,
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos
            ])->setPaper('letter', 'portrait')->setWarnings(false);

            return $pdf->download('recibo B-'.$recibo->id.'.pdf');

        }elseif($alumno->sede_id == 3){

            //Crear recibo INCO
            $recibo = new Recibo_Inco_Otro();
            $recibo->alumno_id = $alumno_id;
            $recibo->total = $request->total;
            $recibo->save();   

            if (isset($request->concepto_otro)) {
                    
                $i = 0;

                foreach ($request->concepto_otro as $concepto_otro) {

                    $pago_alumno = new Pago_Alumno_Inco_Otro();

<<<<<<< HEAD
                return $pdf->download('Recibo A-'.$recibo->id.'.pdf');

            }

    }

    public function procesar_pago_otro(Request $request){

        $alumno_id = $request->alumno_id;

        $alumno = Alumno::find($alumno_id);

        $ciclo_escolar = $request->ciclo_escolar;

        if ($alumno->sede_id == 1) {

            //Crear recibo
            $recibo = new Recibo_Otro();
            $recibo->alumno_id = $alumno_id;
            $recibo->total = $request->total;
            $recibo->save();   

            if (isset($request->concepto_otro)) {
                    
                $i = 0;

                foreach ($request->concepto_otro as $concepto_otro) {

                    $pago_alumno = new Pago_Alumno_Otro();

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

            $pagos = Pago_Alumno_Otro::where('recibo_id', '=', $recibo->id)->get();

            $pdf = PDF::loadView('platform.pdf.recibo_otro', [
                'recibo'    =>  $recibo,
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos
            ])->setPaper('letter', 'portrait')->setWarnings(false);

            return $pdf->download('Recibo O-'.$recibo->id.'.pdf');


        }elseif($alumno->sede_id == 2){

            //Crear recibo Piedra
            $recibo = new Recibo_Piedra_Otro();
            $recibo->alumno_id = $alumno_id;
            $recibo->total = $request->total;
            $recibo->save();   

            if (isset($request->concepto_otro)) {
                    
                $i = 0;

                foreach ($request->concepto_otro as $concepto_otro) {

                    $pago_alumno = new Pago_Alumno_Piedra_Otro();

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

            $pagos = Pago_Alumno_Piedra_Otro::where('recibo_id', '=', $recibo->id)->get();

            $pdf = PDF::loadView('platform.pdf.recibo_piedra_otro', [
                'recibo'    =>  $recibo,
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos
            ])->setPaper('letter', 'portrait')->setWarnings(false);

            return $pdf->download('Recibo O-'.$recibo->id.'.pdf');

        }elseif($alumno->sede_id == 3){

            //Crear recibo INCO
            $recibo = new Recibo_Inco_Otro();
            $recibo->alumno_id = $alumno_id;
            $recibo->total = $request->total;
            $recibo->save();   

            if (isset($request->concepto_otro)) {
                    
                $i = 0;

                foreach ($request->concepto_otro as $concepto_otro) {

                    $pago_alumno = new Pago_Alumno_Inco_Otro();

=======
>>>>>>> fafc38926884afa2e178209e8ccb5cd0855e0d7b
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

            $pagos = Pago_Alumno_Inco_Otro::where('recibo_id', '=', $recibo->id)->get();

            $pdf = PDF::loadView('platform.pdf.recibo_inco_otro', [
                'recibo'    =>  $recibo,
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos
            ])->setPaper('letter', 'portrait')->setWarnings(false);

<<<<<<< HEAD
            return $pdf->download('Recibo O-'.$recibo->id.'.pdf');
=======
            return $pdf->download('recibo B-'.$recibo->id.'.pdf');
>>>>>>> fafc38926884afa2e178209e8ccb5cd0855e0d7b

        }

    }

    public function estado_cuenta($id){

        $alumno = Alumno::find($id);

        if ($alumno->sede_id == 1) {
            
            $pagos = Pago_Alumno::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

            $pagos_ = Pago_Alumno_Otro::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

            return view('platform.pagos.estado_cuenta')->with([
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos,
                'pagos_'    =>  $pagos_
            ]);

        }elseif($alumno->sede_id == 2){
            $pagos = Pago_Alumno_Piedra::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

            $pagos_ = Pago_Alumno_Piedra_Otro::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

            return view('platform.pagos.estado_cuenta')->with([
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos,
                'pagos_'    =>  $pagos_
            ]);
        }elseif($alumno->sede_id == 3){
            $pagos = Pago_Alumno_Inco::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();

            $pagos_ = Pago_Alumno_Inco_Otro::where('alumno_id', '=', $alumno->id)->orderBy('id', 'DESC')->get();            
            return view('platform.pagos.estado_cuenta')->with([
                'alumno'    =>  $alumno,
                'pagos'     =>  $pagos,
                'pagos_'    =>  $pagos_

            ]);
        }

    }

    public function cambiar_valor_pago($id_pago, $valor){

        $pago = Pago::find($id_pago);
        $pago->monto = $valor;
        $pago->save();

        return $pago;

    }

    public function eliminar_pago($id, $alumno_id){

        $usuario = Auth::user();

        if ($usuario->empleado->sede_id == 1) {

            $pago = Pago_Alumno::find($id);

            $recibo = Recibo::find($pago->recibo_id);
            $recibo->total = $recibo->total - $pago->monto;
            $recibo->save();

            $pago->delete();

        }elseif($usuario->empleado->sede_id == 2){

            $pago = Pago_Alumno_Piedra::find($id);

            $recibo = Recibo_Piedra::find($pago->recibo_id);
            $recibo->total = $recibo->total - $pago->monto;
            $recibo->save();

            $pago->delete();

        }elseif($usuario->empleado->sede_id == 3){

            $pago = Pago_Alumno_Inco::find($id);

            $recibo = Recibo_Inco::find($pago->recibo_id);
            $recibo->total = $recibo->total - $pago->monto;
            $recibo->save();

            $pago->delete();
        }

        

        return redirect()->route('pagos.estado_cuenta', $alumno_id);

    }


    public function eliminar_pago_otro($id, $alumno_id){

        $usuario = Auth::user();

        if ($usuario->empleado->sede_id == 1) {

            $pago = Pago_Alumno_Otro::find($id);

            $recibo = Recibo_Otro::find($pago->recibo_id);
            $recibo->total = $recibo->total - $pago->monto;
            $recibo->save();

            $pago->delete();

        }elseif($usuario->empleado->sede_id == 2){

            $pago = Pago_Alumno_Piedra_Otro::find($id);

            $recibo = Recibo_Piedra_Otro::find($pago->recibo_id);
            $recibo->total = $recibo->total - $pago->monto;
            $recibo->save();

            $pago->delete();

        }elseif($usuario->empleado->sede_id == 3){

            $pago = Pago_Alumno_Inco_Otro::find($id);

            $recibo = Recibo_Inco_Otro::find($pago->recibo_id);
            $recibo->total = $recibo->total - $pago->monto;
            $recibo->save();

            $pago->delete();

        }

        return redirect()->route('pagos.estado_cuenta', $alumno_id);

    }
}
