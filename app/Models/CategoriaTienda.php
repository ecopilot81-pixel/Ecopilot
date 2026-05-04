<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaTienda extends Model
{
    use HasFactory;
    // Una categoria de tienda puede tener muchos items de tienda.
    public function tiendaItems(){
        return $this->hasMany(TiendaItem::class);
    }
}
