<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perfile;
use App\Models\User;
use App\Models\Feedback;
use App\Models\CategoriaGlobal;

class ConsultasController extends Controller
{
    public function verUsuario(){
        $perfil = Perfile::find(4);

        return $perfil->user;
    }

    public function verPerfil(){
        $user = User::find(3);

        return $user->perfil;
    }
// CONSULTA PARA VER LOS FEEDBACKS DE LOS USUARIOS Y LOS NOMBRES DE LOS USUARIOS QUE LOS HAN ENVIADO
    public function verFeedbacks(){
        $feedback = Feedback::with('User')->get();
        return $feedback;
    }

    public function verContenidoEducativo(){
        $user = User::find(1);
        $use = User::with('contenidosEducativos.categoriaGlobal')->get();
        return $use;
    }
}