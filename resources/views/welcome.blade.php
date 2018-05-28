@extends('layouts.app')

@section('title')
    ADN México | Inicio
@endsection

@section('content')
<div class="jumbotron text-center">
    <h1> ADN México</h1>
    <nav>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/" class = "nav-link">Home</a></li>
        </ul>
    </nav>
</div>
<div class="row">
    @forelse ($messages as $message)
        <div class="col-6">
            <img class="img-thumbnail" src="{{ $message['image'] }}">
            <p class="card-text"> {{ $message['content'] }} 
                <a href="/messages/{{$message['id']}}">Leer mas</a>
            </p>
        </div>
    @empty
        <p class="card-text">No hay mensajes para mostrar</p>
    @endforelse
</div>
@endsection