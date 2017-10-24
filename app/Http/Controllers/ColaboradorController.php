<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Empleado;
use App\User;

class ColaboradorController extends Controller
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
        $colaboradores = Empleado::where('sede_id', '=', $usuario->empleado->sede_id)->orderBy('sede_id', 'ASC')->paginate(5);

        foreach ($colaboradores as $colaborador) {
          $colaborador->sede;
        }

        return view('platform.colaboradores')->with([
          'colaboradores'   =>  $colaboradores,
          'busqueda'        =>  false
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
        $colaborador = new Empleado($request->all());
        $colaborador->save();

        //Crear usuario para el colaborador registrado
        $usuario = strtolower(substr($colaborador->nombre, 0, 1)) . strtolower ($colaborador->apellido);
        $usuario_o = $usuario;

        $nuevo_usuario = new User();
        $usuario_creado = false;
        $contador = 1;
        //Intentar crear el usuario

        while ($usuario_creado == false) {

          $contador_usuario = User::where('usuario','=',$usuario)->count();

          if($contador_usuario != 0){

            $usuario = $usuario_o . $contador;

            $contador++;

          }else {
            $password = bcrypt($usuario);
            if($colaborador->tipo_empleado_id == 4){
              $nuevo_usuario->usuario = $usuario;
              $nuevo_usuario->password = $password;
              $nuevo_usuario->tipo_usuario_id = 3;
              $nuevo_usuario->empleado_id = $colaborador->id;
            }else{
              $nuevo_usuario->usuario = $usuario;
              $nuevo_usuario->password = $password;
              $nuevo_usuario->tipo_usuario_id = 2;
              $nuevo_usuario->empleado_id = $colaborador->id;
            }

            $nuevo_usuario->save();
            $usuario_creado = true;
          }

        }

        return redirect()->route('colaboradores.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colaborador = Empleado::find($id);
        return view('platform.show_colaborador')->with('colaborador', $colaborador);
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
        $colaborador = Empleado::find($id);
        $colaborador->nombre = $request->nombre;
        $colaborador->segundo_nombre = $request->segundo_nombre;
        $colaborador->apellido = $request->apellido;
        $colaborador->segundo_apellido = $request->segundo_apellido;
        $colaborador->edad = $request->edad;
        $colaborador->telefono = $request->telefono;
        $colaborador->email = $request->email;
        $colaborador->direccion = $request->direccion;
        $colaborador->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $colaborador = Empleado::find($id);

        //Eliminar tambien el usuario
        $usuario = User::where('empleado_id', $colaborador->id);
        $usuario->delete();

        $colaborador->delete();

        return redirect()->route('colaboradores.index');
    }

    public function buscar_colaborador(Request $request){

      $colaboradores = Empleado::where('nombre', 'like', '%'.$request->buscar_colaborador.'%')->paginate(5);

      return view('platform.colaboradores')->with([
        'colaboradores'  => $colaboradores,
        'busqueda'  => true
      ]);
    }

    public function filtrar_colaboradores(Request $request){

      $colaboradores = null;
      $busqueda = false;

      if ($request->tipo == 0 && $request->sede == 0) {
        //Buscar todos
        $colaboradores = Empleado::orderBy('sede_id', 'ASC')->paginate(5);

      }elseif ($request->sede != 0 && $request->tipo == 0) {
        //Buscar sede especifica y todos los tipos
        $colaboradores = Empleado::where('sede_id', '=', $request->sede)->paginate(5);
        $busqueda = true;
      }elseif ($request->sede == 0 && $request->tipo != 0) {
        //Buscar todas las sedes y tipo especifico
        $colaboradores = Empleado::where('tipo_empleado_id', '=', $request->tipo)->paginate(5);
        $busqueda = true;
      }elseif ($request->sede != 0 && $request->tipo != 0) {
        //Buscar sede especifica y tipo especifico
        $colaboradores = Empleado::where('tipo_empleado_id', '=', $request->tipo)->where('sede_id', '=', $request->sede)->paginate(5);
        $busqueda = true;
      }

      foreach ($colaboradores as $colaborador) {
        $colaborador->sede;
      }

      return view('platform.colaboradores')->with([
        'colaboradores'   =>  $colaboradores,
        'busqueda'        =>  $busqueda
      ]);

    }
}
