<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Alumno;
use App\Grado;
use App\Sede;
use App\Nivel;
use App\User;
use App\Alumno_Encargado;
use App\Encargado;
use App\Curso;

class AlumnosController extends Controller
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

				//dd($usuario->empleado->sede_id);

				$alumnos = Alumno::where('sede_id', '=', $usuario->empleado->sede_id)->orderBy('id', 'DESC')->paginate(5);

				foreach($alumnos as $alumno){
					if($alumno->grado){
						$alumno->grado->grado_pred->nivel;
					}
					$alumno->sede;
				}



				return view('platform.alumnos')->with([
					'alumnos'             =>  $alumnos,
					'busqueda'            =>  false
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
				$alumno = new Alumno($request->all());
				$alumno->save();

				return redirect()->route('alumnos.index');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
				$alumno = Alumno::find($id);

				$encargados = Alumno_Encargado::where('alumno_id', $alumno->id)->get();

				foreach ($encargados as $encargado) {
					$encargado->encargado;
				}

				$niveles = Nivel::orderBy('id', 'ASC')->get();

				foreach ($niveles as $nivel) {
					$nivel->grados;
					foreach ($nivel->grados as $grado_pred) {
						$grado_pred->grados;
						foreach ($grado_pred->grados as $grado) {
						}
					}
				}

				$cursos = Curso::where('grado_id', '=', $alumno->grado_id)->get();

				//Filtrar encargados por sede
				$encargados_all = Encargado::all();

				return view('platform.show_alumno')->with([
					'alumno'      =>  $alumno,
					'encargados'  =>  $encargados,
					'niveles'     =>  $niveles,
					'encargados_all'  =>  $encargados_all,
					'cursos'	=>	$cursos	
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
				$alumno = Alumno::find($id);

				$alumno->nombre = $request->nombre;
				$alumno->segundo_nombre = $request->segundo_nombre;
				$alumno->apellido = $request->apellido;
				$alumno->segundo_apellido = $request->segundo_apellido;
				$alumno->edad = $request->edad;
				$alumno->telefono = $request->telefono;
				$alumno->direccion = $request->direccion;

				$alumno->save();

				return $alumno;
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
				$alumno = Alumno::find($id);
				$alumno->delete();
		}

		public function buscar_alumno(Request $request){

			$alumnos = Alumno::where('nombre', 'like', '%'.$request->buscar_alumno.'%')->paginate(5);
			
			foreach($alumnos as $alumno){
				if($alumno->grado){
					$alumno->grado->grado_pred->nivel;
				}
				$alumno->sede;
			}

			return view('platform.alumnos')->with([
				'alumnos'             =>  $alumnos,
				'busqueda'            =>  true
			]);

		}

		public function filtrar_alumnos(Request $request){

			if ($request->sede == 0 && $request->sede == 0) {
				$alumnos = Alumno::orderBy('sede_id', 'ASC')->paginate(5);
			}elseif ($request->jornada != 0) {
				$grados = DB::table('grados')
						->where('jornada_id','=',$request->jornada);

				dd($grados);

			}elseif($request->sede != 0) {
				$alumnos = Alumno::where('sede_id', '=', $request->sede)->paginate(5);
			}

			$grados_canalitos = Grado::where('sede_id', 1)->orderBy('grado_pred_id', 'ASC')->get();
			$grados_piedra = Grado::where('sede_id', 2)->get();
			$sedes = Sede::orderBy('id', 'ASC')->get();

			if ($grados_canalitos != null) {
				foreach ($grados_canalitos as $grado_canalitos) {
					$grado_canalitos->grado_pred;
					$grado_canalitos->jornada;
				}
			}

			if ($grados_piedra != null) {
				foreach ($grados_piedra as $grado_piedra) {
					$grado_piedra->grado_pred;
					$grado_piedra->jornada;
				}
			}

			foreach($alumnos as $alumno){
				if($alumno->grado){
					$alumno->grado->grado_pred->nivel;
				}
				$alumno->sede;
			}

			return view('platform.alumnos')->with([
				'alumnos'             =>  $alumnos,
				'grados_canalitos'    =>  $grados_canalitos,
				'grados_piedra'       =>  $grados_piedra,
				'sedes'               =>  $sedes,
				'busqueda'            =>  true
			]);
		}

		public function inscribir($id){

			$alumno = Alumno::find($id);

			return view('platform.inscribir_alumno')->with([
				'alumno' => $alumno,
				'busqueda_grados'	=>	false,
				'ciclo'		=>	""
				
			]);
		}

		public function buscar_grados(Request $request){

			$usuario = Auth::user();

			$alumno = Alumno::find($request->alumno_id);

			$grados = DB::table('grados_pred')
					->join('grados', function ($join) use ($usuario, $request){
						$join->on('grados.grado_pred_id', '=', 'grados_pred.id')
							 ->where('grados_pred.sede_id', '=', $usuario->empleado->sede_id)
							 ->where('grados.ciclo_escolar', '=', $request->ciclo);
					})->orderBy('grados.grado_pred_id', 'ASC')->get();

			return view('platform.inscribir_alumno')->with([
				'alumno'	=> 	$alumno,
				'busqueda_grados'	=>	true,
				'ciclo'		=>	$request->ciclo,
				'grados'	=>	$grados
			]);

		}

		public function asignar_grado($id, $alumno){

			$alumno = Alumno::find($alumno);

			//creacion de usuario
			if ($alumno->grado_id != null) {
				//Ya fue inscrito una vez y tiene usuario y contraseña 
				$alumno->grado_id = $id;
				$alumno->save();

				return 'reinscripcion';
				
			} else {
				//Primera vez que se inscribie crearle usuario para la plataforma

				//Crear usuario para el colaborador registrado
				$usuario = strtolower(substr($alumno->nombre, 0, 1)) . strtolower ($alumno->apellido);
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
						$nuevo_usuario->tipo_usuario_id = 5;
						$nuevo_usuario->alumno_id = $alumno->id;

						$nuevo_usuario->save();
						$usuario_creado = true;
					}

				}

				$alumno->grado_id = $id;
				$alumno->save();

				return $nuevo_usuario;

			}
			


		}

}
