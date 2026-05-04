<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioUsuario extends Model
{
    use HasFactory;
    // Un invenatario de usuario pertenence a un usuario.
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Un inventario de usuario pertenece a un item de tienda.
    public function tiendaItem(){
        return $this->belongsTo(TiendaItem::class);
    }
}
