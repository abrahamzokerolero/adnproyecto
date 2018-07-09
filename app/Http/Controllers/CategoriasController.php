<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Etiqueta;
use App\Categoria;
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
        return view('categorias.index', [
            'categorias' => $categorias
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
            'nombre' =>'min:3|max:90|required|unique:categorias' 
        ],[
            'nombre.min' => 'El tamaño minimo del nombre de la categoria es de 3 caracteres',
            'nombre.max' => 'El tamaño maximo del nombre de la categoria deber de ser de 90 caracteres',
            'nombre.required' => 'El campo debe ser llenado',
            'nombre.unique' => 'El nombre de la categoria asigando ya se encuentra en uso'
        ]);

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
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'nombre' =>"min:3|max:90|required|unique:categorias,nombre,$id", 
        ],[
            'nombre.min' => 'El tamaño minimo del nombre de la categoria es de 3 caracteres',
            'nombre.max' => 'El tamaño maximo del nombre de la categoria deber de ser de 90 caracteres',
            'nombre.required' => 'El campo debe ser llenado',
        ]);

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
}
