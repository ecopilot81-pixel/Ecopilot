<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMateriale extends Model
{
    use HasFactory;

    public function puntoRecolecciones(){
        return $this->belongsToMany(PuntoRecolecione::class, 'material_por_punto')
                    ->withPivot('disponible', 'fecha_vinculacion');
    }

    public function registroReciclajes() {
        return $this->hasMany(RegistroReciclaje::class);
    }
}
