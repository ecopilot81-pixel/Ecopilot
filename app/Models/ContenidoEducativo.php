<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenidoEducativo extends Model
{
    use HasFactory;
    // Un contenido educativo pertenece a una categoria global.
    public function categoriaGlobal(){
        return $this->belongsTo(CategoriaGlobal::class);
    }
    // Un contenido educativo pertenece a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
