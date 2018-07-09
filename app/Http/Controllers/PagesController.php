<?php

namespace App\Http\Controllers;

use App\Fuente;
use App\Etiqueta;
use App\User;
use App\ImportacionPerfil;
use App\PerfilGenetico;
use App\Categoria;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){

    	$numero_fuentes = Fuente::get()->count();
    	$numero_etiquetas = Etiqueta::get()->count();
    	$numero_usuarios = User::get()->count();
    	$numero_importaciones = ImportacionPerfil::get()->count();
    	$numero_perfiles = PerfilGenetico::get()->count();
    	$numero_categorias = Categoria::get()->count();

		return view('welcome',[
			'numero_fuentes' => $numero_fuentes,
			'numero_etiquetas' => $numero_etiquetas,
			'numero_usuarios' => $numero_usuarios,
			'numero_importaciones' => $numero_importaciones,
			'numero_perfiles' => $numero_perfiles,
			'numero_categorias' => $numero_categorias,
		]);
    }
}
