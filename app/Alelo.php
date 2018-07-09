<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PerfilGenetico;
use App\Marcador;

class Alelo extends Model
{
    protected $table = 'alelos';

    protected $guarded = [];

    public function perfil_genetico(){
    	return $this->belongsTo(PerfilGenetico::class, 'id_perfil_genetico');
    }

    public function marcador(){
    	return $this->belongsTo(Marcador::class, 'id_marcador');
    }
}
