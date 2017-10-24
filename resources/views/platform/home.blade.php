@extends('layouts.platform')

@section('title')
  Inicio
@endsection

@section('content')
  <div class="col l12">
    <h2 class="center">Bienvenido</h2>
  </div>
  <div class="col l12">
    @if(Auth::user()->tipo_usuario_id == 1)
      <h5 class="center">Administrador</h5>
    @elseif(Auth::user()->tipo_usuario_id == 2)
      <h5 class="center">Maestro</h5>
    @elseif(Auth::user()->tipo_usuario_id == 3)
      <h5 class="center">Encargado</h5>
    @elseif(Auth::user()->tipo_usuario_id == 4)
      <h5 class="center">Alumno</h5>
    @endif
  </div>

@endsection
