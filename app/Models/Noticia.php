<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    // Un noticia pertenece a una categoria global.
    public function categoriaGlobal(){
        return $this->belongsTo(CategoriaGlobal::class);
    }
    // Una noticia pertenece a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
