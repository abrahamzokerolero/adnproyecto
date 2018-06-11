<?php

/*
|--------------------------------------------------------------------------
| Rutas de Auth y de Welcome
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/', "PagesController@home");

/*
|--------------------------------------------------------------------------
| Rutas a categorias
|--------------------------------------------------------------------------
| Resource agrupa el CRUD de categorias / ver con php artisan routes:list
*/

Route::resource('categorias', 'CategoriasController')->middleware('auth');
Route::get('categorias/{id}/destroy',[
	'uses' => 'CategoriasController@destroy',
	'as' =>	  'categorias.destroy'
])->middleware('auth');
Route::get('categorias/{id}/etiqueta/create',[
	'uses' => 'CategoriasController@create_etiqueta',
	'as' =>	  'categorias.etiqueta.create'
])->middleware('auth');
Route::post('categorias/etiqueta/create',[
	'uses' => 'CategoriasController@create_etiqueta_store',
	'as' =>	  'categorias.etiqueta.create.store'
])->middleware('auth');


/*
|--------------------------------------------------------------------------
| Rutas a etiquetas
|--------------------------------------------------------------------------
| Resource agrupa el CRUD de etiquetas / ver con php artisan routes:list
*/

Route::resource('etiquetas', 'EtiquetasController')->middleware('auth');
Route::get('etiquetas/{id}/destroy',[
	'uses' => 'EtiquetasController@destroy',
	'as' =>	  'etiquetas.destroy'
])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Rutas a fuentes
|--------------------------------------------------------------------------
| Resource agrupa el CRUD de categorias / ver con php artisan routes:list
*/

Route::resource('fuentes', 'FuentesController')->middleware('auth');
Route::get('fuentes/{id}/destroy',[
	'uses' => 'FuentesController@destroy',
	'as' =>	  'fuentes.destroy'
])->middleware('auth');