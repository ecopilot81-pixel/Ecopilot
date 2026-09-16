<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perfile;
use App\Models\User;
use App\Models\Feedback;
use App\Models\CategoriaGlobal;
use App\Models\TipoMateriale;
use App\Models\MaterialPorPunto;
use App\Models\RegistroReciclaje;
use App\Models\Role;

class ConsultasController extends Controller
{
    // VER PERFIL
    public function verPerfil(){
        $perfil = Perfile::find(4);

        return $perfil->user;
    }
    // VER USUARIO
    public function verUsuario(){
        $user = User::find(3);

        return $user->perfil;
    }
// CONSULTA PARA VER LOS FEEDBACKS DE LOS USUARIOS
    public function verFeedbacks(){
        $feedback = Feedback::with('User')->get();
        return $feedback;
    }
    // CONSULTA PARA VER QUE ADMIN HA PUBLICADO UN CONTENIDO EDUCATIVO Y EN QUE CATEGORIA PERTENECE
    public function verContenidoEducativo(){
        $user = User::find(1);
        $use = User::with('contenidosEducativos.categoriaGlobal')->find(1);
        return $use;
    }

    // CONSULTA PARA VER EL USUARIO Y EL ROL DE ESE USUARIO
    public function verRolUsuario(){
        $materialPorPunto = User::with('role')->find(2);
        return $materialPorPunto;
    }

    public function verRanking(){
        $ranking = User::with('rankingsSemanales')->find(2);
        return $ranking;
    }

    public function verZona(){
        return $zona = User::with('zona')->get();
    }

    public function userAdministrador(){
        $usuarios = User::whereHas('role', function ($query) {
            $query->where('nombre', 'Usuario');
        })->get();
        return $usuarios;
    }

    public function userMaterial(){
        $material = User::whereHas('registrosReciclaje.tipoMaterial', function ($query) {
            $query->where('nombre', 'Botellas PET');
        })->with('registrosReciclaje.tipoMaterial')->get();
        return $material;
    }

    public function ver(){
        $anidada = CategoriaGlobal::with('noticias')->find(1);
        return $anidada;
    }

}
