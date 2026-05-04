<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;
    // Una zona pertenence a muchos usuarios.
    public function users(){
        return $this->hasMany(User::class);
    }
    // Una zona puede tener muchos puntos de recoleccion.
    public function puntorecoleciones(){
        return $this->hasMany(PuntoRecolecione::class);
    }
}
