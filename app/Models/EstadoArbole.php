<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoArbole extends Model
{
    use HasFactory;
    // Un estado de arbol pertenece a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
