<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Grado;
use App\Curso;
use App\Tarea;
use App\Alumno;
use App\Alumno_Tarea;
use App\Video;
use App\Documento;

class PerfilMaestroController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	 public function mis_cursos(){
		$user = Auth::user();

		$cursos = Curso::where('maestro_id', '=', $user->empleado_id)->orderBy('id', 'DESC')->paginate(5);

		//dd($cursos);

		return view('platform.maestro.mis_cursos')->with([
		  'cursos'	=>	$cursos,
		]);

	 }

	 public function mis_estudiantes(){

		$maestro = Auth::user();

		$grados = Grado::where('maestro_id', '=', $maestro->id)->get();

		foreach ($grados as $grado) {
		  $grado->grado_pred;
		  $grado->grado_pred->nivel;

		  foreach ($grado->cursos->where('maestro_id', '=', $maestro->empleado_id) as $curso) {
			 $curso->curso_pred;
		  }

		}

		return view('platform.maestro.mis_estudiantes')->with('grados', $grados);

	 }

	 public function ver_curso($id){

		$curso = Curso::find($id);


		$tareas_1 = Tarea::where('curso_id', '=', $curso->id)->where('bimestre', '=', 1)->get();

		$tareas_2 = Tarea::where('curso_id', '=', $curso->id)->where('bimestre', '=', 2)->get();

		$tareas_3 = Tarea::where('curso_id', '=', $curso->id)->where('bimestre', '=', 3)->get();

		$tareas_4 = Tarea::where('curso_id', '=', $curso->id)->where('bimestre', '=', 4)->get();

		$videos = Video::where('curso_id', '=', $curso->id)->get();

		$documentos = Documento::where('curso_id', '=', $curso->id)->get();	

		return view('platform.maestro.ver_curso')->with([
		  'curso' => $curso,
		  'tareas_1'	=>	$tareas_1,
		  'tareas_2'	=>	$tareas_2,
		  'tareas_3'	=>	$tareas_3,
		  'tareas_4'	=>	$tareas_4,
		  'videos'		=>	$videos,
		  'documentos'	=>	$documentos
		]);
	 }

	 public function crear_tarea(Request $request){
		$tarea = new Tarea();
		$tarea->nombre = $request->nombre;
		$tarea->descripcion = $request->descripcion;
		$tarea->fecha_entrega = $request->fecha_entrega;
		$tarea->punteo = $request->punteo;
		$tarea->curso_id = $request->curso_id;
		$tarea->bimestre = $request->bimestre;

		$tarea->fecha_creacion = "10/10/2017";

		$tarea->save();

		return redirect()->route('maestro.ver_curso',$request->curso_id);
	 }

	 public function compartir_video(Request $request){
	 	
	 	$video = new Video();
	 	$video->nombre = $request->nombre;
	 	$video->url = $request->url;
	 	$video->curso_id = $request->curso_id;
	 	$video->save();

		return redirect()->route('maestro.ver_curso',$request->curso_id); 	

	 }

	 public function compartir_documento(Request $request){
	 	
	 	$documento = new Documento();

	 	$path = $request->file('archivo')->store('public/documentos');

      	$documento->archivo = $path;
      	$documento->nombre = $request->nombre;
      	$documento->curso_id = $request->curso_id;
      	$documento->nombre_archivo = $request->file('archivo')->getClientOriginalName();
      	$documento->save();

      	return redirect()->route('maestro.ver_curso',$request->curso_id);
	 }

	 public function entregas_tarea($id){

		$tarea = Tarea::find($id);

		$alumnos = Alumno::where('grado_id', '=', $tarea->curso->grado_id)->with(['alumno_tareas' => function($query) use ($tarea){
		  $query->where('tarea_id', '=', $tarea->id);
		}])->get();

		return view('platform.maestro.ver_tarea')->with([
		  'alumnos'   =>    $alumnos,
		  'tarea'     =>    $tarea
		]);

	 }

	 public function calificar_tarea($id){

		$tarea = Alumno_Tarea::find($id);
		//$detalle_tarea = $tarea->tarea;
		$url = Storage::url($tarea->archivo);

		//dd($url);

		return view('platform.maestro.calificar_tarea')->with([
		  'tarea'   =>  $tarea,
		  'url'     =>  $url
		]);

	 }

	 public function calificar_tarea_puntos(Request $request){

	 	$tarea = Alumno_Tarea::where('id', '=', $request->tarea_id)->update(['calificacion' => $request->calificacion, 'observaciones' => $request->observaciones]);

	 	return redirect()->route('maestro.calificar_tarea', $request->tarea_id);

	 }

	 public function eliminar_tarea($id_tarea, $id_curso){

	 	$tarea = Tarea::find($id_tarea);

	 	foreach ($tarea->tareas_alumno as $entrega) {

	 		Storage::delete($entrega->archivo);	

	 	}

	 	$tarea->delete();

	 	return redirect()->route('maestro.ver_curso', $id_curso);

	 }

	public function eliminar_video($id_video, $id_curso){

		$video = Video::find($id_video);

		$video->delete();

		return redirect()->route('maestro.ver_curso', $id_curso);
	}

	public function eliminar_documento($id_documento, $id_curso){

		$documento = Documento::find($id_documento);

		Storage::delete($documento->archivo);

		$documento->delete();

		return redirect()->route('maestro.ver_curso', $id_curso);

	}
}
