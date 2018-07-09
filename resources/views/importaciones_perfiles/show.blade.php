@extends('layouts.app')

@section('title')
    ADN México | Importaciones Perfiles
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')

	<div class="card-block">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<div class="container">
			<div class="card-title p-3 card-header mb-3">
				<img src="{{asset('images/importar.png')}}" alt="" width="80" height="70" class=""><span class="h4 ml-3 font-weight-bold"> DETALLES DE IMPORTACION</span>
				
				<div class="float-right">
					@can('importaciones_perfiles.index')
					<a href="{{route('importaciones_perfiles.index')}}" class="btn btn-warning float-right mb-2"><i class="fa fa-chevron-left mr-2"></i> Regresar a la lista de importaciones</a>
					@endcan
				</div>
				
			</div>
			
			<div class="d-flex flex-row card">
				<table class="table w-75">
					<thead class="card-header bg-warning ">
						<td class="text-center">ID de importacion</td>
						<td class="text-center">Fuente</td>
						<td class="text-center">Genotipos Importados</td>
						<td class="text-center">Fecha de importacion</td>
						<td class="text-center">Tipo de muestra</td>
						<td class="text-center">Observaciones</td>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">{{$importacion_perfiles->identificador}}</td>
							<td class="text-center">{{$importacion_perfiles->fuente->nombre}}</td>
							<td class="text-center">{{$importacion_perfiles->numero_de_perfiles}}</td>
							<td>{{$importacion_perfiles->created_at}}</td>
							<td>{{$importacion_perfiles->tipo_de_muestra}}</td>
							<td class="text-center">{{$importacion_perfiles->observaciones}}</td>
						</tr>
					</tbody>
				</table>
				<div class=" w-25 ml-3 card">
					<div class="card-header bg-success text-white text-center">Etiquetas </div>
					<div class="p-2">
						@foreach($perfiles_geneticos[0]->etiquetas as $etiqueta)
							<span class="btn btn-success btn-sm m-1 disabled"> {{$etiqueta->etiqueta->nombre}}</span>
						@endforeach
					</div>	
				</div>
			</div>
	
			<table id="myTable" class="table">
				<thead class="card-header bg-danger text-white">
					<td>ID interno</td>
					<td>ID externo</td>
					<td class="text-center">Marcadores importados</td>
					<td class="text-center">Homocigotos</td>
					<td class="text-center">Usuario</td>
					<td class="text-center">Requiere revision</td>
					<td class="text-center">Fecha de creacion</td>
				</thead>
				<tbody>
					@foreach($perfiles_geneticos as $perfil_genetico)
						<tr>
							<td>{{$perfil_genetico->identificador}}</td>
							@if($perfil_genetico->desestimado == 0 && $perfil_genetico->es_perfil_repetido == 0)
								<td><a href="{{ route('perfiles_geneticos.show', $perfil_genetico->id)}}">{{$perfil_genetico->id_externo}}</a></td>
							@else
								@if($perfil_genetico->es_perfil_repetido == 1 && $perfil_genetico->desestimado == 0)
									<td>
										<a href="{{ route('perfiles_geneticos.validar_duplicado', $perfil_genetico)}}">{{$perfil_genetico->id_externo}}</a>
									</td>
								@endif
							@endif
							<td class="text-center"><span class="btn btn-outline-danger btn-sm disabled">{{$perfil_genetico->numero_de_marcadores}}</span></td>
							<td class="text-center"><span class="btn btn-light btn-sm disabled">{{$perfil_genetico->numero_de_homocigotos}}</span></td>
							<td class="text-center">{{$perfil_genetico->usuario->name}}</td>
							<td class="text-center">
								@if($perfil_genetico->es_perfil_repetido == 0)
									@if($perfil_genetico->requiere_revision)
										<span class="btn btn-warning btn-sm disabled">si</span>
									@else
										<span class="btn btn-success btn-sm disabled">no</span>
									@endif
								@else
									<span class="btn btn-danger btn-sm disabled">duplicado</span>
								@endif
							</td>
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