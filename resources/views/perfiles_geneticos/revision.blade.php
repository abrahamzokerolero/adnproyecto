@extends('layouts.app')

@section('title')
    ADN México | Lista de Perfiles
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')

	<div class="card-block">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<div class="container">
			<div class="card-title p-3 card-header">
				<img src="{{asset('images/genotipos.png')}}" alt="" width="80" height="70" class=""><span class="h4 ml-3 font-weight-bold"> LISTA DE PERFILES PARA REVISION</span>
			</div>
	
			<table id="myTable" class="table">
				<thead class="card-header bg-danger text-white">
					<td>ID interno</td>
					<td>ID externo</td>
					<td class="text-center">Marcadores importados</td>
					<td class="text-center">Homocigotos</td>
					<td class="text-center">Usuario</td>
					<td class="text-center">Revision</td>
					<td class="text-center">Fecha de creacion</td>
				</thead>
				<tbody>
					@foreach($perfiles_geneticos as $perfil_genetico)
						<tr>
							<td>{{$perfil_genetico->identificador}}</td>
							<td>{{$perfil_genetico->id_externo}}</td>
							<td class="text-center"><a href="#" class="btn btn-outline-danger btn-sm disabled">{{$perfil_genetico->numero_de_marcadores}}</a></td>
							<td class="text-center"><span class="btn btn-light btn-sm disabled">{{$perfil_genetico->numero_de_homocigotos}}</span></td>
							<td class="text-center">{{$perfil_genetico->usuario->name}}</td>
							<td class="text-center"><a href="{{ route('perfiles_geneticos.show', $perfil_genetico->id)}}" class="btn btn-primary btn-sm">revisar</a></td>
							<td class="text-center">{{$perfil_genetico->created_at}}</td>
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