@extends('layouts.app')

@section('title')
    ADN México | Captura manual
@endsection

@section('script')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{asset('css/choices.min.css?version=3.0.4')}}">
  	<script src="{{asset('js/choices.min.js?version=3.0.4s')}}"></script>
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')
	
	<style>
		.Seleccionado{
			background: #DDD;
		}
	</style>

	<div class="card-block mb-3">
		<div class="container">
			<div class="card-title p-3 mb-3 card-header">
				<img src="{{asset('images/genotipos.png')}}" alt="" width="80" height="70" class=""><span class="h4 ml-3 font-weight-bold"> CAPTURA MANUAL</span>
				
				<div class="float-right">
					@can('perfiles_geneticos.index')
					<a href="{{route('perfiles_geneticos.index')}}" class="btn btn-danger float-right mb-2"><i class="fa fa-chevron-left mr-2"></i> Ir a la lista de perfiles geneticos</a>
					@endcan
				</div>
			</div>
				{!!Form::open(['route'=>'perfiles_geneticos.store'], ['method' => 'POST'])!!}
				<div class="d-flex justify-content-lg-between">

					<div class="card w-25">
						<table id="myTable" class="table">
						
							<thead class="card-header bg-danger text-white">
								<td>Marcadores</td>
								<td>Alelo 1</td>
								<td>Alelo 2</td>
							</thead>
							<tbody>
								@foreach($marcadores as $marcador)
								<tr class="marcador">
									<?php 
										$alelo_1 = $marcador->nombre.'_alelo_1';
										$alelo_2 = $marcador->nombre.'_alelo_2';
									?>	
						
									<td>{{$marcador->nombre}}</td>
									<td>{!!Form::text($alelo_1, null, ['class' => "text-center w-100 $alelo_1"])!!}</td>
									@if($marcador->id_tipo_de_marcador == 2 &&  $marcador->nombre <> 'dys385' || $marcador->id_tipo_de_marcador == 3)
										<td>{!!Form::text($alelo_2, null, ['class' => "text-center w-100 $alelo_2", 'disabled'])!!}</td>
									@else
										<td>{!!Form::text($alelo_2, null, ['class' => "text-center w-100 $alelo_2"])!!}</td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="card h-50 float-right instrucciones_captura_manual">
						<div class="card card-header bg-danger text-white">
							<h5>Metadatos</h5>
						</div>

						<div class="card-body text-justify">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">DATOS DE CADAVERES O RESTOS OSEOS</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">DATOS DE FAMILIARES</a>
							  </li>
							</ul>
							<div class="tab-content" id="myTabContent">
							  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="card-header text-center text-white bg-danger mt-3">Datos de hallazgo</div>
								  <div class="row pl-3 pr-3 pt-3">
								    <div class="col">
								      {{Form::label('fecha_de_hallazgo', 'Fecha de hallazgo')}}
								      {{Form::date('fecha_de_hallazgo', null , ['class' => 'form-control'])}}
								    </div>
								    <div class="col">
								      {{Form::label('lugar', 'Lugar')}}
								      {{Form::text('lugar', null , ['class' => 'form-control'])}}
								    </div>
								  </div>
								  <div class="row pl-3 pr-3 pt-3">
								    <div class="col">
								      {{Form::label('paraje', 'Paraje')}}
								      {{Form::text('paraje', null , ['class' => 'form-control'])}}
								    </div>
								    <div class="col">
								      {{Form::label('fosa', 'Fosa')}}
								      {{Form::text('fosa', null , ['class' => 'form-control'])}}
								    </div>
								  </div>
								  <hr>
							  </div>
							  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							  	<div class="card-header text-center text-white bg-danger mt-3">Datos de Familiares</div>
								  <div class="row pl-3 pr-3 pt-3">
								   <div class="col">
								      {{Form::label('nombre_del_donante', 'Nombre del donante')}}
								      {{Form::text('nombre_del_donante', null , ['class' => 'form-control'])}}
								   </div>
								   <div class="col">
								      {{Form::label('curp_del_familiar', 'CURP del familiar')}}
								      {{Form::text('curp_del_familiar', null , ['class' => 'form-control curp'])}}
								   </div>
								   </div>
								   <div class="row pl-3 pr-3 pt-3">
								   		<div class="col">
									      {{Form::label('nombre_del_desaparecido', 'Nombre del desaparecido')}}
									      {{Form::text('nombre_del_desaparecido', null , ['class' => 'form-control'])}}
									    </div>
									    <div class="col">
									      {{Form::label('curp_del_desaparecido', 'CURP del desaparecido')}}
									      {{Form::text('curp_del_desaparecido', null , ['class' => 'form-control curp'])}}
									    </div>
									</div>
									<div class="row pl-3 pr-3 pt-3">
									    <div class="col">
									      {{Form::label('parentesco_con_el_desaparecido', 'Parentesco con el desaparecido')}}
									      {{Form::text('parentesco_con_el_desaparecido', null , ['class' => 'form-control'])}}
									    </div>
									</div>
								 	<hr>
							  </div>
							  <div class="row pl-3 pr-3 pt-3">
							    <div class="col">
							      {{Form::label('clave_de_muestra', 'Clave de muestra')}}
							      {{Form::text('clave_de_muestra', null , ['class' => 'form-control', 'required'])}}
							    </div>
							    <div class="col">
							      {{Form::label('descripcion_de_la_muestra', 'Descripcion de la muestra')}}
							      {{Form::text('descripcion_de_la_muestra', null , ['class' => 'form-control'])}}
							    </div>
							</div>
							<div class="row pl-3 pr-3">
							    <div class="col">
							      {{Form::label('observaciones', 'Observaciones')}}
							      {{Form::text('observaciones', null , ['class' => 'form-control'])}}
							    </div>
							    <div class="col">
							      {{Form::label('talla', 'Talla')}}
							      {{Form::text('talla', null , ['class' => 'form-control'])}}
							    </div>
							</div>
							<div class="row pl-3 pr-3">
							    <div class="col">
							      {{Form::label('peso', 'Peso')}}
							      {{Form::text('peso', null , ['class' => 'form-control'])}}
							    </div>
							    <div class="col">
							      {{Form::label('s_particulares_o_malformaciones', 'S. Particulares/Malformaciones')}}
							      {{Form::text('s_particulares_o_malformaciones', null , ['class' => 'form-control'])}}
							    </div>
							</div>
							<div class="row pl-3 pr-3">
							    <div class="col">
							      {{Form::label('tatuaje', 'Tatuaje')}}
							      {{Form::text('tatuaje', null , ['class' => 'form-control'])}}
							    </div>
							    <div class="col">
							      {{Form::label('sexo', 'Sexo')}}
							      {{Form::text('sexo', null , ['class' => 'form-control'])}}
							    </div>
							</div>
							<div class="row pl-3 pr-3">
							    <div class="col">
							      {{Form::label('ci_nuc_ap', 'C.I/NUC/A.P.')}}
							      {{Form::text('ci_nuc_ap', null , ['class' => 'form-control'])}}
							    </div>
							    <div class="col">
							      {{Form::label('fecha_desaparicion', 'Fecha de desaparicion')}}
							      <br>
							      {{Form::date('fecha_desaparicion', null, ['class'=> 'form-control'])}}
							    </div>
							</div>
							<div class="row pl-3 pr-3">
							    <div class="col">
							      {{Form::label('lugar_de_desaparicion', 'Lugar de desaparicion')}}
							      {{Form::text('lugar_de_desaparicion', null , ['class' => 'form-control'])}}
							    </div>
							    <div class="col">
							      {{Form::label('no_de_caso_relacionado', 'No. de caso relacionado')}}
							      <br>
							      {{Form::text('no_de_caso_relacionado', null, ['class'=>'form-control'])}}
							    </div>
							</div>
							<hr>
						   </div>
						   <div class="d-flex flex-row justify-content-between mb-3 bg-light text-dark p-3">
  								<div class="row">
  									<div class="col">
  										<label for="id_fuente" class="mt-2">Fuente</label>
										<select name="id_fuente" class="form-control" required="">
										  <option disabled selected>Seleccione una Fuente</option>
										  @foreach($fuentes as $fuente)
										  	<option value="{{$fuente->id}}">{{$fuente->nombre}}</option>
										  @endforeach
										</select>
  									</div>
									<div class="col">
										<label for="etiquetas">Seleccionar etiquetas para los perfiles</label>
										<select class="form-control" name="etiquetas[]" id="etiquetas" placeholder="Seleccione las etiquetas" multiple>
										@foreach($categorias as $categoria)
											<optgroup label="{{ strtoupper($categoria->nombre)}}">
												@foreach($categoria->etiquetas as $etiqueta)
													<option value="{{$etiqueta->id}}">{{$etiqueta->nombre}}</option>
												@endforeach	
											</optgroup>
										@endforeach
										</select>
									</div>
  								</div>
  								<hr>
  							</div>

  							<div class="card-footer">
  								<div class="float-right">
  									{!!Form::submit('Guardar perfil genetico', ['class' => 'btn btn-primary m-3 float-right'])!!}
  								</div>
  							</div>
						</div>
					</div>
				</div>
				{!!Form::close()!!}
		</div>
	</div>
	<script>
      var multipleDefault = new Choices(document.getElementById('etiquetas'));

      var multipleFetch = new Choices('#choices-multiple-remote-fetch', {
        placeholder: true,
        placeholderValue: 'Pick an Strokes record',
        maxItemCount: 5,
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
  </script>

  <script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>

    @foreach($requestAnterior->all() as $marcador  => $alelo)
		@if($marcador <> '_token')
			<script type="text/javascript">
				$(document).ready(function(){
					$('.'+'<?php echo $marcador?>').focusout(function(){
						if($(this).val() != '<?php echo $alelo?>'){
							$(this).addClass('bg-danger');
						}
						else{
							$(this).removeClass('bg-danger');
							$(this).addClass('bg-success');
						}
					});
				});
			</script>
		@endif
	@endforeach

	<script type="text/javascript">
		$(document).ready(function(){
			$('.curp').focusout(function(){
				var curp = $(this).val();
				if(curp.match(/^([a-z]{4})([0-9]{6})([a-z]{6})([0-9]{2})$/i)){//AAAA######AAAAAA##
					$(this).removeClass('border-danger');
					$(this).addClass('border-success');
				}
				else{
					$(this).removeClass('bg-success');
					$(this).addClass('border-danger');
				}
			});
		});
	</script>
@endsection