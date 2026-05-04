<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Un usuario tiene muchos feedbacks.
    public function feedbacks(){
        return $this->hasMany(Feedback::class);
    }
    // Un usuario tiene muchos contenidos educativos.
    public function contenidosEducativos(){
        return $this->hasMany(ContenidoEducativo::class);
    }
    // Un usuario tiene muchas noticias.
    public function noticias(){
        return $this->hasMany(Noticia::class);
    }
    // Un usuario tiene un perfil.
    public function perfil(){
        return $this->hasOne(Perfile::class);
    }
    // Un usuario tiene muchos rankings semanales.
    public function rankingsSemanales(){
        return $this->hasMany(RankingSemanale::class);
    }
    // Un usuario pertenece a un rol.
    public function role(){
        return $this->belongsTo(Role::class);
    }
    // Un usuario tiene muchas recompensas reclamadas.
    public function recompensasReclamadas(){
        return $this->hasMany(RecompensaReclamada::class);
    }
    // Un usuario tiene un progreso de pase.
    public function progresoPase(){
        return $this->hasOne(ProgresoPase::class);
    }
    // Un usuario tiene muchos items en su inventario.
    public function tiendaItems(){
        return $this->belongsToMany(TiendaItem::class,'inventario_usuarios')
                    ->withPivot('cantidad');
    }
    // Un usuario tiene muchos estados de arboles.
    public function estadoArboles(){
        return $this->hasMany(EstadoArbole::class);
    }
    // Un usuario tiene muchos historiales de chat.
    public function historialChats(){
        return $this->hasMany(HistorialChat::class);
    }
    // Un usuario pertenece a una zona.
    public function zona(){
        return $this->belongsTo(Zona::class);
    }
    // Un usuario tiene muchos registros de reciclaje.
    public function registrosReciclaje() {
    return $this->hasMany(RegistroReciclaje::class);
}
}
