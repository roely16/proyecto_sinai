@extends('layouts.app')

@section('content')

<div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <center>
      <img class="responsive-img" width="200" height="200" src="{{ asset('template_web/img/logo-sinai.jpg') }}" alt="">
    </center>
      <div class="row center">
        <h5 class="header col s12 light">Somos una institución educativa con la visión de formar alumnos
          con un desarrollo integral.</h5>
      </div>
      <br><br>
    </div>
  </div>

<div class="container">
  <div class="section">

    <!--   Icon Section   -->
    <div class="row">
      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center light-blue-text text-darken-4"><i class="material-icons">home</i></h2>
          <h5 class="center">Instalaciones</h5>

          <p class="light" align="justify">Las instalaciones del colegio responden a las necesidades
            educativas y físicas de nuestros alumnos. Contamos con salones amplios, ventilados y con
            buena  iluminación, áreas para  recreación y estudio para cada nivel.</p>
        </div>
      </div>

      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center light-blue-text text-darken-4"><i class="material-icons">group</i></h2>
          <h5 class="center">Personal Docente</h5>
          <p class="light" align="justify">Reclutamos cuidadosamente profesionales capaces y con
          experiencia que se comprometen a apoyar las prácticas docentes de nuestra institución.
        La calidad de enseñanza está asegurada, entre otros factores, por sus acreditaciones y su
      entrenamiento continuo.</p>
        </div>
      </div>

      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center light-blue-text text-darken-4"><i class="material-icons">description</i></h2>
          <h5 class="center">Cultura Organizacional</h5>

          <p class="light" align="justify">Nuestro compromiso, la lealtad son dos pilares muy importantes y fundamentales
          que sobrepasan otras reglas sociales, y hace un grupo más efectivo a la hora de llevar a cabo
        las metas establecidas por el colegio.</p>
        </div>
      </div>
    </div>

  </div>
  <br><br>
</div>

<footer class="page-footer  light-blue darken-4">
  <div class="container">
    <div class="row">

      <form method="POST" action="{{ route('contacto.enviar_correo') }}" id="contacto">
        {{ csrf_field() }}
      <div class="col l7 s12">
        <h5 class="white-text">Contáctanos</h5>
        <div class="row">
          <div class="input-field col s6">
            <input class="light-blue darken-4" type="text" name="nombre" id="nombre" value="" placeholder="" required>
            <label>Nombre</label>
          </div>
          <div class="input-field col s6">
            <input type="text" name="telefono" id="telefono" value="" placeholder="" required>
            <label>Telefono</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s9">
            <textarea class="materialize-textarea" name="mensaje" id="mensaje" value="" placeholder="" required></textarea>
            <label>Mensaje</label>
          </div>
          <div class="col s3">
            <br><br>
            <button type="submit" class="waves-effect waves-light btn white light-blue-text text-darken-4">Enviar</button>
          </div>
        </div>
      </div>
      </form>
      <div class="col l5 s12">
        <br><br>
        <ul>
          <li class="right-align"><a class="white-text" href="#!">Calle Principal Manzana 53 Lote 6</a></li>
          <li class="right-align"><a class="white-text" href="#!">Cantón Central Canalitos Zona 24</a></li>
          <li class="right-align"><a class="white-text" href="#!">2258-4390</a></li>
          <li class="right-align"><a class="white-text" href="#!">infosinaieduca@yahoo.es</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    <a class="white-text">© 2017 Colegio Sinaí All Rights Reserved</a>
    </div>
  </div>
</footer>

@endsection

@section('scripts')
<script type="text/javascript">

  $('#contacto').submit(function(event){
    event.preventDefault()

    //Enviar solicitud por AJAX

    $.ajax({
        url: $('#contacto').attr('action'),
        type: 'POST',
        data: $('#contacto').serialize(),
        success: function(data) {
          console.log(data);
          $('#nombre').val("")
          $('#telefono').val("")
          $('#mensaje').val("")
          //Mostrar mensaje de mensaje enviado
          swal(
            'Mensaje Enviado!',
            'Pronto nos pondremos en contacto contigo!',
            'success'
          )
        }
      });

    

  })

$(document).ready(function(){
    $('.slider').slider();
    $('.slider').slider('start')
  });
</script>
@endsection
