<?php

namespace App\Http\Controllers;

use App\Fuente;
use App\Etiqueta;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
    	$numero_fuentes = Fuente::get()->count();
    	$numero_etiquetas = Etiqueta::get()->count();
    	$numero_usuarios = User::get()->count();

		return view('welcome',[
			'numero_fuentes' => $numero_fuentes,
			'numero_etiquetas' => $numero_etiquetas,
			'numero_usuarios' => $numero_usuarios,
		]);
    }
}
