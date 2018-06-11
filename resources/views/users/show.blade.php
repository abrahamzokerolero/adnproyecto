@extends('../layouts.app')

@section('title')
	{{$user->username}}
@endsection

@section('content')
	<div class="row">
	    @forelse ($user->messages as $message)
		    <div class="col-6">
		        <img class="img-thumbnail" src="{{ $message->image }}">
                <span class=" text-muted">Creado por <a href=" {{ $message->user->username}}">{{$message->user->name}}</a></span> <p class="text-muted"> {{$message->created_at}}</p>
		        <p class="card-text"> {{ $message->content }} 
		            <a href="/messages/{{$message->id}}">Leer mas</a>
		        </p>
		    </div>
		@empty
		    <div class="container text-center">
		        <p class="card-text">No hay mensajes para mostrar</p>
		    </div>
		@endforelse
	</div>
@endsection