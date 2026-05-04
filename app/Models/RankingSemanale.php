<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingSemanale extends Model
{
    use HasFactory;
    // Un ranking semanal pertenece a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
