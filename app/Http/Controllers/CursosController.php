<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Grado;

class CursosController extends Controller
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
		  $curso = new Curso($request->all());
		  $curso->save();

		  return redirect()->route('grados_cursos.show', $request->grado_id);

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
		  //
	 }

	 public function asignar_maestro(Request $request){
		Curso::where('grado_id', $request->grado_id)->update(['maestro_id' => $request->maestro_id]);

		return redirect()->route('grados_cursos.show', $request->grado_id);

	 }

	public function asignar_maestro_guia(Request $request){
		
		Grado::where('id', $request->grado_id)->update(['maestro_id' => $request->maestro_id]); 

		return redirect()->route('grados_cursos.show', $request->grado_id); 

	}

	public function asignar_maestro_curso(Request $request){
		Curso::where('id', $request->curso_id)->update(['maestro_id' => $request->maestro_id]);

		return redirect()->route('grados_cursos.show', $request->grado_id);		
	}
}
