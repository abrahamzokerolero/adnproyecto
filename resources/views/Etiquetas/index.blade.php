@extends('layouts.app')

@section('title')
    ADN México | Etiquetas
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<div class="container">
		<div class="flex-row">
			<h5 class="btn btn-secondary float-left"> Etiquetas </b></h5>
			<a href="{{route('categorias.index')}}" class="btn btn-info ml-2 mb-2"> Volver a categorias</a>
			<a href="{{route('etiquetas.create')}}" class="btn btn-success float-right ml-2 mb-2"><i class="fa fa-plus-circle"></i> Añadir etiquetas</a>
		</div>
		<table id="myTable" class="table">
			<thead class="card-header">
				<td>ID</td>
				<td>Nombre</td>
				<td>Categoria</td>
				<td>Acciones</td>
			</thead>
			<tbody>
				@foreach($etiquetas as $etiqueta)
					<tr> 
						<td>{{$etiqueta->id}}</td>
						<td>{{$etiqueta->nombre}}</td>
						<td><a href="/categorias/{{$etiqueta->categoria_id}}">{{$etiqueta->categoria_id}}</a></td>
						<td class="text-right">
							<a href="{{ route('etiquetas.destroy', $etiqueta->id)}}"  onclick="return confirm('Desea eliminar la etiqueta seleccionada?' )" class="btn btn-danger">
								<i class="fa fa-times"></i>
							</a> 
							<a href="{{ route('etiquetas.edit', $etiqueta->id)}}" class="btn btn-warning" >
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
			  	"order": [0, "desc"],
			    "language": {
			      "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
			    }
			  });
			});
		</script>
	</div>
@endsection