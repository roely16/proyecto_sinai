@extends('layouts.platform')

@section('title')
  Detalles Tarea
@endsection

@section('content')

  <div class="row">
    <div class="col l12">
      <div class="card white">
        <div class="card-content black-text">
          <div class="row">
            <div class="col l4">
              <br>
              <a href="{{ route('alumno.ver_curso', $tarea->curso_id) }}" class="btn blue-grey darken-4">
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
              <input type="text" placeholder="" name="" value="{{ $tarea->nombre }}" readonly>
              <label for="">Nombre</label>
            </div>
            <div class="input-field col l3 s12">
              <input type="text" placeholder="" name="" value="{{ $tarea->fecha_creacion }}" readonly>
              <label for="">Fecha de creación</label>
            </div>
            <div class="input-field col l3 s12">
              <input type="text" placeholder="" name="" value="{{ $tarea->fecha_entrega }}" readonly>
              <label for="">Fecha de entrega</label>
            </div>
            <div class="input-field col l2 s12">
              <input type="text" placeholder="" name="" value="{{ $tarea->punteo }}" readonly>
              <label for="">Punteo</label>
            </div>
            <div class="input-field col l12 s12">
              <textarea id="descripcion" placeholder="" name="descripcion" class="materialize-textarea" readonly>{{ $tarea->descripcion }}</textarea>
              <label for="textarea1">Descripción</label>
            </div>
          </div>

          <div class="row" id="presentar_tarea" style="display: none;">
              <h5>Subir Tarea</h5>
              <form action="{{ route('alumno.editar_entrega') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="tarea_id" id="tarea_id" value="{{ $tarea->id }}">
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Archivo</span>
                    <input type="file" name="archivo" multiple required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="">
                  </div>
                </div>
                <div class="col l12 center">
                  <button class="btn" type="submit" name="button">Entregar</button>
                </div>
              </form>
            </div>

          @if(!$entregada)
            <div class="row">
              <h5>Subir Tarea</h5>
              <form action="{{ route('alumno.presentar_tarea') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="tarea_id" id="tarea_id" value="{{ $tarea->id }}">
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Archivo</span>
                    <input type="file" name="archivo" multiple required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="">
                  </div>
                </div>
                <div class="col l12 center">
                  <button class="btn" type="submit" name="button">Entregar</button>
                </div>
              </form>
            </div>

          @else
            <div class="row" id="tarea_entregada">
              <h5>Tarea Entregada</h5>
              <a href="{{ $url }}" download="{{ $entrega->nombre_archivo }}">Descargar archivo</a>
              <div class="col l12 s12 center">
                <a href="#" id="editar_entrega" class="btn">Editar Entrega</a>
              </div>
            </div>
          @endif

          <div class="row">
            @if ($entrega)
              @if ($entrega->calificacion != NULL)              
                <div class="input-field col l3">
                  <input type="text" value="{{ $entrega->calificacion }}" placeholder="" readonly>
                  <label for="">Calificación</label>
                </div>
                <div class="input-field col l9">
                  <input type="text" value="{{ $entrega->observaciones }}" placeholder="" readonly>
                  <label for="">Observaciones</label>
                </div>
              @endif
            @endif
          </div>

        </div>
      </div>
    </div>
  </div>

  
@endsection

  

@section('scripts_final')

  <script>
    $('#editar_entrega').click(function(event){
      event.preventDefault()

      $( "#presentar_tarea" ).show()
      $( "#tarea_entregada" ).hide()

    })
  </script>

@endsection
