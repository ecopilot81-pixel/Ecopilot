<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaGlobal extends Model
{
    use HasFactory;

    protected $table = 'categoria_globals';
    // Llave perzonalizada
    protected $primaryKey = 'Id_categoria';
    // Campos que se permite llenar
    protected $fillable = ['nombre_categoria', 'icono'];
    // Una categoría tiene muchas noticias
    public function noticias(){
        return $this->hasMany(Noticia::class, 'id_categoria','Id_categoria');
    }
    // Una categoría tiene muchos contenidos educativos
    public function contenidosEducativos(){
        return $this->hasMany(ContenidoEducativo::class,'id_categoria', 'Id_categoria');
    }
}
