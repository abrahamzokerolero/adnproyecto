@extends('layouts.app')

@section('title')
	ADN México | Etiquetas en categoria
@endsection

@section('content')
	

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<div class="container">
		<div class="flex-row">
			<h5 class="btn btn-secondary float-left"> Etiquetas en: <b>{{$categoria->nombre}} </b></h5>
			<a href="{{route('categorias.etiqueta.create', $categoria->id)}}" class="btn btn-success float-right mb-2"><i class="fa fa-bookmark"></i> Añadir etiqueta a categoria</a>
		</div>
		<table id="myTable" class="table">
			<thead class="card-header">
				<td>Id</td>
				<td>Nombre</td>
				<td>Categoria</td>
				<td>Acciones</td>
			</thead>
			<tbody>
				@foreach($etiquetas as $etiqueta)
					<tr>
						<td>{{$etiqueta->id}}</td>
						<td>{{$etiqueta->nombre}}</td>
						<td>{{$etiqueta->categoria->nombre}}</td>
						<td class="text-right">
							<a href="{{ route('etiquetas.destroy', $etiqueta->id)}}"  onclick="return confirm('Desea eliminar la etiqueta seleccionada?' )" class="btn btn-danger">
								<i class="fa fa-times"></i>
							</a> 
							<a href="{{ route('etiquetas.edit', $etiqueta->id)}}" class="btn btn-warning" >
								<i class="fa fa-pencil-square-o"></i>
							</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script>
			$(document).ready(function() {
			  $('#myTable').DataTable({
			  	"order": [0, 'desc'],
			    "language": {
			      "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
			    }
			  });
			});
		</script>
	</div>
@endsection