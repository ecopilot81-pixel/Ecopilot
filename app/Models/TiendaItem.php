<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiendaItem extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class, 'material_por_punto')
                ->withPivot('disponible', 'fecha_vinculacion');
    }

    public function paseTemporadas(){
        return $this->hasMany(PaseTemporada::class);
    }

    public function categoriaTienda(){
        return $this->belongsTo(CategoriaTienda::class);
    }
}
