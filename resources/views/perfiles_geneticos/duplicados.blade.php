@extends('layouts.app')

@section('title')
    ADN México | Lista de perfiles duplicados
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')

	<div class="card-block">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<div class="container">
			<div class="card-title p-3 card-header">
				<img src="{{asset('images/genotipos.png')}}" alt="" width="80" height="70" class=""><span class="h4 ml-3 font-weight-bold"> LISTA DE PERFILES DUPLICADOS</span>
			</div>
	
			<table id="myTable" class="table">
				<thead class="card-header bg-danger text-white">
					<td>Perfil repetido</td>
					<td>Estado perfil repetido</td>
					<td>Perfil original</td>
					<td>Estado perfil repetido</td>
					<td class="text-center">Usuario subio</td>
					<td class="text-center">Fecha de creacion</td>
				</thead>
				<tbody>
					@foreach($perfiles_geneticos as $perfil_genetico)
						<tr>
							<td>
								<a href="{{ route('perfiles_geneticos.validar_duplicado', $perfil_genetico)}}">{{$perfil_genetico->identificador}}</a>
							</td>
							<td>{{$perfil_genetico->estado->nombre}}</td>
							<td class="text-center">{{$perfil_genetico->perfil_original->identificador}}</td>
							<td class="text-center">{{$perfil_genetico->estado_perfil_original->nombre}}</td>
							<td class="text-center">{{$perfil_genetico->usuario->name}}</td>
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