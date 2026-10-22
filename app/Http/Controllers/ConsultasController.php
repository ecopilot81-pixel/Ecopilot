<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perfile;
use App\Models\User;
use App\Models\Feedback;
use App\Models\CategoriaGlobal;
use App\Models\ContenidoEducativo;
use App\Models\TipoMateriale;
use App\Models\MaterialPorPunto;
use App\Models\RegistroReciclaje;
use App\Models\Role;
use App\Models\InventarioUsuario;
use App\Models\Noticia;
use App\Models\PuntoRecolecione;
use App\Models\RankingSemanale;
use App\Models\CategoriaTienda;
use App\Models\EstadoArbole;
use App\Models\HistorialChat;
use App\Models\ProgresoPase;
use App\Models\PaseTemporada;
use App\Models\TiendaItem;
use App\Models\Zona;

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

    //Consultas Alejandro:
    // Consulta anidada: muestra cada usuario con su perfil y zona.
    public function usuariosConPerfilYZona(){
        return User::with(['perfil', 'zona'])->get();
    }

    // Consulta anidada: muestra las noticias de cada usuario y su categoría.
    public function usuariosConNoticiasYCategoria(){
        return User::with('noticias.categoriaGlobal')->get();
    }

    // Consulta anidada: muestra las recompensas de cada usuario y el pase asociado.
    public function usuariosConRecompensasYPase(){
        return User::with('recompensasReclamadas.paseTemporada')->get();
    }

    // Consulta anidada: muestra los reciclajes de cada usuario y sus materiales.
    public function usuariosConReciclajesYMaterial(){
        return User::with('registrosReciclaje.tipoMaterial')->get();
    }

    // Consulta Eloquent: lista cada rol con sus usuarios.
    public function rolesConUsuarios(){
        return Role::with('users')->get();
    }

    // Consulta Eloquent: lista las categorías de tienda con sus artículos.
    public function categoriasTiendaConItems(){
        return CategoriaTienda::with('tiendaItems')->get();
    }

    // Consulta Eloquent: lista los árboles con el usuario propietario.
    public function arbolesConUsuarios(){
        return EstadoArbole::with('user')->get();
    }

    // Consulta Eloquent: lista el progreso de pase junto con cada usuario.
    public function progresosConUsuarios(){
        return ProgresoPase::with('user')->get();
    }

    // Consulta Eloquent: lista feedbacks con puntuación de 4 o más y su autor.
    public function feedbacksConPuntuacionAlta(){
        return Feedback::with('user')
            ->where('puntuacion', '>=', 4)
            ->orderByDesc('puntuacion')
            ->get();
    }

    // Consulta Eloquent: lista los chats junto con el usuario que los inició.
    public function chatsConUsuarios(){
        return HistorialChat::with('user')->get();
    }

    // Consultas nuevas:
    // Lista usuarios activos con su perfil y zona.
    public function usuariosActivosConPerfilYZona(){
        return User::with(['perfil', 'zona'])
            ->where('estado_usuario', 'activo')
            ->get();
    }

    // Lista usuarios que aún no completan el onboarding junto con su rol y zona.
    public function usuariosSinCompletarOnboarding(){
        return User::with(['role', 'zona'])
            ->where('estado_onboarding', false)
            ->get();
    }

    // Muestra cada zona con sus usuarios y puntos de recolección.
    public function zonasConUsuariosYPuntos(){
        return Zona::with(['users', 'puntorecoleciones'])->get();
    }

    // Lista puntos de recolección con los materiales que tienen disponibles.
    public function puntosConMaterialesDisponibles(){
        return PuntoRecolecione::with([
            'zona',
            'tipoMateriales' => function ($query) {
                $query->wherePivot('disponible', true);
            },
        ])->get();
    }

    // Cuenta los registros de reciclaje asociados a cada punto.
    public function puntosConConteoDeReciclajes(){
        return PuntoRecolecione::withCount('registroReciclajes')
            ->orderByDesc('registro_reciclajes_count')
            ->get();
    }

    // Lista los puntos que reciben cada material y muestra su disponibilidad.
    public function materialesConPuntosDisponibles(){
        return TipoMateriale::with([
            'puntoRecolecciones' => function ($query) {
                $query->wherePivot('disponible', true);
            },
        ])->get();
    }

    // Muestra cada reciclaje con su usuario, material, punto y zona del punto.
    public function reciclajesConPuntoYZona(){
        return RegistroReciclaje::with([
            'user',
            'tipoMaterial',
            'puntoRecoleccion.zona',
        ])->get();
    }

    // Lista los reciclajes pendientes con todos sus datos relacionados.
    public function reciclajesPendientesDeRevision(){
        return RegistroReciclaje::with(['user', 'tipoMaterial', 'puntoRecoleccion'])
            ->where('estado', 'pendiente')
            ->orderBy('created_at')
            ->get();
    }

    // Ordena los reciclajes por los puntos ganados e incluye usuario y material.
    public function reciclajesOrdenadosPorPuntosGanados(){
        return RegistroReciclaje::with(['user', 'tipoMaterial'])
            ->orderByDesc('puntos_ganados')
            ->get();
    }

    // Ordena los usuarios según sus puntos totales e incluye su rol.
    public function usuariosOrdenadosPorPuntosTotales(){
        return User::with('role')
            ->orderByDesc('puntos_totales')
            ->get();
    }

    // Calcula los puntos obtenidos mediante reciclajes para cada usuario.
    public function usuariosConSumaPuntosDeReciclaje(){
        return User::withSum('registrosReciclaje', 'puntos_ganados')
            ->orderByDesc('registros_reciclaje_sum_puntos_ganados')
            ->get();
    }

    // Ordena los materiales por el valor de puntos que otorgan.
    public function materialesOrdenadosPorValorDePuntos(){
        return TipoMateriale::orderByDesc('valor_puntos')->get();
    }

    // Lista categorías globales con sus noticias, contenidos y autores.
    public function categoriasConContenidoYAutores(){
        return CategoriaGlobal::with([
            'noticias.user',
            'contenidosEducativos.user',
        ])->get();
    }

    // Muestra las diez noticias más recientes con categoría y autor.
    public function noticiasMasRecientes(){
        return Noticia::with(['categoriaGlobal', 'user'])
            ->latest()
            ->limit(10)
            ->get();
    }

    // Lista contenidos educativos ordenados por formato con categoría y autor.
    public function contenidosOrdenadosPorFormato(){
        return ContenidoEducativo::with(['categoriaGlobal', 'user'])
            ->orderBy('tipo_formato')
            ->get();
    }

    // Ordena los artículos de tienda por costo e incluye su categoría.
    public function itemsTiendaOrdenadosPorCosto(){
        return TiendaItem::with('categoriaTienda')
            ->orderBy('costo_moneda_virtual')
            ->get();
    }

    // Lista los artículos de tienda con sus pases de temporada.
    public function itemsTiendaConPasesTemporada(){
        return TiendaItem::with(['categoriaTienda', 'paseTemporadas'])->get();
    }

    // Muestra cada pase con su artículo y las recompensas reclamadas por usuarios.
    public function pasesConRecompensasYUsuarios(){
        return PaseTemporada::with([
            'tiendaItem',
            'recompensasReclamadas.user',
        ])->get();
    }

    // Lista los progresos premium con el usuario y ordena por nivel.
    public function progresosPremiumConUsuarios(){
        return ProgresoPase::with('user')
            ->where('es_premium', true)
            ->orderByDesc('nivel_actual')
            ->get();
    }

    // Ordena los árboles por nivel de crecimiento e incluye a sus usuarios.
    public function arbolesOrdenadosPorNivel(){
        return EstadoArbole::with('user')
            ->orderByDesc('nivel_crecimiento')
            ->get();
    }

}
