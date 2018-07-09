@extends('layouts.app')

@section('title')
    ADN México | Inicio
@endsection

@section('script')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
    @guest
        <div class="container mt-5 mb-5 text-center pt-5">
            <img src="{{asset('images/adn-logo.png')}}" class="p-2 mt-5 pt-5" alt="" width="750" height="350">
        </div>
    @else
        <div class="card-title p-3 card-header">
                <img src="{{asset('images/home.png')}}" alt="" width="30" height="30" class="m-0"><span class="h5 ml-3 text-muted">Home->Dashboard</span> <div class="float-right h5 text-muted border p-2"><img src="{{asset('images/calendario.png')}}" width="25" height="25" class="mr-2" alt="">{!!Form::date('name', \Carbon\Carbon::now())!!}</div>
            </div>
        <div class="container mt-2">
            <div class="d-flex flex-row justify-content-between text-white mt-3">
                <div class="card accesos_rapidos">
                    <div class="acceso_rapido_contenido genotipos_gris d-flex flex-column align-items-end">
                        <span class="mr-3 h2 m-0 p-0">{{$numero_perfiles}}</span>
                        <p class="mr-3 mt-0 p-0">Genotipos Registrados</p>
                    </div>
                    <div class="card-footer verde float-left pl-4 pt-2 pb-0">
                        <p><a href="{{route('perfiles_geneticos.index')}}">MAS INFORMACION</a></p>
                    </div>
                </div>
                <div class="card accesos_rapidos text-muted">
                    <div class="acceso_rapido_contenido busquedas_gris d-flex flex-column align-items-end">
                        <span class="mr-3 h2 m-0 p-0">0</span>
                        <p class="mr-3 mt-0 p-0 ">Busquedas realizadas</p>
                    </div>
                    <div class="card-footer blanco float-left pl-4 pt-2 pb-0">
                        <p><a href="" class="text-muted">MAS INFORMACION</a></p>
                    </div>
                </div>
                <div class="card accesos_rapidos">
                    <div class="acceso_rapido_contenido fuentes_gris d-flex flex-column align-items-end">
                        <span class="mr-3 h2 m-0 p-0">{{$numero_fuentes}}</span>
                        <p class="mr-3 mt-0 p-0">Fuentes Registradas</p>
                    </div>
                    <div class="card-footer rojo float-left pl-4 pt-2 pb-0">
                        <p><a href="{{route('fuentes.index')}}">MAS INFORMACION</a></p>
                    </div>
                </div>
                <div class="card accesos_rapidos">
                    <div class="acceso_rapido_contenido usuarios_gris d-flex flex-column align-items-end">
                        <span class="mr-3 h2 m-0 p-0">{{$numero_usuarios}}</span>
                        <p class="mr-3 mt-0 p-0">Usuarios registrados</p>
                    </div>
                    <div class="card-footer float-left verde pl-4 pt-2 pb-0">
                        <?php $usuario = App\User::find(Illuminate\Support\Facades\Auth::id());?>
                        @if($usuario->estado->nombre == 'CNB')
                        <p><a href="{{route('users.index')}}">MAS INFORMACION</a></p>
                        @else
                        <p><a href="">MAS INFORMACION</a></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between text-white mt-3">
                <div class="card accesos_rapidos text-muted">
                    <div class="acceso_rapido_contenido importaciones_gris d-flex flex-column align-items-end">
                        <span class="mr-3 h2 m-0 p-0">{{$numero_importaciones}}</span>
                        <p class="mr-3 mt-0 p-0">Importaciones Registradas</p>
                    </div>
                    <div class="card-footer float-left pl-4 pt-2 pb-0">
                        <p><a href="{{route('importaciones_perfiles.index')}}" class="text-muted">MAS INFORMACION</a></p>
                    </div>
                </div>
                <div class="card accesos_rapidos">
                    <div class="acceso_rapido_contenido exportaciones_gris d-flex flex-column align-items-end">
                        <span class="mr-3 h2 m-0 p-0">0</span>
                        <p class="mr-3 mt-0 p-0">Exportaciones Registradas</p>
                    </div>
                    <div class="card-footer rojo float-left pl-4 pt-2 pb-0">
                        <p><a href="">MAS INFORMACION</a></p>
                    </div>
                </div>
                <div class="card accesos_rapidos">
                    <div class="acceso_rapido_contenido grupos_gris d-flex flex-column align-items-end">
                        <span class="mr-3 h2 m-0 p-0">{{$numero_categorias}}</span>
                        <p class="mr-3 mt-0 p-0">Grupos Registrados</p>
                    </div>
                    <div class="card-footer verde  float-left pl-4 pt-2 pb-0">
                        <p><a href="{{route('categorias.index')}}">MAS INFORMACION</a></p>
                    </div>
                </div>
                <div class="card accesos_rapidos text-muted">
                    <div class="acceso_rapido_contenido etiquetas_gris d-flex flex-column align-items-end">
                        <span class="mr-3 h2 m-0 p-0">{{$numero_etiquetas}}</span>
                        <p class="mr-3 mt-0 p-0">Etiquetas registrados</p>
                    </div>
                    <div class="card-footer float-left pl-4 pt-2 pb-0">
                        <p><a href="{{route('etiquetas.index')}}" class="text-muted">MAS INFORMACION</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection