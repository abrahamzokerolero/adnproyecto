@extends('layouts.app')

@section('title')
    ADN México | Fuentes
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')
	
	<div class="card-block mt-3">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<div class="container">
			<div class="flex-row">
				<h5 class="btn btn-secondary float-left"> Fuentes </b></h5>
				<a href="{{route('fuentes.create')}}" class="btn btn-primary float-right ml-2 mb-2"><i class="fa fa-plus-circle"></i> Añadir fuente</a>
			</div>
			<table id="myTable" class="table">
				<thead class="card-header">
					<td>id</td>
					<td>Nombre de fuentes</td>
					<td>Identificador interno</td>
					<td>Identificador externo</td>
					<td>Contacto</td>
					<td>Correo</td>
					<td>Telefono</td>
					<td>Opciones</td>
				</thead>
				<tbody>
					@foreach($fuentes as $fuente)
						<tr>
							<td>{{$fuente->id}}</td>
							<td>{{$fuente->nombre}}</td>
							<td>{{$fuente->id_externo}}</td>
							<td>{{$fuente->id_interno}}</td>
							<td>{{$fuente->contacto_fuente}}</td>
							<td>{{$fuente->correo_fuente}}</td>
							<td>{{$fuente->telefono1_fuente}}<br>{{$fuente->telefono2_fuente}}</td>
							<td>
								<a href="{{ route('fuentes.destroy', $fuente->id)}}"  onclick="return confirm('Desea eliminar la fuente seleccionada?' )" class="btn btn-danger">
									<i class="fa fa-times"></i>
								</a> 
								<a href="{{ route('fuentes.edit', $fuente->id)}}" class="btn btn-warning" >
									<i class="fa fa-pencil-square-o"></i>
								</a>
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
				  	"order": [ 0 , 'desc'],
				    "language": {
				      "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
				    }
				  });
				});
			</script>
		</div>
	</div>
@endsection

