<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fuente;
use App\User;

class Busqueda extends Model
{
    protected $table = 'busquedas';

    protected $guarded = [];

    public function fuente(){
    	return $this->belongsTo(Fuente::class, 'id_fuente');
    }

    public function Usuario(){
    	return $this->belongsTo(User::class, 'id_usuario');
    }
}
