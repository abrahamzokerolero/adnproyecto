@extends('layouts.app')

@section('title')
    ADN México | Lista de Perfiles
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->
@section('script')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="{{asset('css/choices.min.css?version=3.0.4')}}">
  	<script src="{{asset('js/choices.min.js?version=3.0.4s')}}"></script> 
@endsection

@section('content')
	<div class="card-block">
		<div class="container">
			<div class="card-title p-3 card-header">
				<img src="{{asset('images/genotipos.png')}}" alt="" width="80" height="70" class=""><span class="h4 ml-3 font-weight-bold"> LISTA DE PERFILES GENETICOS</span>
				<div class="float-right">
					@can('perfiles_geneticos.create')
					<a href="{{route('perfiles_geneticos.create')}}" class="mr-3 mt-2 btn btn-danger "><i class="fa fa-list-ul"></i> Ingresar nuevo perfil</a>
					@endcan
					@can('importaciones_perfiles.create')
					<a href="{{route('importaciones_perfiles.create')}}" class="mt-2 btn btn-danger "><i class="fa fa-pencil"></i> Importar perfiles</a>
					@endcan
				</div>	
			</div>
			
			<ul class="nav nav-tabs mt-2 justify-content-center" id="myTab" role="tablist">
			  	<li class="nav-item">
			  	  <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Filtro por metadato</a>
			  	</li>
			  	<li class="nav-item">
			  	  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Filtro por etiquetas</a>
			  	</li>
			  	<li class="nav-item">
			  	  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Filtro por fuente</a>
			  	</li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade border" id="home" role="tabpanel" aria-labelledby="home-tab">
			  	<span class="bg-warning form-control mensaje_de_error text-center mt-2 mb-2">Mensaje de error</span>
				<script type="text/javascript"> $('.mensaje_de_error').hide();</script>
			  	<div class="d-flex justify-content-center p-2">
			  		{!! Form::open(array('route' => ['perfiles_geneticos.filtro_por_metadato'], 'method' => 'POST')) !!}﻿
					<div class="row pb-3">
						<div class="col">
							<select required name="id_tipo_de_metadato" class="form-control" placeholder = 'Buscar por metadato'>
							  <option disabled selected><b>Seleccionar metadato</b></option>
							  @foreach($tipos_de_metadatos as $tipo_de_metadato)
							  	<option value="{{$tipo_de_metadato->id}}">{{str_replace("_", " ", strtoupper($tipo_de_metadato->nombre))}}</option>
							  @endforeach
							</select>
						</div>
						<div class="col">
							{!!Form::text('filtro_por_metadato', null, ['class' => 'form-control'])!!}			
						</div>
						<div class="col-3">
							<button class="btn btn-primary buscar">Buscar</button>
						</div>
					</div>
				{!!Form::close()!!}
				</div>
			  </div>
			  <div class="tab-pane fade border" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			  	<span class="bg-warning form-control mensaje_de_error2 text-center mt-2 mb-2">Mensaje de error</span>
				<script type="text/javascript"> $('.mensaje_de_error2').hide();</script>
			  	<div class="d-flex justify-content-around">
			  		<div class="p-2 w-75">
					  	{!! Form::open(array('route' => ['perfiles_geneticos.filtro_por_etiquetas'], 'method' => 'POST')) !!}﻿
					  	<div class="row pb-3">
					  		<div class="col">
					  			<select class="form-control" name="etiquetas[]" id="etiquetas" multiple required>
									@foreach($categorias as $categoria)
										<optgroup label="{{ strtoupper($categoria->nombre)}}">
											@foreach($categoria->etiquetas as $etiqueta)
												<option value="{{$etiqueta->id}}">{{$etiqueta->nombre}} <b>(
													<?php $contador = 0; ?>
													@if($usuario->estado->nombre == 'CNB')
														{{Illuminate\Support\Facades\DB::table('etiquetas_asignadas')
															->join('perfiles_geneticos', 'etiquetas_asignadas.id_perfil_genetico' , '=', 'perfiles_geneticos.id' )
															->select('etiquetas_asignadas.id_etiqueta', 
																	 'etiquetas_asignadas.id_perfil_genetico',
																	 'perfiles_geneticos.id',
																	 'perfiles_geneticos.id_estado',
																	 'perfiles_geneticos.es_perfil_repetido',
																	 'perfiles_geneticos.desestimado'
																	)
															->where('perfiles_geneticos.es_perfil_repetido', '=', 0)
															->where('perfiles_geneticos.desestimado', '=', 0)
															->where('etiquetas_asignadas.id_etiqueta', '=', $etiqueta->id)
															->count()}}
													@else
														{{Illuminate\Support\Facades\DB::table('etiquetas_asignadas')
															->join('perfiles_geneticos', 'etiquetas_asignadas.id_perfil_genetico' , '=', 'perfiles_geneticos.id' )
															->select('etiquetas_asignadas.id_etiqueta', 
																	 'etiquetas_asignadas.id_perfil_genetico',
																	 'perfiles_geneticos.id',
																	 'perfiles_geneticos.id_estado',
																	 'perfiles_geneticos.es_perfil_repetido',
																	 'perfiles_geneticos.desestimado'
																	)
															->where('perfiles_geneticos.es_perfil_repetido', '=', 0)
															->where('perfiles_geneticos.desestimado', '=', 0)
															->where('etiquetas_asignadas.id_etiqueta', '=', $etiqueta->id)
															->where('perfiles_geneticos.id_estado', '=', $usuario->estado->id)
															->count()}}
													@endif
												)</b></option>
											@endforeach	
										</optgroup>
									@endforeach
								</select>
					  		</div>
					  		<div class="col">
					  			<button class="btn btn-primary buscar2">Buscar</button>
					  		</div>
					  	</div>
					  	{!!Form::close()!!}
					</div>
			  	</div>
			  </div>
			  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
			  	<span class="bg-warning form-control mensaje_de_error3 text-center mt-2 mb-2">Mensaje de error</span>
				<script type="text/javascript"> $('.mensaje_de_error3').hide();</script>
			  	<div class="d-flex justify-content-around">
			  		<div class="p-2 w-75">
					  	{!! Form::open(array('route' => ['perfiles_geneticos.filtro_por_fuentes'], 'method' => 'POST')) !!}﻿
					  	<div class="row pb-3">
					  		<div class="col">
					  			<select name="id_fuente" class="form-control" required="">
								  <option disabled selected>Seleccione una Fuente</option>
								  @foreach($fuentes as $fuente)
								  	<option value="{{$fuente->id}}">{{$fuente->nombre}}</option>
								  @endforeach
								</select>
					  		</div>
					  		<div class="col">
					  			<button class="btn btn-primary buscar3">Buscar</button>
					  		</div>
					  	</div>
					  	{!!Form::close()!!}
					</div>
			  	</div>
			  </div>
			</div>

			<table id="myTable" class="table">
				<thead class="card-header bg-danger text-white">
					<td>ID interno</td>
					<td>ID externo</td>
					<td>Marcadores</td>
					<td>Homocigotos</td>
					<td>Usuario</td>
					<td>Fecha de creacion</td>
				</thead>
				<tbody>
					
				</tbody>
			</table>
			<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
			<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
			<script>
				$(document).ready(function() {

				  var data = <?php echo $perfiles_geneticos;?>;
				  var oTable = $('#myTable').DataTable({
			            data:data,
				        columnDefs: [{"className": "dt-center", "targets": "_all"}],
			            columns: [
					        { data: 'identificador',
						    render: function ( data, type, row ) {
							        return '<a href="perfiles_geneticos/'+ row.id +'">'+ data + '</a>';
							    }
						    },
					        { data: 'id_externo' },
					        { data: 'numero_de_marcadores',
					        render: function ( data, type, row ) {
							        return '<span class=" border border-success rounded p-1">'+ data + '</span>';
							    }
					        },
					        { data: 'numero_de_homocigotos', 
					        render: function ( data, type, row ) {
							        return '<span class=" border border-info rounded p-1">'+ data + '</span>';
							    }
					        },
					        { data: 'name' },
					        { data: 'created_at'},
					    ]
			        });
				  	$(".buscar").click(function(e){
				        e.preventDefault();
			        	var form = $(this).parents('form');
			        	var url = form.attr('action');

			        	var tipo_de_metadato = $("select[name='id_tipo_de_metadato']").val();
			        	var filtro_por_metadato = $("input[name='filtro_por_metadato']").val();
			        	var nombre_tipo_de_metadato = $("option[value='"+ tipo_de_metadato +"']").val();	
		

			        	if(tipo_de_metadato != null && filtro_por_metadato != ""){
			        		$('.mensaje_de_error').fadeOut();
			        		$.post(url, form.serialize(), function(result){
				        		oTable.clear();
				        		for (var i = 0, len = result.newData.length; i < len; i++) {

								  oTable.row.add({
								  	"identificador" : '<a href="perfiles_geneticos/' + result.newData[i].id + '">'+ result.newData[i].identificador +'</a>',
								 	"id_externo": result.newData[i].id_externo,
					        		"numero_de_marcadores": result.newData[i].numero_de_marcadores,
					        		"numero_de_homocigotos": result.newData[i].numero_de_homocigotos,
					        		'name': result.newData[i].name,
					        		'created_at': result.newData[i].created_at
								  });
								}
				        		oTable.draw();
				        		

				        	}).fail(function(){
				        		alert('Fallo la consulta');
				        	});
				        	
			        	}
			        	else{
			        		$('.mensaje_de_error').text('Debe seleccionar un tipo de metadato y escribir un texto en el filtro');
			        		$('.mensaje_de_error').fadeIn();
			        	}
				    });

				    $(".buscar2").click(function(e){
				        e.preventDefault();
			        	var form = $(this).parents('form');
			        	var url = form.attr('action');

			        	var etiquetas = $("select[name='etiquetas[]']").val();	

			        	if(etiquetas.length > 0){
			        		$('.mensaje_de_error2').fadeOut();
			        		$.post(url, form.serialize(), function(result){
				        		oTable.clear();
				        		for (var i = 0, len = result.newData.length; i < len; i++) {

								  oTable.row.add({
								  	"identificador" : '<a href="perfiles_geneticos/' + result.newData[i].id + '">'+ result.newData[i].identificador +'</a>',
								 	"id_externo": result.newData[i].id_externo,
					        		"numero_de_marcadores": result.newData[i].numero_de_marcadores,
					        		"numero_de_homocigotos": result.newData[i].numero_de_homocigotos,
					        		'name': result.newData[i].name,
					        		'created_at': result.newData[i].created_at
								  });
								}
				        		oTable.draw();
				        		

				        	}).fail(function(){
				        		alert('Fallo la consulta');
				        	});
				        	
			        	}
			        	else{
			        		$('.mensaje_de_error2').text('Debe seleccionar al menos una etiqueta');
			        		$('.mensaje_de_error2').fadeIn();
			        	}
				    });

				    $(".buscar3").click(function(e){
				        e.preventDefault();
			        	var form = $(this).parents('form');
			        	var url = form.attr('action');

			        	var fuente = $("select[name='id_fuente']").val();	

			        	if(fuente != ""){
			        		$('.mensaje_de_error3').fadeOut();
			        		$.post(url, form.serialize(), function(result){
				        		oTable.clear();
				        		for (var i = 0, len = result.newData.length; i < len; i++) {

								  oTable.row.add({
								  	"identificador" : '<a href="perfiles_geneticos/' + result.newData[i].id + '">'+ result.newData[i].identificador +'</a>',
								 	"id_externo": result.newData[i].id_externo,
					        		"numero_de_marcadores": result.newData[i].numero_de_marcadores,
					        		"numero_de_homocigotos": result.newData[i].numero_de_homocigotos,
					        		'name': result.newData[i].name,
					        		'created_at': result.newData[i].created_at
								  });
								}
				        		oTable.draw();
				        		

				        	}).fail(function(){
				        		alert('Fallo la consulta');
				        	});
				        	
			        	}
			        	else{
			        		$('.mensaje_de_error3').text('Debe seleccionar una fuente');
			        		$('.mensaje_de_error3').fadeIn();
			        	}
				    });



				  var multipleDefault = new Choices(document.getElementById('etiquetas'),{
				  	position: 'button',
				  });
			      var multipleFetch = new Choices('#choices-multiple-remote-fetch', {
			        placeholder: true,
			        placeholderValue: 'Pick an Strokes record',
			        maxItemCount: 5,
			        position: 'button',
			      }).ajax(function(callback) {
			        fetch('https://api.discogs.com/artists/55980/releases?token=QBRmstCkwXEvCjTclCpumbtNwvVkEzGAdELXyRyW')
			          .then(function(response) {
			            response.json().then(function(data) {
			              callback(data.releases, 'title', 'title');
			            });
			          })
			          .catch(function(error) {
			            console.error(error);
			          });
			      });
				});

			</script>
		</div>
	</div>
@endsection