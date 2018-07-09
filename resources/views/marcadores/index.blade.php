@extends('layouts.app')

@section('title')
    ADN México | Marcadores
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')
	
	<div class="card-block mt-3">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<div class="container">
			<div class="card-title text-center">
				<h3>Marcadores</h3>
			</div>
			
			@can('marcadores.store')
			<div class="p-2">
				<button class="btn btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseMarcador" aria-expanded="false" aria-controls="collapseExample">
					<i class="fa fa-th-large"></i> Agregar marcador
				</button>
			</div>
			@endcan
			
			<div class="collapse float-left w-50 mb-2 ml-3" id="collapseMarcador">
			  <div class="card">
			  	{!! Form::open(['route' => 'marcadores.store', 'method'=> 'POST' ]) !!}
				<div class="p-3">
						<div class="form-group">
							{!! Form::label('nombre' , 'Nombre')!!}
							{!! Form::text('nombre' , null , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un marcador' , 'required'])!!}
						</div>
						<div class="form-group">
							{!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}
						</div>
				</div>
				{!! Form::close() !!}
			  </div>
			</div>

			<table id="myTable" class="table">
				<thead class="card-header bg-dark text-white">
					<td>Marcador</td>
					<td>Usuario que creo</td>
					<td>Usuario que edito</td>
					<td>Fecha de creacion</td>
					<td>Opciones</td>
				</thead>
				<tbody>
					@foreach($marcadores as $marcador)
						<tr>
							<td>{{$marcador->nombre}}</td>
							<td>{{$marcador->usuario_registro->name}}</td>
							<td>{{$marcador->usuario_edito->name}}</td>
							<td>{{$marcador->created_at}}</td>
							<td>
								@can('marcadores.destroy')
								<a href="{{ route('marcadores.destroy', $marcador->id)}}"  onclick="return confirm('Desea eliminar el marcador?, si realiza esto se eliminaran todas las frecuencias relacionadas a este marcador?' )" class="btn btn-danger btn-sm">
									<i class="fa fa-times"></i>
								</a> 
								@endcan
								@can('marcadores.edit')
								<a href="{{ route('marcadores.edit', $marcador->id)}}" class="btn btn-warning btn-sm" >
									<i class="fa fa-pencil-square-o"></i>
								</a>
								@endcan
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
			<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
			<script>
				$(document).ready(function() {
				  $('#myTable').DataTable({
				    "language": {
				      "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
				    }
				  });
				});
			</script>
		</div>
	</div>
@endsection