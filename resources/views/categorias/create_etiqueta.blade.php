@extends('layouts.app')

@section('title')
    ADN México | Crear Etiqueta en {{ $categoria->nombre}}
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

	<!-- Formulario de ingreso de una nueva categoria-->

	<div class="container w-50">
		<p class="card-header">Crear etiqueta en {{ $categoria->nombre}}</p>
		{!! Form::open(['route' => 'categorias.etiqueta.create.store', 'method'=> 'POST' ]) !!}
		<div class="p-3">
				<div class="form-group">
					{!! Form::label('nombre' , 'Nombre')!!}
					{!! Form::text('nombre' , null , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un nombre para la etiqueta' , 'required'])!!}
				</div>
				<div class="form-group">
					{!! Form::label('categoria_id' , 'Categoria ID')!!}
					{!! Form::text('categoria_id' , $categoria->id , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un nombre para la etiqueta' , 'required', 'readonly'=>"readonly"])!!}
				</div>
		</div>
		<div class="form-group text-center">
			{!! Form::submit('Guardar', ['class' => 'btn btn-primary mr-3']) !!}
			
			<div class="btn btn-primary"><a href="{{route('categorias.index')}}" class="text-white">Regresar</a></div>

		</div>
		{!! Form::close() !!}
		
	</div>
</div>

@endsection