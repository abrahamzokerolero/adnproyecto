<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PerfilGenetico;
use App\EtiquetaAsignada;
use App\User;
use App\Busqueda;
use App\Categoria;
use App\Fuente;
use App\ImportacionFrecuencia;
use App\Marcador;
use App\EstatusBusqueda;
use Illuminate\Support\Facades\DB;


class BusquedasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $busquedas = Busqueda::where('id_estatus_busqueda', '<>', 3)->get();
        return view('busquedas.index', [
            'busquedas' => $busquedas,
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
        $categorias = Categoria::with(array('etiquetas' => function($query){$query->where('desestimado', '=', 0);}))->orderBy('nombre', 'ASC')->where('desestimado', '=', 0)->get();
        $tablas_de_frecuencias = ImportacionFrecuencia::get();
        return view('busquedas.create',[
            'categorias' => $categorias,
            'fuentes' => $fuentes,
            'tablas_de_frecuencias' => $tablas_de_frecuencias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Busqueda individual
    public function store(Request $request)
    {   
        $request->etiquetas;
        $formato_array_sql = '';

        foreach ($request->etiquetas as $etiqueta) {
            $formato_array_sql += '<Id IdEtiqueta = \"$etiqueta\" /> ';

        }

        //$prueba = DB::select("EXEC PruebaArreglo '<ROOT> <Id IdEtiqueta = \"1229\" /><Id IdEtiqueta = \"1230\" /><Id IdEtiqueta = \"1231\" /></ROOT>'");
        dd($formato_array_sql);


        $marcadores_minimos_en_la_busqueda = $request->marcadores_minimos;
        $numero_de_exclusiones = $request->exclusiones;
        $descartar_perfiles_en_revision = $request->descartar_perfiles_en_revision;

        // Se obtiene el perfil objetivo
        $perfil_objetivo = PerfilGenetico::where('identificador', '=', $request->perfil)->first();
        
        if($perfil_objetivo <> null){
            // Se crea un arreglo donde se guardaran los ids de los perfiles etiquetados
            $array_de_ids_perfiles = array();

            foreach ($request->etiquetas as $etiqueta) {
                // Se buscan todos los perfiles por cada una de las etiquetas
                $perfiles_etiquetados = EtiquetaAsignada::where('id_etiqueta', '=', $etiqueta)->get();
                foreach ($perfiles_etiquetados as $perfil){
                    if($perfil->perfil_genetico->id <> $perfil_objetivo->id){
                        // Se verfica que no esten desestimados
                        if($perfil->perfil_genetico->desestimado == 0){
                            // Se verfica que no sean perfiles repetidos
                            if($perfil->perfil_genetico->es_perfil_repetido == 0){
                                // Si el usuario quiso descartar los perfiles en revision
                                if($descartar_perfiles_en_revision == 1){
                                    // Se verifican que los perfiles no esten en revision
                                    if($perfil->perfil_genetico->requiere_revision <> 1){
                                        // se comprueba el minimo de marcadores
                                        if($perfil->perfil_genetico->numero_de_marcadores >= $marcadores_minimos_en_la_busqueda){
                                            // se comprueba que el id del perfil no exista exista en el arreglo de ids para agregarlo y no se repita en la busqueda
                                            if(in_array($perfil->perfil_genetico->id, $array_de_ids_perfiles) == false){
                                                array_push($array_de_ids_perfiles, $perfil->perfil_genetico->id);
                                            }
                                        }
                                    }
                                }
                                // si no se descartaron los perfiles en revision
                                else{ 
                                    // se comprueba el minimo de marcadores
                                    if($perfil->perfil_genetico->numero_de_marcadores >= $marcadores_minimos_en_la_busqueda){
                                        // se comprueba que el id del perfil no exista exista en el arreglo de ids para agregarlo y no se repita en la busqueda
                                        if(in_array($perfil->perfil_genetico->id, $array_de_ids_perfiles) == false){
                                            array_push($array_de_ids_perfiles, $perfil->perfil_genetico->id);
                                        }
                                    }
                                }
                            }   
                        }
                    }       
                }
            }

            if(empty($array_de_ids_perfiles)){
                dd('no hay perfiles en las etiquetas seleccionadas');
            }
            else{
                $array_de_perfiles_geneticos = array();
                $usuario = User::find(Auth::id());
                $perfiles_geneticos = collect();

                foreach ($array_de_ids_perfiles as $id_perfil) {
                    $perfil_genetico = PerfilGenetico::find($id_perfil);
                    if($usuario->estado->nombre == 'CNB'){
                        $perfiles_geneticos->push($perfil_genetico);                        
                    }
                    else{
                       if($usuario->estado->id == $perfil_genetico->id_estado){
                            $perfiles_geneticos->push($perfil_genetico);       
                       }    
                    } 
                }
                
                dd($perfiles_geneticos);

                $marcadores_en_perfil_objetivo = array();

                foreach ($perfil_objetivo->alelos as $alelo) {
                    array_push($marcadores_en_perfil_objetivo, $alelo->marcador->id);   
                }
                
                dd($marcadores_en_perfil_objetivo);

                foreach ($perfiles_geneticos as $perfil_genetico) {
                    foreach ($perfil_genetico->alelos as $alelo) {
                                
                    }
                }

                

            }
        }
        else{
            flash('El perfil objetivo seleccionado no existe', 'danger');
            return redirect()->route('busquedas.index');
        }

    }

    public function store2(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $busqueda = Busqueda::with('resultados')->find($id); 
        $marcadores = Marcador::get();
        $estatus_disponibles = EstatusBusqueda::where('id', '<>', 1 )->get();

        return view('busquedas.show',[
            'busqueda' => $busqueda,
            'marcadores' => $marcadores,
            'estatus_disponibles' => $estatus_disponibles,
        ]);
    }

    public function concluir(Request $request,$id)
    {   
        $busqueda = Busqueda::find($id);
        $busqueda->conclusiones = $request->conclusiones;
        $busqueda->id_estatus_busqueda = $request->id_estatus_busqueda;
        $busqueda->save();

        return redirect()->route('busquedas.index');
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
        //
    }

    public function ventana(){
        $usuario = User::find(Auth::id());

        if($usuario->estado->nombre == "CNB"){
            $perfiles_geneticos = PerfilGenetico::where('requiere_revision', '=', 0)->get();
        }
        else{
            $perfiles_geneticos = PerfilGenetico::where('id_estado', '=', $usuario->id_estado)->where('requiere_revision', '=', 0)->get();   
        }      
        return view('busquedas.ventana',[
            'perfiles_geneticos' =>$perfiles_geneticos,
        ]);
    }
}
