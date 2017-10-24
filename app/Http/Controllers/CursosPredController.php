<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Curso_Pred;
use App\Grado;
use App\Curso;
use App\Nivel;

class CursosPredController extends Controller
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso_Pred::find($id);
        $curso->delete();
    }

    public function mostrar_cursos(Request $request){
      $cursos = Curso_Pred::where('grado_id', $request->grado_id)->get();

      $usuario = Auth::user();

      $niveles = Nivel::where('id','>', 0)->with(['grados' => function($query) use ($usuario){
        $query->where('sede_id', '=', $usuario->empleado->sede_id);
      }])->get();


      return view('platform.configuracion_general')->with([
        'cursos_lista'  =>  true,
        'cursos'        =>  $cursos,
        'niveles'       =>  $niveles,
        'grado_'         =>  $request->grado_id
      ]);

    }

    public function guardar_curso(Request $request){

      $curso_pred = new Curso_Pred($request->all());
      $curso_pred->save();

      //Agregar curso_pred a cursos
      $grados = Grado::where('grado_pred_id', $request->grado_id)->get();

      $usuario = Auth::user();

      $niveles = Nivel::where('id','>', 0)->with(['grados' => function($query) use ($usuario){
        $query->where('sede_id', '=', $usuario->empleado->sede_id);
      }])->get();

      foreach ($grados as $grado) {
        $curso = new Curso();
        $curso->grado_id = $grado->id;
        $curso->curso_pred_id = $curso_pred->id;
        $curso->save();
      }

      $cursos = Curso_Pred::where('grado_id', $request->grado_id)->paginate(5);

      return view('platform.configuracion_general')->with([
        'cursos_lista'  =>  true,
        'cursos'        =>  $cursos,
        'niveles'       =>  $niveles,
        'grado_'        =>  $request->grado_id
      ]);

    }
}
