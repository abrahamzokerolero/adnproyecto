<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Etiqueta;
use App\Categoria;
use App\Http\Requests\CategoriaRequest;
use App\Http\Requests\EtiquetaRequest;
use Laracast\Flash\Flash;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categorias = DB::table('categorias')->get();
        return view('categorias.index')->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        $categoria = Categoria::create([
            'nombre' => $request->input('nombre'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        flash('La categoria se ingreso correctamente', 'success');

        return redirect('categorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        $etiquetas = Etiqueta::where('categoria_id', '=', $id)->get();

        return view('categorias.show', [
            'categoria' => $categoria,
            'etiquetas' => $etiquetas,
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
        $categoria = Categoria::find($id);
        return view('categorias.edit')->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->updated_at = Carbon::now();
        $categoria->save();

        Flash('La categoria cambio de nombre a: <b>' . $categoria->nombre . '</b>', 'success');

        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        Flash('La categoria ' .$categoria->nombre . ' fue eliminada exitosamente sin embargo debera asignar sus etiquetas manualmente', 'success');

        return redirect()->route('categorias.index');
    }

    public function create_etiqueta($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.create_etiqueta')->with('categoria', $categoria);
    }

    public function create_etiqueta_store(EtiquetaRequest $request)
    {

        $categoria = Etiqueta::create([
            'nombre' => $request->input('nombre'),
            'categoria_id' => $request->input('categoria_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        flash('La etiqueta se ingreso correctamente', 'success');

        return redirect('categorias');
    }
}
