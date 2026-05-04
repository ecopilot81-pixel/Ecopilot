<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoRecolecione extends Model
{
    use HasFactory;
    // Un punto de recoleccion tiene muchos tipos de material.
    public function tipoMateriales(){
        return $this->belongsToMany(TipoMateriale::class, 'material_por_puntos')
                    ->withPivot('disponible', 'fecha_vinculacion');
    }
    // Un punto de recoleccion tiene muchos registros de reciclaje. 
    public function registroReciclajes(){
        return  $this->hasMany(RegistroReciclaje::class);
    }
    // Un punto de recoleccion pertenece a una zona
    public function zona(){
        return $this->belongsTo(Zona::class);
    }
}
