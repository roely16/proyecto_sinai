<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rutas Webpage

Route::get('/', function () {
		return view('welcome');
});
Route::get('/historia', function () {
		return view('webpage/historia');
});

Route::get('/vision', function () {
		return view('webpage/vision');
});

Route::get('/mision', function () {
		return view('webpage/mision');
});

Route::get('/valores', function () {
		return view('webpage/valores');
});

Route::get('/organigrama', function () {
		return view('webpage/organigrama');
});

Route::get('/preprimaria', function () {
		return view('webpage/preprimaria');
});

Route::get('/primaria', function () {
		return view('webpage/primaria');
});

Route::get('/basicos', function () {
		return view('webpage/basicos');
});

Route::get('/diversificado', function () {
		return view('webpage/diversificado');
});

Route::get('/matutina', function () {
		return view('webpage/matutina');
});

Route::get('/fin_semana', function () {
		return view('webpage/fin_semana');
});

Route::get('/requisitos', function () {
		return view('webpage/requisitos');
});

Route::get('/jornadas', function () {
		return view('webpage/jornadas');
});


Route::post('/contacto', 'ContactoController@enviar_correo')->name('contacto.enviar_correo');
//Rutas Plataforma

Auth::routes();

Route::get('/plataforma', 'HomeController@index')->name('home');


//Carga la seccion de administracion
Route::get('/plataforma/administracion', function () {
		return view('platform/administration');
});

//Rutas para el control de los grados y cursos
Route::group(['prefix' => 'plataforma/administracion'], function(){
		Route::resource('grados_cursos', 'GradosCursosController');
		Route::get('grados_cursos/{id}/destroy', [
			'uses'  =>  'GradosCursosController@destroy',
			'as'    =>  'platform.grados_cursos.destroy'
		]);

		Route::post('grados_cursos/buscar_grado', [
			'uses'  =>  'GradosCursosController@buscar_grado',
			'as'    =>  'platform.grados_cursos.buscar_grado'
		]);


});

//Rutas para el control de los colaboradores
Route::group(['prefix' => 'plataforma/administracion'], function(){
		Route::resource('colaboradores', 'ColaboradorController');

		Route::get('colaboradores/{id}/destroy', [
			'uses'  =>  'ColaboradorController@destroy',
			'as'    =>  'platform.colaborador.destroy'
		]);

		Route::post('colaboradores/buscar', [
			'uses'  =>  'ColaboradorController@buscar_colaborador',
			'as'    =>  'colaboradores.buscar_colaborador'
		]);

		Route::post('colaboradores/filtrar', [
			'uses'  =>  'ColaboradorController@filtrar_colaboradores',
			'as'    =>  'colaboradores.filtrar_colaboradores'
		]);

});

//Rutas para el control de los Cursos
Route::group(['prefix' => 'plataforma/administracion/grado'], function(){
		Route::resource('cursos', 'CursosController');
		Route::post('curso/asignar_maestro', 'CursosController@asignar_maestro')->name('curso.asignar_maestro');
		Route::post('curso/asignar_maestro_guia', 'CursosController@asignar_maestro_guia')->name('curso.asignar_maestro_guia');
		Route::post('curso/asignar_maestro_curso', 'CursosController@asignar_maestro_curso')->name('curso.asignar_maestro_curso');
});


//Rutas para el control de los alumnos
Route::group(['prefix' => 'plataforma/administracion'], function(){
		Route::resource('alumnos', 'AlumnosController');
		
		Route::post('alumnos/buscar', [
			'uses'  =>  'AlumnosController@buscar_alumno',
			'as'    =>  'alumnos.buscar_alumno'
		]);
		Route::post('alumnos/filtrar', [
			'uses'  =>  'AlumnosController@filtrar_alumnos',
			'as'    =>  'alumnos.filtrar_alumnos'
		]);
		Route::get('alumnos/{id}/destroy', [
			'uses'  =>  'AlumnosController@destroy',
			'as'    =>  'platform.alumnos.destroy'
		]);

		Route::get('alumnos/{id}/inscribir', [
			'uses'  =>  'AlumnosController@inscribir',
			'as'    =>  'platform.alumnos.inscribir'
		]);

		Route::get('alumnos/inscribir/asignar_grado/{id}/{alumno_id}', [
			'uses'  =>  'AlumnosController@asignar_grado',
			'as'    =>  'platform.alumnos.asignar_grado'
		]);

		Route::post('alumnos/inscribir/buscar_grados', [
			'uses'  =>  'AlumnosController@buscar_grados',
			'as'    =>  'platform.alumnos.buscar_grados_ciclo'
		]);

		Route::get('alumnos/mostrar/obtener_descuento/{id}', [
			'uses'  =>  'AlumnosController@obtener_descuento',
			'as'    =>  'platform.alumnos.obtener_descuento'
		]);

		Route::post('alumnos/mostrar/establecer_descuento/', [
			'uses'  =>  'AlumnosController@establecer_descuento',
			'as'    =>  'platform.alumnos.establecer_descuento'
		]);

});

//Rutas para el control de pagos 
Route::get('/plataforma/pagos', 'PagosController@ver_modulo_pagos')->name('pagos.ver_modulo');
Route::post('/plataforma/pagos', 'PagosController@buscar_alumno')->name('pagos.buscar_alumno');
Route::get('/plataforma/pagos/{id}/generar_pago', 'PagosController@generar_pago')->name('pagos.generar_pago');
Route::get('/plataforma/pagos/{id}/estado_cuenta', 'PagosController@estado_cuenta')->name('pagos.estado_cuenta');
Route::get('/plataforma/pagos/eliminar_pago/{id}/{id_alumno}', 'PagosController@eliminar_pago')->name('pagos.eliminar_pago');
Route::get('/plataforma/pagos/eliminar_pago_otro/{id}/{id_alumno}', 'PagosController@eliminar_pago_otro')->name('pagos.eliminar_pago_otro');
Route::post('/plataforma/pagos/procesar_pago', 'PagosController@procesar_pago')->name('pagos.procesar_pago');
Route::post('/plataforma/pagos/procesar_pago_otro', 'PagosController@procesar_pago_otro')->name('pagos.procesar_pago_otro');


//Rutas para el control de los usuarios
Route::group(['prefix' => 'plataforma/administracion'], function(){
		Route::resource('usuarios', 'UserController');
		Route::post('usuarios/buscar', [
			'uses'  =>  'UserController@buscar_usuario',
			'as'    =>  'usuarios.buscar_usuario'
		]);
});

Route::group(['prefix' => 'plataforma/administracion/'], function(){
		Route::resource('configuracion', 'ConfiguracionController');
});

Route::group(['prefix' => 'plataforma/administracion/'], function(){
		Route::resource('cursos_pred', 'CursosPredController');
		Route::get('cursos_pred/mostrar/{id?}', [
			'uses'  =>  'CursosPredController@mostrar_cursos',
			'as'    =>  'cursos_pred.mostrar_cursos'
		]);
		Route::post('cursos_pred/guardar/', [
			'uses'  =>  'CursosPredController@guardar_curso',
			'as'    =>  'cursos_pred.guardar_curso'
		]);
		Route::get('cursos_pred/{id}/destroy', [
			'uses'  =>  'CursosPredController@destroy',
			'as'    =>  'cursos_pred.destroy'
		]);
});

Route::group(['prefix' => 'plataforma/administracion/alumno'], function(){
		Route::resource('encargados', 'EncargadosController');

		Route::post('encargados/encargado_existente', [
			'uses'  =>  'EncargadosController@encargado_existente',
			'as'    =>  'encargado.encargado_existente'
		]);

});

Route::get('/plataforma/administracion/alumno/{id_alumno}/encargado/{id_encargado}', 'EncargadosController@ver_encargado')->name('encargados.ver_encargado');
Route::post('/plataforma/administracion/alumno/encargado/enviar_reporte', 'EncargadosController@enviar_reporte')->name('encargados.enviar_reporte');

//Rutas para la administracion de los pagos
Route::get('/plataforma/administracion/admin_pagos', 'AdminPagosController@ver_modulo')->name('admin_pagos.ver_modulo');
Route::get('/plataforma/administracion/admin_pagos/ver_grado/{id}', 'AdminPagosController@ver_grado')->name('admin_pagos.ver_grado');

Route::post('/plataforma/administracion/admin_pagos/ver_grado/nuevo_pago', 'AdminPagosController@nuevo_pago')->name('admin_pagos.nuevo_pago');

Route::post('/plataforma/administracion/admin_pagos/ver_grado/nuevo_pago_anual', 'AdminPagosController@nuevo_pago_anual')->name('admin_pagos.nuevo_pago_anual');

Route::get('/plataforma/administracion/admin_pagos/ver_grado/editar_pago/{id_pago}/{valor?}', 'PagosController@cambiar_valor_pago')->name('admin_pagos.cambir_valor_pago');

Route::post('/plataforma/administracion/admin_pagos/buscar_grados', 'AdminPagosController@buscar_grados')->name('admin_pagos.buscar_grados');

//Rutas para los reportes
Route::get('/plataforma/administracion/reportes', 'ReporteController@ver_modulo')->name('reportes.ver_modulo');
Route::post('/plataforma/administracion/reportes/reporte_dia', 'ReporteController@reporte_dia')->name('reportes.reporte_dia');
Route::post('/plataforma/administracion/reportes/reporte_mes', 'ReporteController@reporte_mes')->name('reportes.reporte_mes');
Route::post('/plataforma/administracion/reportes/hoja_asistencia', 'ReporteController@hoja_asistencia')->name('reportes.hoja_asistencia');
Route::post('/plataforma/administracion/reportes/detalles_reporte_dia', 'ReporteController@detalles_reporte_dia')->name('reportes.detalles_reporte_dia');
Route::post('/plataforma/administracion/reportes/detalles_reporte_mes', 'ReporteController@detalles_reporte_mes')->name('reportes.detalles_reporte_mes');


//Rutas para el perfil de Maestro
Route::get('/plataforma/maestro/cursos', 'PerfilMaestroController@mis_cursos')->name('maestro.mis_cursos');
Route::get('/plataforma/maestro/estudiantes', 'PerfilMaestroController@mis_estudiantes')->name('maestro.mis_estudiantes');
Route::get('/plataforma/maestro/cursos/ver_curso/{id}', 'PerfilMaestroController@ver_curso')->name('maestro.ver_curso');

Route::get('/plataforma/maestro/cursos/ver_curso/eliminar_tarea/{id_tarea}/{id_curso}', 'PerfilMaestroController@eliminar_tarea')->name('maestro.eliminar_tarea');

Route::get('/plataforma/maestro/cursos/ver_curso/eliminar_video/{id_video}/{id_curso}', 'PerfilMaestroController@eliminar_video')->name('maestro.eliminar_video');

Route::get('/plataforma/maestro/cursos/ver_curso/eliminar_documento/{id_documento}/{id_curso}', 'PerfilMaestroController@eliminar_documento')->name('maestro.eliminar_documento');

Route::get('/plataforma/maestro/cursos/ver_curso/entregas_tarea/{id}', 'PerfilMaestroController@entregas_tarea')->name('maestro.entregas_tarea');
Route::get('/plataforma/maestro/cursos/ver_curso/entregas_tarea/calificar/{id}', 'PerfilMaestroController@calificar_tarea')->name('maestro.calificar_tarea');

Route::post('/plataforma/maestro/cursos/ver_curso/entregas_tarea/calificar', 'PerfilMaestroController@calificar_tarea_puntos')->name('maestro.calificar_tarea_puntos');

Route::post('/plataforma/maestro/cursos/ver_curso/crear_tarea', 'PerfilMaestroController@crear_tarea')->name('maestro.crear_tarea');
Route::post('/plataforma/maestro/cursos/ver_curso/compartir_video', 'PerfilMaestroController@compartir_video')->name('maestro.compartir_video');
Route::post('/plataforma/maestro/cursos/ver_curso/compartir_documento', 'PerfilMaestroController@compartir_documento')->name('maestro.compartir_documento');


//Rutas par el perfil de alumno
Route::get('/plataforma/alumno/cursos', 'PerfilAlumnoController@mis_cursos')->name('alumno.mis_cursos');
Route::get('/plataforma/alumno/cursos/ver_curso/{id}', 'PerfilAlumnoController@ver_curso')->name('alumno.ver_curso');
Route::get('/plataforma/alumno/cursos/ver_curso/detalle_tarea/{id}', 'PerfilAlumnoController@detalle_tarea')->name('alumno.detalle_tarea');
Route::post('/plataforma/alumno/cursos/ver_curso/detalle_tarea/presentar', 'PerfilAlumnoController@presentar_tarea')->name('alumno.presentar_tarea');
Route::post('/plataforma/alumno/cursos/ver_curso/detalle_tarea/editar_entrega', 'PerfilAlumnoController@editar_entrega')->name('alumno.editar_entrega');

//Rutas para el perfil de encargado
Route::get('/plataforma/encargado/alumnos', 'PerfilEncargadoController@mis_alumnos')->name('encargado.mis_alumnos');
Route::get('/plataforma/encargado/alumnos/detalle_alumno/{id}', 'PerfilEncargadoController@detalle_alumno')->name('encargado.detalle_alumno');

