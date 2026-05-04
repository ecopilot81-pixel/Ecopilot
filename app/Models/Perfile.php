<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfile extends Model
{
    use HasFactory;
    // Un perfil pertenece a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }
}
