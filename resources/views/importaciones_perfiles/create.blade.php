@extends('layouts.app')

@section('title')
    ADN México | Subir una importacion al sistema
@endsection

@section('script')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{asset('css/choices.min.css?version=3.0.4')}}">
  	<script src="{{asset('js/choices.min.js?version=3.0.4s')}}"></script>
	
@endsection

<!-- <script En las vistas de tablas no se inluye el script de laravel ya que causa conflicto con el datatable -->

@section('content')

	<div class="card-block">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<div class="container">

			<div class="card-title p-3 card-header mb-3">
				<img src="{{asset('images/importar.png')}}" alt="" width="80" height="70" class=""><span class="h4 ml-3 font-weight-bold"> CREAR UNA NUEVA IMPORTACION</span>
				
				<div class="float-right">
					@can('importaciones_perfiles.index.create')
					<a href="{{route('importaciones_perfiles.index')}}" class="btn btn-warning float-right mb-2"><i class="fa fa-chevron-left mr-2"></i> Regresar a la lista de importaciones</a>
					@endcan
				</div>
				
			</div>
			<div class="w-100 float-left mb-2">
			  <div class="card border">
				  <div class="card-header"> 
				    <ul class="nav nav-tabs card-header-tabs pull-left"  id="myTab" role="tablist">
				      <li class="nav-item">
				       <a class="nav-link active " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descargar formato de importacion de perfiles</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Subir importacion de perfiles</a>
				      </li>
				    </ul>
				  </div>
				  <div class="card-body border-success">
				   <div class="tab-content" id="myTabContent">
				        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				        	<div class=" card-header bg-warning">
				        		<b>¡Importante: Requisitos para subir su archivo!</b>
				        	</div>
				        	<div class="card-body text-justify">
				        		<p>Para comenzar el proceso de carga de su archivo al sistema debera descargar el formato ofrecido por la plataforma, El formato para la carga de perfiles se compone de 5 secciones la cuales son explicadas mas adelante. No se recomienda modificar el nombre de las columnas debido a que podrian causar problemas en los filtros de busqueda. Las columnas podran ser eliminadas si no se requieren para ser llenadas. El formato lo podra obtener haciendo clic en el siguiente boton que se presenta a continuacion, el archivo descargado debera ser renombrado con el titulo de su preferencia manteniedo los formatos ofrecios por excel (xls o xlsx).</p>

				        		<div>
				        			<a class="btn btn-primary float-right" href="{{asset('formatos/Importación_perfiles_formato.xlsx')}}">Obtener formato de importacion de perfiles</a>
				        		</div>
								<br>
								<h4 class="mt-3">Seccion 1: Identificador externo</h4>
								<p class="text-justify"> Existen 2 identificadores para cada perfil genetico, El identificador interno sera agregado automaticamente por el sistema mientras que el identificador externo del perfil debera ser ingresado obligatoriamente para la carga del documento ya que es un dato importante para mantener la referencia e integridad de la informacion. En el documento de excel  podra localizado por medio de la primera columna la cual se encuentra resaltada en color verde. Esta sera la unica columna que no debera borrar del documento. A continuacion se remarca en rojo dicha columna</p>

								<div class="text text-center w-100">
									<img src="{{asset('images/instrucciones_perfil_genetico_indentificador.png')}}">
								</div>
								
								<h4 class="mt-3">Seccion 2: Zona de marcadores y alelos</h4>
								<p class="text-justify">Las columnas marcadas en color azul corresponden a cada uno de los marcadores registrados en el sistema hasta el momento. Debajo de cada una de ellas debera colocar los alelos de cada perfil. Si un marcador posee mas de un alelo, debera obligatoriamente separar cada uno de estos por una coma. Para aquellos marcadores de los cuales no se tenga informacion, deberan ser dejados en blanco o bien podran ser eliminadas dichas colummnas para evitar la saturacion visual de su documento. El programa automaticamente descartara los espacios al principio y al final de cada alelo. Si requiere agregar un marcador no existente en el formato del proporcionado por la pagina, debera ir a la opcion del menu lateral del sitio web llamado "Marcadores" e ingresarlo previamente a la carga de su archivo, de otro modo el sistema reconocera el marcador de su excel como un metadato.</p>

								<div class="text text-center w-100">
									<img src="{{asset('images/instrucciones_perfil_genetico_marcadores.png')}}">
								</div>

								<h4 class="mt-3">Seccion 3: Zona de datos comunes</h4>
								<p class="text-justify">A partir de las siguientes columnas los datos ingresados seran denomidados "Metadatos" identidificadas por el color gris, en donde indistintamente para la carga de un perfil genetico, ya sea un perfil por restos de cadaveres/restos oseos o de busqueda de familires, tendra disponibles los campos de clave de la muestra, descripcion de la muestra, observaciones, talla, peso, S. particulares/Malforamciones, tatuje, Sexo, C.I/NUC/A.P., Fecha de desaparición, Lugar de desaparición, y No. de caso relacionado. Cada una de estas columnas podran ser eliminadas de no ser requeridas, sin embargo se recomienda agregar la mayor cantidad de informacion posible para mejorar la calidad de las busquedas</p>

								<div class="text text-center w-100">
									<img src="{{asset('images/instrucciones_perfil_genetico_datos_comunes.png')}}">
								</div>

								<h4 class="mt-3">Seccion 4: Zona de datos de cadaveres o restos oseos</h4>
								<p class="text-justify">Esta seccion corresponde a la informacion de aquellos perfiles cargados al sistema a partir de muestras de cadaveres y restos oseos. Siempre se recomienda llenar dicha informacion en la medida posible de su conocimiento</p>

								<div class="text text-center w-100">
									<img src="{{asset('images/instrucciones_perfil_genetico_restos_cadaveres.png')}}">
								</div>

								<h4 class="mt-3">Seccion 5: Zona de datos de familires</h4>

								<p class="text-justify">La ultima seccion corresponde a los datos de familiares del perfil genetico a ingresar, igual que las demas columans estas podran ser eliminadas de no ser requeridas. Las columnas se encuentran identificadas por el color amarillo</p>
								<div class="text text-center w-100">
									<img src="{{asset('images/instrucciones_perfil_genetico_familiares.png')}}">
								</div>

								<h4 class="mt-3">Personalizacion de su archivo excel</h4>

								<p class="text-justify">Como anteriormente se menciono para su comodidad podra eliminar las columnas que no se requieran en la carga de sus perfiles geneticos, e incluso generar sus propios formatos manteniedo el nombre de las columnas del formato original. Sin embargo <b>la primera columna que siempre debera ser ingresada sera la del identificador (identifier)</b>, el orden de los marcadores o de los metadatos sera indistinto para su carga al sistema. Observe los siguientes ejemplos de personalizacion.</p>
								<div class="text text-center w-100">
									<img src="{{asset('images/instrucciones_perfil_genetico_ejemplo_1.png')}}">
								</div>
								<div class="text text-center w-100 mt-3">
									<img src="{{asset('images/instrucciones_perfil_genetico_ejemplo_2.png')}}">
								</div>
								<div class="text text-center w-100 mt-3">
									<img src="{{asset('images/instrucciones_perfil_genetico_ejemplo_3.png')}}">
								</div>

				        	</div>
				        </div>
				  		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="card-block">
								<div class=" card-header bg-warning">
					        		<b>Cargar archivo</b>
					        	</div>
								<div class="card-body">
									<p>
										Si desea hacer la carga de su archivo al sistema debera seleccionar el boton examinar donde podra elegir su archivo desde su directorio personal. Para concluir la operacion debera hacer click en el boton "Importar". Los formatos soportados por el sistema son xls y xlsx correspondientes a la plataforma de excel. No se aceptan otros formatos.
									</p>
									<div class="card mb-5">
										<!--Botones colapsables-->
										<div class="d-flex flex-row justify-content-between">
											@can('categorias.store')
											<div class="p-2">
												<button class="btn btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseCategoria" aria-expanded="false" aria-controls="collapseExample">
													<i class="fa fa-th-large"></i> Agregar categoria
												</button>
											</div>
											@endcan
											@can('etiquetas.store')
											<div class="p-2">
												<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseEtiquetas" aria-expanded="false" aria-controls="collapseExample">
													<i class="fa fa-bookmark"></i> Agregar Etiquetas
												</button>
											</div>
											@endcan
										</div>

										<div class="">
											<!--formulario para cateorias colapsable-->
											
											<div class="collapse float-left mb-2 ml-3" id="collapseCategoria">
											    <div class="card-header bg-secondary text-white">
											  		Crear nueva categoria
											  	</div>
											  <div class="card">
											  	{!! Form::open(['route' => 'categorias.store', 'method'=> 'POST' ]) !!}
												<div class="p-3">
													<div class="form-group">
														{!! Form::label('nombre' , 'Nombre')!!}
														{!! Form::text('nombre' , null , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese una categoria' , 'required'])!!}
													</div>
													<div class="form-group">
														{!! Form::submit('Guardar', ['class' => 'btn btn-primary mt-2']) !!}
													</div>
												</div>
												{!! Form::close() !!}
											  </div>
											</div>
											
											<!--Formulario para etiquetas colapsable-->
											
											<div class="collapse w-50 float-right mb-2 mr-3" id="collapseEtiquetas">
											  	<div class="card">
											  		<div class="card-header bg-success text-white">
												  		Crear etiquetas
												  	</div>
											  		{!! Form::open(['route' => 'etiquetas.store', 'method'=> 'POST' ]) !!}
														<div class="p-3">
															<div class="form-group">
																<p class="text-info ">Pueden ser asignadas multiples etiquetas separandolas por una coma</p>
																{!! Form::label('nombre' , 'Nombre')!!}
																{!! Form::text('nombre' , null , [ 'class' => 'form-control', 'placeholder'=> 'Ejemplo 1, Ejemplo 2, Ejemplo 3' , 'required'])!!}
																<label for="categoria_id" class="mt-2">Categoria</label>
															<select name="categoria_id" class="form-control">
															  <option disabled selected>Seleccione una categoria</option>
															  @foreach($categorias as $categoria)
															  	<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
															  @endforeach
															</select>
															</div>
															
															<div class="form-group">
																{!! Form::submit('Guardar', ['class' => 'btn btn-primary mr-3']) !!}
															</div>
														</div>
													{!! Form::close() !!}
												</div>
										</div>
									</div>
										</div>
										<div class="card">
										{!! Form::open(['route' => 'importaciones_perfiles.store', 'method'=> 'POST', 'enctype' => 'multipart/form-data' ]) !!}
										
											<div class="card-header bg-warning">Datos de la importacion</div>
				  							<div class="d-flex flex-row justify-content-between mb-3 bg-light text-dark p-3">
				  								<div class="w-25">
				  									<label for="id_fuente" class="mt-2">Fuente</label>
													<select name="id_fuente" class="form-control" required="">
													  <option disabled selected>Seleccione una Fuente</option>
													  @foreach($fuentes as $fuente)
													  	<option value="{{$fuente->id}}">{{$fuente->nombre}}</option>
													  @endforeach
													</select>
				  								</div>
												<div class="w-50">
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
												
											<div class="mb-3">
												<button class="btn btn-warning ml-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus-circle"></i> Datos adicionales</button>
												<div class="collapse  m-3 card p-3" id="collapseExample">
													<div class="d-flex flex-row justify-content-between">
														<div class="w-50">
															{!! Form::label('titulo' , 'Titutlo de la importacion')!!}
															{!! Form::text('titulo' , null , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese un titulo a su importacion'])!!}
														</div>
														
														<div class="ml-5 w-25">
															{!! Form::label('tipo_de_muestra' , 'Tipo de muestra')!!}
															{!! Form::text('tipo_de_muestra' , null , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese el tipo de muestra'])!!}
														</div>
													</div>

													{!! Form::label('observaciones' , 'Observaciones')!!}
													{!! Form::text('observaciones' , null , [ 'class' => 'form-control', 'placeholder'=> 'Ingrese sus observaciones'])!!}

												</div>
											</div>

											<div class="p-3 card-footer">
												{!! Form::file('archivo', ['required', 'files' => 'true'])!!}
												{!! Form::submit('Importar', ['class' => ' btn btn-primary ml-3']) !!}
											</div>
										</div>
										<div class="form-group">
											
										</div>
									
									{!! Form::close() !!} 
								</div>
							</div>
				  		</div>
				    </div>
				  </div>
				</div>
			  </div>
			</div>
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
@endsection