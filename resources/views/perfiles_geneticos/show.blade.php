@extends('layouts.app')

@section('title')
    ADN México | Detalle de perfil genetico
@endsection

@section('script')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>	
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')
	<div class="card-block mb-3">
		<div class="container">
			{!! Form::open(array('route' => ['perfiles_geneticos.validar', $perfil_genetico->id], 'method' => 'PUT')) !!}﻿
			<div class="card-title p-3 mb-3 card-header">
				<img src="{{asset('images/genotipos.png')}}" alt="" width="80" height="70" class=""><span class="h4 ml-3 font-weight-bold"> DETALLE DE PERFIL GENETICO</span>
				
				<div class="float-right">
					@can('perfiles_geneticos.index')
					<a href="{{route('perfiles_geneticos.index')}}" class="btn btn-danger float-right mb-2"><i class="fa fa-chevron-left mr-2"></i> Regresar a la lista de perfiles geneticos</a>
					@endcan
				</div>
			</div>
		
			<div class="d-flex justify-content-between">
				<div class="card metadatos">
					<div class="card-header text-center text-muted">
						@can('perfiles_geneticos.edit')
							@if($perfil_genetico->requiere_revision == 1 && $perfil_genetico->desestimado == 0 )	
								<select name="validacion" class="float-left btn border">
								  <option value="aprobar">APROBAR</option>
								  <option value="desestimar">DESESTIMAR</option>
								</select>
								{!!Form::submit('Validar', ['class' => 'btn btn-primary ml-2 float-left'])!!}
							@endif
						@endcan
						<span class="ml-0">ID interno: {{$perfil_genetico->identificador}}</span> <span class="ml-0">ID externo: {{$perfil_genetico->id_externo}}</span>
						@if($perfil_genetico->desestimado == 0)
						<a href="{{route('perfiles_geneticos.edit', $perfil_genetico->id)}}" class="btn btn-warning float-right"><i class="fa fa-pencil mr-3"></i> Editar</a>
						@endif
					</div>
					{!! Form::close() !!}
					<div class="d-flex flex-wrap mt-2">
						@foreach($perfil_genetico->metadatos as $metadato)
							<td>
								<?php $tipo_de_metadato = App\TipoDeMetadato::find($metadato->id_tipo_de_metadato) ?>
								<div class="form-group metadato_datos ml-2">
									<label for="{{$tipo_de_metadato->nombre}}" class="">{{str_replace('_',' ',ucwords($tipo_de_metadato->nombre))}}</label>
									<input type="text" name="{{$tipo_de_metadato->nombre}}" value="{{$metadato->dato}}" disabled class="form-control">
								</div>
							</td>
						@endforeach
							<td>
								<div class="form-group metadato_datos ml-2">
									<label for="fuente" class="">Fuente</label>
									<input type="text" name="fuente" value="{{$perfil_genetico->fuente->nombre}}" disabled class="form-control">
								</div>
							</td>
							<td>
								<div class="form-group metadato_datos ml-2">
									<label for="etiqueta" class="">Etiquetas</label>
									<br>
									<div class="text-center">
										@foreach($perfil_genetico->etiquetas as $etiqueta)
											<span name="etiqueta" class="btn btn-success disabled m-1">{{$etiqueta->etiqueta->nombre}}</span>
										@endforeach</div>
									</div>							
							</td>
					</div>
				</div>
				<div class="card w-25">
					<table id="myTable" class="table">
						<thead class="card-header bg-dark text-white">
							<td>Marcadores</td>
							<td>Alelo 1</td>
							<td>Alelo 2</td>
						</thead>
						<tbody>
							<?php $marcador_anterior = '' ?>
							@foreach($perfil_genetico->alelos as $alelo)
									<tr>
										<td><b>{{$alelo->marcador->nombre}}</b></td>
										<td>{{$alelo->alelo_1}}</td>
										@if($alelo->alelo_2 == null)
											<td></td>
										@else
											<td>{{$alelo->alelo_2}}</td>	
										@endif
									</tr>	
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection