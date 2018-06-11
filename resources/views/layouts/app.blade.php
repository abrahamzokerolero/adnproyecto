<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <html lang="{{ app()->getLocale() }}">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', 'ADN México')</title>

    <!-- Scripts -->
    @yield('script')

    <!-- Fonts Default-->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">


    <!-- Styles Boostrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Styles Default-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font awesome fonts-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('images/favicon.png') }}}">

</head>
<body>
    <div id="app bg-dark">
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark navbar-laravel">
          <a href="/" class="ml-2"><img class="img-responsive2" width="160" height="50"       
                    src="{{ asset('images/segob-logo.png') }}"></a> 
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user-circle-o"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @guest
            <main class="container mt-5 mb-5">
                @yield('content')
            </main>
        @else    
        <div class="d-flex flex-row clearfix side-menu mt-4 ml-0">
            <div id="menu-lateral" class="container mt-5 w-25 p-2">
              <div id="accordion" class="nav nav-pills flex-column">
                 <div class="card">
                    <div class="card-header bg-info" id="headingOne">
                      <h5 class="mb-0">
                        <a href="/" class="btn btn-link text-white"><i class="fa fa-home"></i> Home</a>
                      </h5>
                    </div>
                 </div>
                 <div class="card">
                    <div class="card-header bg-secondary" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <i class="fa fa-search"></i> Busqueda
                        </button>
                      </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <ul class="nav flex-column m-0">
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="">Individual</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Grupal</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Lista de busquedas</a>
                            </li>
                        </ul>           
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header bg-secondary" id="headingTwo">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                         <i class="fa fa-user-o"></i> Genotipos
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <ul class="nav flex-column m-0">
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Captura Manual</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Lista de Genotipos</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Perfile para revision</a>
                            </li>
                        </ul>  
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header bg-secondary" id="headingThree">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <i class="fa fa-th-large"></i> Catalogos
                        </button>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <ul class="nav flex-column m-0">  
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="{{route('fuentes.index')}}">Fuentes</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="{{route('categorias.index')}}">Categorias y etiquetas</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Tablas de frecuencias</a>
                            </li>
                        </ul>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header bg-secondary" id="headingFour">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          <i class="fa fa-arrow-circle-o-up"></i> Importaciones
                        </button>
                      </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <ul class="nav flex-column m-0">
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Nueva importación</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Lista de importaciones</a>
                        </ul>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header bg-secondary" id="headingFive">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          <i class="fa fa-arrow-circle-o-down"></i> Exportaciones
                        </button>
                      </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <ul class="nav flex-column m-0">
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Nueva exportación</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Lista de exportaciones</a>
                            </li>
                        </ul>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header bg-secondary" id="headingSix">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          <i class="fa fa-key"></i> Auditoria
                        </button>
                      </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <ul class="nav flex-column m-0">
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Sesiones abiertas</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Cambios sobre los registros</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link pl-5" href="#">Roles y permisos</a>
                            </li>
                        </ul>
                    </div>
                  </div>

                </div>
            </div> 
            <main  id="contenido-pagina" class="container ml-0 p-2 mt-5 bg-light">
                @include('flash::message')
                @yield('content')
            </main>
        @endguest
    </div>
    <footer class="text-center bg-dark text-muted p-3"> Siscon Systems S.A. de C.V. 2018</footer>
    <!-- Script Boostrap -->    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
