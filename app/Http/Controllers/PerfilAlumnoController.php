<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

use App\Alumno;
use App\Curso;
use App\Tarea;
use App\Alumno_Tarea;
use App\Video;
use App\Documento;

class PerfilAlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function mis_cursos(){

      $alumno = Alumno::find(Auth::user()->alumno_id);

      return view('platform.alumno.mis_cursos')->with([
        'grado'   =>  $alumno->grado,
        'cursos'  =>  $alumno->grado->cursos
      ]);
    }

    public function ver_curso($id){

      $curso = Curso::find($id);
      
      $tareas_1 = Tarea::where('curso_id', '=', $curso->id)->where('bimestre', '=', 1)->get();

      $tareas_2 = Tarea::where('curso_id', '=', $curso->id)->where('bimestre', '=', 2)->get();

      $tareas_3 = Tarea::where('curso_id', '=', $curso->id)->where('bimestre', '=', 3)->get();

      $tareas_4 = Tarea::where('curso_id', '=', $curso->id)->where('bimestre', '=', 4)->get();

      $videos = Video::where('curso_id', '=', $curso->id)->get();

      $documentos = Documento::where('curso_id', '=', $curso->id)->get(); 


      return view('platform.alumno.ver_curso')->with([
        'curso'   =>    $curso,
        'tareas'  =>    $curso->tareas,
        'tareas_1'  =>  $tareas_1,
        'tareas_2'  =>  $tareas_2,
        'tareas_3'  =>  $tareas_3,
        'tareas_4'  =>  $tareas_4,
        'videos'    =>  $videos,
        'documentos'  =>  $documentos
      ]);

    }

    public function detalle_tarea($id){

      $tarea = Tarea::find($id);

      $entregada = false;

      $entrega = Alumno_Tarea::where('alumno_id', '=', Auth::user()->alumno_id)
                          ->where('tarea_id', '=', $id)->count();

      if ($entrega == 1) {

        $entrega = Alumno_Tarea::where('alumno_id', '=', Auth::user()->alumno_id)
                            ->where('tarea_id', '=', $id)->first();
        $entregada = true;
        
        $url = Storage::url($entrega->archivo);

      }else {
        $url = null;
      }

      return view('platform.alumno.ver_tarea')->with([
        'tarea' => $tarea,
        'entrega' =>  $entrega,
        'entregada' =>  $entregada,
        'url'     =>  $url
      ]);
    }

    public function presentar_tarea(Request $request){

      $entrega = new Alumno_Tarea();

      $alumno_id = Auth::user()->alumno_id;

      $alumno = Alumno::find($alumno_id);

      $path = $request->file('archivo')->store('public/tareas');

      //dd($request->file('archivo')->getClientOriginalName());

      $entrega->archivo = $path;
      $entrega->alumno_id = $alumno_id;
      $entrega->tarea_id = $request->tarea_id;
      $entrega->nombre_archivo = $request->file('archivo')->getClientOriginalName();
      $entrega->save();

      return redirect()->route('alumno.detalle_tarea', $request->tarea_id);

    }

    public function editar_entrega(Request $request){

      //$alumno_tarea = Alumno_Tarea::

      $alumno = Auth::user();

      $path = $request->file('archivo')->store('public/tareas');

      $alumno_tarea = Alumno_Tarea::where('alumno_id', '=', $alumno->alumno_id)->where('tarea_id', '=', $request->tarea_id)->update(['archivo' => $path, 'nombre_archivo' => $request->file('archivo')->getClientOriginalName()]);

      return redirect()->route('alumno.detalle_tarea', $request->tarea_id);

    }
}
