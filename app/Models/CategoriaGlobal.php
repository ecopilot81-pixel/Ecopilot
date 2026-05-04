<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaGlobal extends Model
{
    use HasFactory;
    // Una categoría global puede clasificar muchas noticias.
    public function noticias(){
        return $this->hasMany(Noticia::class);
    }
    // Una categoría global puede tener muchos contenidos educativos.
    public function contenidosEducativos(){
        return $this->hasMany(ContenidoEducativo::class);
    }
}
