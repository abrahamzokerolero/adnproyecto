<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImportacionPerfil;
use App\PerfilGenetico;
use App\TipoDeMetadato;
use App\Metadato;
use App\EtiquetaAsignada;
use App\Etiqueta;
use App\User;
use App\Alelo;
use App\Fuente;
use App\Categoria;
use App\Marcador;
use Validator;                          // Para validar el formulario de carga del excel
use Maatwebsite\Excel;                  // Para la lectura del excel
use Illuminate\Support\Facades\Input;   // Para saber el nombre del archivo recibido
use Illuminate\Support\Facades\Auth;    // Para obtener datos del usuario en la session

class ImportacionesPerfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::find(Auth::id());

        if($usuario->estado->nombre == "CNB"){
            $importaciones = ImportacionPerfil::get();
        }
        else{
            $importaciones = ImportacionPerfil::where('id_estado', '=', $usuario->id_estado)->get();   
        }        
        return view('importaciones_perfiles.index', [
            'importaciones' => $importaciones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fuentes = Fuente::get();
        $categorias = Categoria::with('etiquetas')->orderBy('nombre', 'ASC')->get();
        
        return view('importaciones_perfiles.create',[
            'fuentes' => $fuentes,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $this->validate($request, [
            'id_fuente' => 'required',
        ],[
            'id_fuente.required' => 'Debe seleccionar una fuente',
        ]);


        $validator = Validator::make(
            ['archivo' => Input::file('archivo')],
            ['archivo' => 'mimes:xls,xlsx']
        );

        // Comprobacion de validacion
        if($validator->passes()){

            // Guardado del archivo de excel // ruta storage y nombre
            $ruta_archivo = $request->file('archivo')->storeAs('public', $request->file('archivo')->getClientOriginalName());

            // Obtencion del nombre original del archivo
            $nombreDocumento = $request->file('archivo')->getClientOriginalName();

            $usuario = User::find(Auth::id());
            $consecutivo = ImportacionPerfil::where('id_estado', '=',$usuario->id_estado)->count() + 1;

            //Creacion de los datos de importacion
            $importacion_perfiles = ImportacionPerfil::create([
                'nombre' => $nombreDocumento,
                'identificador' => 'I-'. $usuario->id_estado . '-' . $consecutivo,
                'id_fuente' => $request->id_fuente,
                'id_usuario' => Auth::id(),
                'numero_de_perfiles' => 0,
                'numero_de_marcadores' => 0,
                'tipo_de_muestra' => $request->tipo_de_muestra,
                'observaciones' => $request->observaciones,
                'titulo' => $request->titulo,
                'id_estado' => $usuario->id_estado,
            ]);

            
            //Lectura del archivo Excel
            \Excel::load('storage/app/'.$ruta_archivo, function ($reader) use(&$request) {

                $filas = $reader->get();
                $numero_filas = 0; // se cuenta el numero de perfiles
                
                $contador = 0;  // Contador para determinar el numero de marcadores maximos usados por cada perfil
                $numero_de_marcadores = 0; // aumentara en uno cada vez que el contador le supere

                $importacion = ImportacionPerfil::all();
                $id_importacion = $importacion->last()->id; // se busca el id de la importacion creada

                $perfil_genetico;   // se mantiene el valor hasta que se cambie de fila
                $usuario = User::find(Auth::id());

                /* Recorrido de cada fila del documento*/
                foreach ($filas as $fila) {
                    $contador = 0;  // Se inicializa el contador que enumera los marcadores por perfil
                    $debe_revisarse = false;    // El perfil comienza con estatus falso

                    $motivos_de_revision;       // Contendra un string del motivo de la revision

                    $consecutivoPerfil = PerfilGenetico::where('id_estado', '=',$usuario->id_estado)->count() + 1;

                    /*Extraccion del valor de la columna y su valor*/
                    foreach ($fila as $key => $value) {
                        $value = trim($value);

                        // si el valor de una celda esta vacio no se guarda nada
                        if($value <> null){
                            // se busca el marcador entre los existentes para determinar si es o no un metadato
                            $marcador = Marcador::where('nombre', '=', $key)->first();
                            // si existe se pasa a la creacion de los alelos del perfil genetico
                            if( $marcador <> null){

                                // se obtienen los 2 valores posibles de los alelos del perfil

                                $alelos = explode(',', $value);

                                if($marcador->id_tipo_de_marcador == 1 || $marcador->nombre == 'dys385'){
                                    if(count($alelos) == 1){
                                        $value = $value . ',' . $value;
                                        $alelos = explode(',', $value);
                                    }
                                }

                                // si hay mas de un valor en los alelos se crean los 2 registros en la base
                                $marcador = Marcador::where('nombre','=',$key)->first();
                                if(count($alelos)>1){
                                    if(count($alelos)==2){
                                        $alelo = Alelo::create([
                                            'id_perfil_genetico' => $perfil_genetico->id,
                                            'id_marcador' => $marcador->id,
                                            'alelo_1' => trim($alelos[0]),
                                            'alelo_2' => trim($alelos[1]),
                                        ]);
                                    }
                                    else{
                                        if(count($alelos)==3){
                                            $alelo = Alelo::create([
                                                'id_perfil_genetico' => $perfil_genetico->id,
                                                'id_marcador' => $marcador->id,
                                                'alelo_1' => trim($alelos[0]),
                                                'alelo_2' => trim($alelos[1]),
                                                'alelo_3' => trim($alelos[2]),
                                            ]);
                                        }
                                        else{
                                            if(count($alelos)==4){
                                                $alelo = Alelo::create([
                                                    'id_perfil_genetico' => $perfil_genetico->id,
                                                    'id_marcador' => $marcador->id,
                                                    'alelo_1' => trim($alelos[0]),
                                                    'alelo_2' => trim($alelos[1]),
                                                    'alelo_3' => trim($alelos[2]),
                                                    'alelo_4' => trim($alelos[3]),
                                                ]);
                                            }
                                            else{
                                                $alelo = Alelo::create([
                                                    'id_perfil_genetico' => $perfil_genetico->id,
                                                    'id_marcador' => $marcador->id,
                                                    'alelo_1' => trim($alelos[0]),
                                                    'alelo_2' => trim($alelos[1]),
                                                    'alelo_3' => trim($alelos[2]),
                                                    'alelo_4' => trim($alelos[3]),
                                                    'alelo_5' => trim($alelos[4]),
                                                ]);   
                                            }    
                                        }
                                    }
                                }
                                else{
                                    $alelo = Alelo::create([
                                        'id_perfil_genetico' => $perfil_genetico->id,
                                        'id_marcador' => $marcador->id,
                                        'alelo_1' => trim($alelos[0]),
                                    ]);
                                }

                                // suma 1 el contador por cada marcador no vacio detectado en el perfil
                                $contador++;
                                
                                // si el contador supera al valor de numero de marcadores suma 1
                                if($numero_de_marcadores < $contador){
                                    $numero_de_marcadores++;
                                }
                                 
                            }

                            // si no es marcador se verifica si la columna es el identificador externo
                            else{
                                // si es el identificador se registra el perfil genetico
                                if($key == 'identifier'){
                                    $perfil_genetico = PerfilGenetico::create([
                                        'id_importacion' => $id_importacion,
                                        'identificador' => 'G-'. $usuario->id_estado . '-' . $consecutivoPerfil,
                                        'id_usuario' => Auth::id(),
                                        'id_fuente' => $request->id_fuente,
                                        'id_externo' => $value,
                                        'id_estado' => $usuario->id_estado,
                                    ]);

                                    $numero_filas++;

                                    if($request->etiquetas<>null){

                                        foreach($request->etiquetas as $etiqueta){

                                            $id_etiqueta = Etiqueta::find($etiqueta);

                                            $etiqueta_asignada = EtiquetaAsignada::create([
                                                'id_etiqueta' => $id_etiqueta->id,
                                                'id_perfil_genetico' => $perfil_genetico->id,
                                            ]);
                                        } 
                                    }
                                }
                                // si no es el identificador se determina que es un metadato
                                else{
                                    // se busca si existe el tipo de metadato en la base
                                    $tipo_de_metadato = TipoDeMetadato::where('nombre','=',$key)->first();
                                    // si no existe se crea un nuevo tipo de metadato
                                    if($tipo_de_metadato == null){
                                        $tipo_de_metadato = TipoDeMetadato::create([
                                            'nombre' => $key,
                                        ]);    
                                    }
                                    // si existe unicamente si obtiene su id para generar el metadato del perfil
                                    $metadato = Metadato::create([
                                        'id_perfil_genetico' => $perfil_genetico->id,
                                        'id_tipo_de_metadato' => $tipo_de_metadato->id,
                                        'dato' => $value,
                                    ]);
                                }
                            }
                        }

                    }

                    $numero_de_homocigotos = 0;

                    foreach ($perfil_genetico->alelos as $marcador_en_perfil) {
                        if($marcador_en_perfil->alelo_1 == $marcador_en_perfil->alelo_2){
                            $numero_de_homocigotos++;
                        }
                    }

                    $perfil_genetico->numero_de_homocigotos = $numero_de_homocigotos;
                    $perfil_genetico->save();

                    echo $numero_de_homocigotos;

                    if($perfil_genetico->numero_de_homocigotos>5){
                        $perfil_genetico->requiere_revision = 1;
                        $perfil_genetico->save();                        
                    }

                    $perfil_genetico->numero_de_marcadores = $perfil_genetico->alelos->count();
                    $perfil_genetico->save();

                    if($perfil_genetico->numero_de_marcadores<13){
                        $perfil_genetico->requiere_revision = 1;
                        $perfil_genetico->save();
                    }

                    $datos_perfil = array();

                    foreach ($perfil_genetico->alelos as $perfil) {
                      array_push( $datos_perfil, $perfil->id_marcador, $perfil->alelo_1, $perfil->alelo_2); 
                    }

                    
                    $genotipos = PerfilGenetico::where('desestimado', '=', 0)->orWhere('es_perfil_repetido', '=' , 0)->get();

                    foreach($genotipos as $genotipo){
                      $datos_perfil_a_comparar = array();  
                      foreach ($genotipo->alelos as $perfil_acomparar) {
                        array_push($datos_perfil_a_comparar, $perfil_acomparar->id_marcador,$perfil_acomparar->alelo_1, $perfil_acomparar->alelo_2);
                      }
                      
                      if( implode($datos_perfil) == implode($datos_perfil_a_comparar)){
                        if($genotipo->id <> $perfil_genetico->id){
                          $perfil_genetico->es_perfil_repetido = 1;
                          $perfil_genetico->id_perfil_original = $genotipo->id;
                          $perfil_genetico->id_estado_perfil_original = $genotipo->id_estado;
                          $perfil_genetico->save();
                        }
                      }
                    }
                }

                $importacion = ImportacionPerfil::find($id_importacion);

                $importacion->numero_de_perfiles = $importacion->perfiles_geneticos->count();
                $importacion->numero_de_marcadores = $numero_de_marcadores;
                $importacion->save();

                if($importacion->perfiles_geneticos->count() == 0){
                    $importacion->delete();
                    flash('El archivo no pudo ser importado ya que todos los perfiles ya se encontraban en la base de datos', 'danger');
                }
                else{
                    flash('El archivo fue importado', 'success');
                }

            });
            return redirect()->route('importaciones_perfiles.index');
        }
        else{
            flash('El formato del archivo no es correcto', 'warning');
            return redirect()->route('importaciones_perfiles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $importacion_perfiles = ImportacionPerfil::find($id);
        $perfiles_geneticos = PerfilGenetico::where('id_importacion','=',$id)->get();
        return view('importaciones_perfiles.show', [
            'importacion_perfiles' => $importacion_perfiles,
            'perfiles_geneticos' =>$perfiles_geneticos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $importacion = ImportacionPerfil::find($id);
        $importacion->delete();

        Flash('Se elimino correctamente la importacion seleccionada', 'success');
        return redirect()->route('importaciones_perfiles.index');
    }
}
