<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Laracast\Flash\Flash;
use App\Fuente;
use App\Http\Requests\FuenteRequest;

class FuentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fuentes = Fuente::get();
        return view('fuentes.index', [
            'fuentes' => $fuentes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fuentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuenteRequest $request)
    {
        $categoria = Fuente::create([
            'nombre' => $request->input('nombre'),
            'id_externo' => $request->input('id_externo'),
            'id_interno' => $request->input('id_interno'),
            'contacto_fuente' => $request->input('contacto_fuente'),
            'correo_fuente' => $request->input('correo_fuente'),
            'telefono1_fuente' => $request->input('telefono1_fuente'),
            'telefono2_fuente' => $request->input('telefono2_fuente'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        flash('La fuente se ingreso correctamente', 'success');
        return redirect('fuentes');
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
        $fuente = Fuente::find($id);

        return view('fuentes.edit',[
            'fuente' => $fuente,
        ]);
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
        $fuente = Fuente::find($id);
        $fuente->nombre = $request->nombre;
        $fuente->id_interno = $request->id_interno;
        $fuente->id_externo = $request->id_externo;
        $fuente->contacto_fuente = $request->contacto_fuente;
        $fuente->correo_fuente = $request->correo_fuente;
        $fuente->telefono1_fuente = $request->telefono1_fuente;
        $fuente->telefono2_fuente = $request->telefono2_fuente;
        $fuente->updated_at = Carbon::now();
        $fuente->save();

        Flash('La fuente fue actualizada', 'success');

        return redirect()->route('fuentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fuente = Fuente::find($id);
        $fuente->delete();

        Flash('La fuente ' .$fuente->nombre . ' fue eliminada exitosamente', 'success');

        return redirect()->route('fuentes.index');
    }
}
