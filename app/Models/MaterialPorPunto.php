<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPorPunto extends Model
{
    use HasFactory;
    // Un material por punto pertenence a un tipo de material.
    public function tipoMaterial(){
        return $this->belongsTo(TipoMateriale::class);
    }
    // Un materialpor punto pertenence a un punto de recoleccion .
    public function puntoRecoleccion(){
        return $this->belongsTo(PuntoRecolecione::class);
    } 
}
