@extends('layouts.app')

@section('title')
    ADN México | Editar frecuencia
@endsection

@section('script')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
<div class="container">

	<!-- Codigo de muestra de errores traidos desde las condiciones del Request de categorias -->
	@if(count($errors) > 0)
		<div class="alert alert-danger" role="alert">
			<ul>
				@foreach($errors->all() as $error)
					<li class="text-center">{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<!-- Formulario edicion de una etiqueta-->

	<div class="container w-50">
		<p class="card-header">Actualizacion de datos</p>
	
		{!! Form::open(array('route' => ['frecuencias.update',$frecuencia->id], 'method' => 'PUT')) !!}﻿

		<div class="p-3">
			<div class="form-group">
				{!! Form::label('marcador' , 'Marcador')!!}
					{!! Form::text('marcador' , $frecuencia->marcador , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese el marcador' , 'required'])!!}

					{!! Form::label('alelo' , 'Alelo')!!}
					{!! Form::text('alelo' , $frecuencia->alelo , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese el numero de Alelo' , 'required'])!!}

					{!! Form::label('frecuencia' , 'Identificador externo')!!}
					{!! Form::text('frecuencia' , $frecuencia->frecuencia , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese el valor de la frecuencia'])!!}
			</div>

			<div class="form-group text-right">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary mr-3']) !!}
				<div class="btn btn-primary"><a href="{{route('importaciones_frecuencias.show', $frecuencia->importacion_frecuencia->id)}}" class="text-white">Regresar</a></div>
			</div>
			{!! Form::close() !!}
		</div>
		
	</div>

@endsection