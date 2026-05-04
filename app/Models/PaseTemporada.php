<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaseTemporada extends Model
{
    use HasFactory;

    public function recompensasReclamadas(){
        return $this->hasMany(RecompensaReclamada::class);
    }

    public function tiendaItem(){
        return $this->belongsTo(TiendaItem::class);
    }
}
