<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('template_web/css/materialize.css') }}" rel="stylesheet">
    <link href="{{ asset('template_web/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.css">
    
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('ul.tabs').tabs();
        });
    </script>

</head>
<body>
    <ul id="dropdown1" class="dropdown-content">
        <li><a class="light-blue-text text-darken-4" href="/historia">Historia</a></li>
        <li><a class="light-blue-text text-darken-4" href="/vision">Visión</a></li>
        <li><a class="light-blue-text text-darken-4" href="/mision">Misión</a></li>
        <li><a class="light-blue-text text-darken-4" href="/valores">Valores</a></li>
        <li><a class="light-blue-text text-darken-4" href="/organigrama">Organigrama</a></li>
    </ul>

    <ul id="dropdown1-mobile" class="dropdown-content">
        <li><a class="light-blue-text text-darken-4" href="/historia">Historia</a></li>
        <li><a class="light-blue-text text-darken-4" href="/vision">Visión</a></li>
        <li><a class="light-blue-text text-darken-4" href="/mision">Misión</a></li>
        <li><a class="light-blue-text text-darken-4" href="/valores">Valores</a></li>
        <li><a class="light-blue-text text-darken-4" href="/organigrama">Organigrama</a></li>
    </ul>

    <ul id="dropdown2" class="dropdown-content">
        <li><a class="light-blue-text text-darken-4" href="/preprimaria">Preprimaria</a></li>
        <li><a class="light-blue-text text-darken-4" href="/primaria">Primaria</a></li>
        <li><a class="light-blue-text text-darken-4" href="/basicos">Basicos</a></li>
        <li><a class="light-blue-text text-darken-4" href="/diversificado">Diversificado</a></li>
    </ul>

    <ul id="dropdown2-mobile" class="dropdown-content">
        <li><a class="light-blue-text text-darken-4" href="/preprimaria">Preprimaria</a></li>    
        <li><a class="light-blue-text text-darken-4" href="/primaria">Primaria</a></li>
        <li><a class="light-blue-text text-darken-4" href="/basicos">Basicos</a></li>
        <li><a class="light-blue-text text-darken-4" href="/diversificado">Diversificado</a></li>
    </ul>

    <nav class="light-blue darken-4" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="#" class="brand-logo">Colegio Sinaí</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="/">Inicio</a></li>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Nosotros<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Niveles<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a href="/jornadas">Jornadas</a></li>
                <li><a href="/requisitos">Admisiones</a></li>
                <li><a href="/login">Plataforma</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li><a class="light-blue-text text-darken-4" href="/">Inicio</a></li>
                <li><a class="dropdown-button light-blue-text text-darken-4" href="#!" data-activates="dropdown1-mobile">Nosotros<i class="material-icons right light-blue-text text-darken-4">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button light-blue-text text-darken-4" href="#!" data-activates="dropdown2-mobile">Estructura Escolar<i class="material-icons right light-blue-text text-darken-4">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button light-blue-text text-darken-4" href="#!" data-activates="dropdown3-mobile">Jornadas<i class="material-icons right light-blue-text text-darken-4">arrow_drop_down</i></a></li>
                <li><a class="dropdown-button light-blue-text text-darken-4" href="#!" data-activates="dropdown4-mobile">Admisiones<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="light-blue-text text-darken-4" href="/login">Plataforma</a></li>
            </ul>

            <a href="#" data-activates="nav-mobile" class="button-collapse">
                <i class="material-icons">menu</i>
            </a>
        </div>
    </nav>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="{{ asset('template_web/js/init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.js" charset="utf-8"></script>

    @yield('scripts')

</body>
</html>
