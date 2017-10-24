<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Encargado;
use App\Alumno_Encargado;
use App\User;
use App\Reporte;

class EncargadosController extends Controller
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
        //
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
        $encargado = new Encargado($request->all());
        $encargado->save();

        $alumno_encargado = new Alumno_Encargado();
        $alumno_encargado->alumno_id = $request->alumno_id;
        $alumno_encargado->encargado_id = $encargado->id;
        $alumno_encargado->save();

        //Crear usuario para el colaborador registrado
        $usuario = strtolower(substr($encargado->nombre, 0, 1)) . strtolower ($encargado->apellido);
        $usuario_o = $usuario;

        $nuevo_usuario = new User();
        $usuario_creado = false;
        $contador = 1;

        while ($usuario_creado == false) {

          $contador_usuario = User::where('usuario','=',$usuario)->count();

          if($contador_usuario != 0){

            $usuario = $usuario_o . $contador;

            $contador++;

          }else {
            $password = bcrypt($usuario);

            $nuevo_usuario->usuario = $usuario;
            $nuevo_usuario->password = $password;
            $nuevo_usuario->tipo_usuario_id = 4;
            $nuevo_usuario->encargado_id = $encargado->id;

            $nuevo_usuario->save();
            $usuario_creado = true;
          }

        }

        return redirect()->route('alumnos.show', $request->alumno_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encargado = Encargado::find($id);

        return view('platform.ver_encargado')->with([
            'encargado'     =>      $encargado
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $encargado = Encargado::find($id);

        $encargado->nombre = $request->nombre;
        $encargado->segundo_nombre = $request->segundo_nombre;
        $encargado->apellido = $request->apellido;
        $encargado->segundo_apellido = $request->segundo_apellido;
        $encargado->telefono = $request->telefono;
        $encargado->direccion = $request->direccion;
        $encargado->email = $request->email;

        $encargado->save();
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

    public function encargado_existente(Request $request){
      $alumno_encargado = new Alumno_Encargado();
      $alumno_encargado->alumno_id = $request->alumno_id;
      $alumno_encargado->encargado_id = $request->encargado_id;
      $alumno_encargado->save();

      return redirect()->route('alumnos.show', $request->alumno_id);
    }

    public function ver_encargado($id_alumno, $id_encargado){

        $encargado = Encargado::find($id_encargado);

        $reportes = Reporte::where('alumno_id', '=', $id_alumno)->get();

        return view('platform.ver_encargado')->with([
            'id_alumno'     =>      $id_alumno,
            'reportes'      =>      $reportes,
            'encargado'     =>      $encargado
        ]);
    }

    public function enviar_reporte(Request $request){

        $reporte = new Reporte();
        $reporte->asunto = $request->asunto;
        $reporte->mensaje = $request->mensaje;
        $reporte->empleado_id = Auth::user()->empleado_id;
        $reporte->alumno_id = $request->alumno_id;

        $reporte->save();

        return redirect()->route('encargados.ver_encargado', ['id_alumno' => $request->alumno_id, 'id_encargado' => $request->encargado_id]);

    }
}
