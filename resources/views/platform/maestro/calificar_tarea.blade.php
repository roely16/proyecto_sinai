@extends('layouts.platform')

@section('title')
  Calificar Tarea
@endsection

@section('content')
  <div class="row">
    <div class="col l12">
      <div class="card white">
        <div class="card-content black-text">

          <div class="row">
            <div class="col l4">
              <br>
              <a href="{{ route('maestro.entregas_tarea', $tarea->tarea->id) }}" class="btn blue-grey darken-4">
                <i class="material-icons center" >arrow_back</i>
              </a>
            </div>
            <div class="col l8">
              <h5>Detalles de la tarea</h5>
            </div>
          </div>

          <br>
          <div class="row">
            <div class="input-field col l4 s12">
              <input type="text" placeholder="" name="" value="{{ $tarea->tarea->nombre }}" readonly>
              <label for="">Nombre</label>
            </div>
            <div class="input-field col l3 s12">
              <input type="text" placeholder="" name="" value="{{ $tarea->tarea->fecha_creacion }}" readonly>
              <label for="">Fecha de creación</label>
            </div>
            <div class="input-field col l3 s12">
              <input type="text" placeholder="" name="" value="{{ $tarea->tarea->fecha_entrega }}" readonly>
              <label for="">Fecha de entrega</label>
            </div>
            <div class="input-field col l2 s12">
              <input type="text" placeholder="" name="" value="{{ $tarea->tarea->punteo }}" readonly>
              <label for="">Punteo</label>
            </div>
            <div class="input-field col l12 s12">
              <textarea id="descripcion" placeholder="" name="descripcion" class="materialize-textarea" readonly>{{ $tarea->tarea->descripcion }}</textarea>
              <label for="textarea1">Descripción</label>
            </div>
          </div>

          <div class="row">
            <h5>Tarea Entregada</h5>
            <a href="{{ $url }}" download="{{ $tarea->nombre_archivo }}">Descargar archivo</a>
            <div class="col l12 s12 center">
              <a href="#modal1" class="btn aves-effect waves-light modal-trigger">Calificar Tarea</a>
            </div>
          </div>

          <div class="row">
            @if ($tarea->calificacion != NULL)
              <div class="input-field col l3">
                <input type="text" value="{{ $tarea->calificacion }}" placeholder="" readonly>
                <label for="">Calificación</label>
              </div>
              <div class="input-field col l9">
                <input type="text" value="{{ $tarea->observaciones }}" placeholder="" readonly>
                <label for="">Observaciones</label>
              </div>
            @endif
          
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('extras')
  <div id="modal1" class="modal">
    <form action="{{ route('maestro.calificar_tarea_puntos') }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">
      <div class="modal-content">
        <h4>Calificar Tarea</h4>

        <div class="row">
          <div class="input-field col l4">
            <input type="text" placeholder="" name="calificacion">
            <label for="">Nota</label>
          </div>
          <div class="input-field col l12">
            <input type="text" placeholder="" name="observaciones">
            <label for="">Observaciones</label>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="modal-action waves-effect waves-green btn-flat">Guardar</button>
      </div>
    </div>
  </form>
@endsection
