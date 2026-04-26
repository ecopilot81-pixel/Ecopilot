<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionSistema extends Model
{
    use HasFactory;

    protected $table = 'configuracion_sistemas';
    protected $primaryKey = 'Id_configuracion';

    protected $fillable = ['clave', 'valor'];
}
