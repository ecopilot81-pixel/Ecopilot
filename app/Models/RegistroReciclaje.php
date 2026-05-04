<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroReciclaje extends Model
{
    use HasFactory;
    // Un registro de reciclaje pertenece a un usuario.
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Un registro de reciclaje pertenence a un tipo de material.
    public function tipoMaterial() {
        return $this->belongsTo(TipoMateriale::class);
    }

    // Un registro de reciclaje pertenence a un punto de recoleccion.
    public function puntoRecoleccion() {
        return $this->belongsTo(PuntoRecolecione::class);
    }
}
