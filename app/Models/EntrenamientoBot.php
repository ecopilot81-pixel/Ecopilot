<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrenamientoBot extends Model
{
    use HasFactory;

    protected $table = 'entrenamiento_bots';
    protected $primaryKey = 'Id_interaccion';

    protected $fillable = [
        'tema',
        'informacion_clave'
    ];
}
