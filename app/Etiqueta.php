<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categoria;

class Etiqueta extends Model
{
    protected $table = 'etiquetas';

    protected $guarded = [];

    public function categoria(){
    	return $this->belongsTo(Categoria::class, 'id');
    }
}
