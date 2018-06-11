@extends('layouts.app')

@section('title')
    ADN México | Crear categoria
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
	
		{!! Form::open(array('route' => ['etiquetas.update',$etiqueta->id], 'method' => 'PUT')) !!}﻿

		<div class="p-3">
			<div class="form-group">
				{!! Form::label('nombre' , 'Nombre')!!}
				{!! Form::text('nombre' , $etiqueta->nombre , [ 'class' => 'form-control', 'required'])!!}
				<label for="categoria_id" class="mt-2">Categoria</label>
                <select name="categoria_id" class="form-control">
                    <option disabled selected>Seleccione una categoria</option>
                    @foreach($categorias as $categoria)
                    	@if($etiqueta->categoria_id == $categoria->id)
							<option value="{{$categoria->id}}" selected="selected">{{$categoria->nombre}}</option>
                    	@else
                    		<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    	@endif
                    @endforeach
                </select>
			</div>

			<div class="form-group text-right">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary mr-3']) !!}
				
				<div class="btn btn-primary"><a href="{{route('etiquetas.index')}}" class="text-white">Regresar</a></div>

			</div>
			{!! Form::close() !!}
			
		</div>
	</div>

@endsection