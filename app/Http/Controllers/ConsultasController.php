<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perfile;

class ConsultasController extends Controller
{
    public function verUsuario(){
        $perfil = Perfile::find(2);

        return $perfil->user;
    }
}
