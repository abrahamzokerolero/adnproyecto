@extends('layouts.app')

@section('title')
    ADN México | Editar Fuente
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
	
		{!! Form::open(array('route' => ['fuentes.update',$fuente->id], 'method' => 'PUT')) !!}﻿

		<div class="p-3">
			<div class="form-group">
				{!! Form::label('nombre' , 'Nombre de fuente')!!}
					{!! Form::text('nombre' , $fuente->nombre , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un nombre asociado a la fuente' , 'required'])!!}

					{!! Form::label('id_interno' , 'Identificador interno')!!}
					{!! Form::text('id_interno' , $fuente->id_interno , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un identificador interno' , 'required'])!!}

					{!! Form::label('id_externo' , 'Identificador externo')!!}
					{!! Form::text('id_externo' , $fuente->id_externo , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un identificador externo'])!!}

					{!! Form::label('contacto_fuente' , 'Nombre de contacto')!!}
					{!! Form::text('contacto_fuente' , $fuente->contacto_fuente , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un nombre de contacto'])!!}

					{!! Form::label('correo_fuente' , 'Correo de contacto')!!}
					<input type="email" name="correo_fuente" class="form-control" placeholder="Ingrese el correo de contacto" value="{{$fuente->correo_fuente}}">	


					{!! Form::label('telefono1_fuente' , 'Telefono de contacto')!!}
					{!! Form::text('telefono1_fuente' , $fuente->telefono1_fuente , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un telefono de contacto'])!!}

					{!! Form::label('telefono2_fuente' , 'Otro numero de contacto')!!}
					{!! Form::text('telefono2_fuente' , $fuente->telefono2_fuente , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un telefono alternativo'])!!}
			</div>

			<div class="form-group text-right">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary mr-3']) !!}
				
				<div class="btn btn-primary"><a href="{{route('fuentes.index')}}" class="text-white">Regresar</a></div>

			</div>
			{!! Form::close() !!}
			
		</div>
	</div>

@endsection