<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMateriale extends Model
{
    use HasFactory;

    protected $table = 'tipo_materiales';
    protected $primaryKey = 'Id_material';
}
