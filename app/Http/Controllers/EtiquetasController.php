<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Categoria;
use App\Etiqueta;
use App\Http\Requests\EtiquetaRequest;
use Laracast\Flash\Flash;


class EtiquetasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /** Elemento colleccion de todas las etiquetas */
        $etiquetas = Etiqueta::orderBy('id','desc')->get();

        return view('etiquetas.index', [
            'etiquetas' => $etiquetas,
        ]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = DB::table('categorias')->get();
        return view('etiquetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->categoria_id == ''){
            $categoria_sin_asignar = DB::table('categorias')->where('nombre', '=', 'SIN ASIGNAR')->get();
        }

        $categoria = Etiqueta::create([
            'nombre' => $request->input('nombre'),
            'categoria_id' => $request->categoria_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        flash('La categoria se ingreso correctamente', 'success');
        return redirect('etiquetas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $etiqueta = Etiqueta::find($id);
        $categorias = Categoria::get();

        return view('etiquetas.edit',[
            'etiqueta' => $etiqueta,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EtiquetaRequest $request, $id)
    {
        $etiqueta = Etiqueta::find($id);
        $etiqueta->nombre = $request->nombre;
        $etiqueta->categoria_id = $request->categoria_id;
        $etiqueta->updated_at = Carbon::now();
        $etiqueta->save();
        
        Flash('La etiqueta se actualizo correctamente', 'success');

        return redirect()->route('etiquetas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etiqueta = Etiqueta::find($id);
        $etiqueta->delete();

        Flash('La etiqueta ' .$etiqueta->nombre . ' fue eliminada exitosamente', 'success');

        return redirect()->route('etiquetas.index');
    }
}
