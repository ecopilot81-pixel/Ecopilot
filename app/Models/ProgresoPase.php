<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresoPase extends Model
{
    use HasFactory;
    // Un progreso de pase pertenece a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
