<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $table = 'zonas';
    protected $primaryKey = 'Id_zona';
    protected $fillable = ['nombre_zona', 'codigo_postal', 'estado_zona'];

    public function puntosRecolecion(){
        return $this->hasMany(PuntoRecolecion::class, 'id_zona', 'Id_zona');
    }
}
