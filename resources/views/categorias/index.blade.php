@extends('layouts.app')

@section('title')
    ADN México | Categorias
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')
	
	<div class="card-block mt-3">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<div class="container">
			<div class="flex-row">
				<h5 class="btn btn-secondary float-left"> Categorias </b></h5>
				<a href="{{route('categorias.create')}}" class="btn btn-primary float-right ml-2 mb-2"><i class="fa fa-plus-circle"></i> Añadir categoria</a>
				<a href="{{route('etiquetas.index')}}" class="btn btn-success float-right mb-2"><i class="fa fa-bookmark"></i> Ver todas la etiquetas</a>
			</div>
			<table id="myTable" class="table">
				<thead class="card-header">
					<td>ID Categoria</td>
					<td>Nombre</td>
					<td>Fecha de creacion</td>
					<td>Acciones</td>
				</thead>
				<tbody>
					@foreach($categorias as $categoria)
						<tr>
							<td>{{$categoria->id}}</td>
							<td><a href="/categorias/{{$categoria->id}}">{{$categoria->nombre}}</a></td>
							<td>{{$categoria->created_at}}</td>
							<td>
								<a href="{{ route('categorias.destroy', $categoria->id)}}"  onclick="return confirm('Desea eliminar la categoria seleccionada?' )" class="btn btn-danger">
									<i class="fa fa-times"></i>
								</a> 
								<a href="{{ route('categorias.edit', $categoria->id)}}" class="btn btn-warning" >
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