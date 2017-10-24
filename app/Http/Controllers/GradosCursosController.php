<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Grado;
use App\grado_pred;
use App\Empleado;
use App\Curso_Pred;
use App\Curso;
use App\Nivel;

class GradosCursosController extends Controller
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
			$maestros = Empleado::where('tipo_empleado_id',4)->where('sede_id', '=', $usuario->empleado->sede_id)->get();


			$grados_nivel = Nivel::where('id','>', 0)->with(['grados' => function($query) use ($usuario){
				$query->where('sede_id', '=', $usuario->empleado->sede_id);
			}])->get();


			//dd($grados_nivel);

			$grados = DB::table('grados_pred')
			->join('grados', function ($join) use ($usuario){
					$join->on('grados.grado_pred_id', '=', 'grados_pred.id')
							 ->where('grados_pred.sede_id', '=', $usuario->empleado->sede_id);
			})->orderBy('grados.id', 'DESC')->paginate(10);

			//$grados = Grado::orderBy('grado_pred_id', 'ASC')->paginate(5);

			//dd($grados);

			return view('platform.grados_cursos')->with([
				'grados' => $grados,
				'grados_nivel'  =>  $grados_nivel,
				'maestros' => $maestros,
				'busqueda'	=>	false
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
				//Se almacena el nuevo grado
				$grado = new Grado();

				$grado_pred = Grado_pred::find($request->grado_pred_id);

				$grado->seccion = $request->seccion;
				$grado->ciclo_escolar = $request->ciclo_escolar;
				$grado->jornada_id = $grado_pred->jornada_id; 
				$grado->maestro_id = $request->maestro_id;
				$grado->grado_pred_id = $request->grado_pred_id;

				$grado->save();

				//Se le asignan los cursos predefinidos
				$cursos_pred = Curso_Pred::where('grado_id', $grado->grado_pred_id)->get();

				foreach ($cursos_pred as $curso_pred) {
					$curso = new Curso();
					$curso->grado_id = $grado->id;
					$curso->curso_pred_id = $curso_pred->id;

					$curso->save();

				}

				return redirect()->route('grados_cursos.index');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			$usuario = Auth::user();

			$grado = Grado::find($id);

			$cursos = $grado->cursos;

			foreach ($cursos as $curso) {
				$curso->maestro;
				$curso->curso_pred;
			}

			$maestros = Empleado::where('tipo_empleado_id',4)->where('sede_id', '=', $usuario->empleado->sede_id)->get();

			return view('platform.show_grado')->with([
				'grado' => $grado,
				'cursos' => $cursos,
				'maestros' => $maestros
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
				$grado = Grado::find($id);

				$grado->seccion = $request->seccion;
				$grado->ciclo_escolar = $request->ciclo_escolar;
				$grado->jornada_id = $request->jornada_id;
				$grado->maestro_id = $request->maestro_id;
				$grado->grado_pred_id  = $request->grado_pred_id;

				$grado->save();

		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
				$grado = Grado::find($id);
				$grado->delete();

				return redirect()->route('grados_cursos.index');
		}

		public function buscar_grado(Request $request){

			
			$usuario = Auth::user();
			$maestros = Empleado::where('tipo_empleado_id',4)->where('sede_id', '=', $usuario->empleado->sede_id)->get();


			$grados_nivel = Nivel::where('id','>', 0)->with(['grados' => function($query) use ($usuario){
				$query->where('sede_id', '=', $usuario->empleado->sede_id);
			}])->get();


			//dd($grados_nivel);

			$grados = DB::table('grados_pred')
			->join('grados', function ($join) use ($usuario, $request){
					$join->on('grados.grado_pred_id', '=', 'grados_pred.id')
							 ->where('grados_pred.sede_id', '=', $usuario->empleado->sede_id)
							 ->where('grados_pred.nombre', 'like', '%'.$request->nombre_buscar.'%');
			})->orderBy('grados.id', 'DESC')->paginate(5);

			//$grados = Grado::orderBy('grado_pred_id', 'ASC')->paginate(5);

			//dd($grados);

			return view('platform.grados_cursos')->with([
				'grados' => $grados,
				'grados_nivel'  =>  $grados_nivel,
				'maestros' => $maestros,
				'busqueda'	=>	true
			]);

		}

		public function guardar_grado(Request $request){

		}

}
