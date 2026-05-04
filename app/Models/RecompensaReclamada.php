<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecompensaReclamada extends Model
{
    use HasFactory;
    // Una recompensa reclamada pertenece a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Una recompensa reclamada pertenece a un pase de temporada.
    public function paseTemporada(){
        return $this->belongsTo(PaseTemporada::class);
    }
}
