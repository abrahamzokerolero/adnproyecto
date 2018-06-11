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
        <div class="container mt-5 mb-5 text-center">
            <img src="{{asset('images/adn-logo.png')}}" class="p-5 mt-5" alt="">
        </div>
    @else
        <div class="container text-center mt-2">
            <div class="d-flex flex-row">
                <div class="img-thumbnail p-2 m-2 accesos_rapidos">
                    <a href="#" class="btn-outline-warning">
                        <img src="{{asset('images/adn_thumbnail.jpg')}}" class="img-thumbnail">
                        <p class="card-text btn-danger rounded-bottom">Genotipos registrados</p>
                    </a>
                </div> 
                <div class="img-thumbnail p-2 m-2 accesos_rapidos">
                    <a href="#" class="btn-outline-warning">
                        <img src="{{asset('images/adn_thumbnail.jpg')}}" class="img-thumbnail">
                        <p class="card-text btn-warning rounded-bottom">Busquedas realizadas</p>
                    </a>
                </div> 
                <div class="img-thumbnail p-2 m-2 accesos_rapidos">
                    <a href="{{route('fuentes.index')}}" class="btn-outline-warning">
                        <img src="{{asset('images/adn_thumbnail.jpg')}}" class="img-thumbnail">
                        <p class="card-text btn-danger rounded-bottom">Fuentes registradas: <b class="h2">{{$numero_fuentes}}</b></p>
                    </a>
                </div>
                <div class="img-thumbnail p-2 m-2 accesos_rapidos">
                    <a href="#" class="btn-outline-warning">
                        <img src="{{asset('images/adn_thumbnail.jpg')}}" class="img-thumbnail">
                        <p class="card-text btn-warning rounded-bottom">Usuarios Registrados <b class="h2">{{$numero_usuarios}}</b></p>
                    </a>
                </div>
            </div>
            <div class="d-flex flex-row">
                <div class="img-thumbnail p-2 m-2 accesos_rapidos">
                    <a href="#" class="card-text">
                        <img src="{{asset('images/adn_thumbnail.jpg')}}" class="img-thumbnail">
                        <p class="card-text btn-warning rounded-bottom">Importaciones realizadas</p>
                    </a>
                </div> 
                <div class="img-thumbnail p-2 m-2 accesos_rapidos">
                    <a href="#" class="btn-outline-warning">
                        <img src="{{asset('images/adn_thumbnail.jpg')}}" class="img-thumbnail">
                        <p class="card-text btn-danger rounded-bottom">Exportaciones realizadas</p>
                    </a>
                </div> 
                <div class="img-thumbnail p-2 m-2 accesos_rapidos">
                    <a href="#" class="btn-outline-warning">
                        <img src="{{asset('images/adn_thumbnail.jpg')}}" class="img-thumbnail">
                        <p class="card-text btn-warning rounded-bottom">Grupos registrados</p>
                    </a>
                </div>
                <div class="img-thumbnail p-2 m-2 accesos_rapidos">
                    <a href="{{route('etiquetas.index')}}" class="">
                        <img src="{{asset('images/adn_thumbnail.jpg')}}" class="img-thumbnail">
                        <p class="card-text btn-danger rounded-bottom">Etiquetas registradas: <b class="h2">{{$numero_etiquetas}}</b></p>
                    </a>
                </div>
            </div>
        </div>
    @endguest
@endsection