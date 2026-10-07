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
use App\Models\InventarioUsuario;
use App\Models\Noticia;
use App\Models\PuntoRecolecione;
use App\Models\RankingSemanale;

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

    //Consultas Kamila: 
    // Lista noticias e incluye la categoría y el usuario que las publicó.
    public function noticiasConCategoriaYAutor(){
        return Noticia::with(['categoriaGlobal', 'user'])->get();
    }

    // Lista puntos de recolección junto con la zona a la que pertenecen.
    public function puntosConZona(){
        return PuntoRecolecione::with('zona')->get();
    }

    // Lista reciclajes con el usuario y el tipo de material de cada registro.
    public function reciclajesConUsuarioYMaterial(){
        return RegistroReciclaje::with(['user', 'tipoMaterial'])->get();
    }

    // Ordena los rankings semanales de mayor a menor puntaje e incluye al usuario.
    public function rankingsOrdenados(){
        return RankingSemanale::with('user')
            ->orderByDesc('puntos_semanales')
            ->get();
    }

    // Lista usuarios junto con su rol y zona.
    public function usuariosConRolYZona(){
        return User::with(['role', 'zona'])->get();
    }

    // Cuenta los reciclajes de cada usuario y ordena del mayor al menor total.
    public function usuariosConConteoReciclajes(){
        return User::withCount('registrosReciclaje')
            ->orderByDesc('registros_reciclaje_count')
            ->get();
    }

    // Cuenta los registros de reciclaje por tipo de material y los ordena por cantidad.
    public function materialesConConteoReciclajes(){
        return TipoMateriale::withCount('registroReciclajes')
            ->orderByDesc('registro_reciclajes_count')
            ->get();
    }

    // Cuenta las noticias y los contenidos educativos de cada categoría global.
    public function categoriasConConteos(){
        return CategoriaGlobal::withCount(['noticias', 'contenidosEducativos'])->get();
    }

    // Lista los artículos del inventario con el usuario y el artículo de tienda asociado.
    public function inventariosDetallados(){
        return InventarioUsuario::with(['user', 'tiendaItem'])->get();
    }

    // Lista los feedbacks visibles e incluye el usuario que los envió.
    public function feedbacksVisibles(){
        return Feedback::with('user')->where('estado_visible', true)->get();
    }

    //Alejandro:


}
