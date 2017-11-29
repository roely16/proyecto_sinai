@extends('layouts.platform')

@section('title')
  Mis Estudiantes
@endsection

@section('content')
  <br><br>
  <div class="row">
    <div class="col l12">
      <div class="row">
        <form method="POST" action="">
          {{ csrf_field() }}
          <div class="col l4 s8">
            <input type="text" name="buscar_alumno" id="buscar_alumno" placeholder="Ingrese el nombre del alumno">
          </div>
          <div class="col l4 s4">
            <button class="btn waves-effect waves-light" type="submit" name="action">
              Buscar <i class="material-icons right">search</i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row">
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Grado</th>
          <th>Sección</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
@endsection
