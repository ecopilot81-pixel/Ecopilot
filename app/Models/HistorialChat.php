<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialChat extends Model
{
    use HasFactory;
    // Un historial de chat pertenece a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
