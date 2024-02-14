<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'paterno',
        'materno',
        'nombres',
        'ci',
        'fec_nac',
        'estado',
        'direccion',
        'telefono',
        'username',
        'email',
        'password',
        'sexo'
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

    public function proveedor(){
        return $this->hasOne(Ingreso::class, 'id_proveedor', 'id');
    }
    public function almacenero(){
        return $this->hasOne(Ingreso::class, 'id_almacenero', 'id');
    }
    public function cliente(){
        return $this->hasOne(Venta::class, 'id_cliente', 'id');
    }
    public function vendedorV(){
        return $this->hasOne(Venta::class, 'id_vendedor', 'id');
    }
    public function vendedor(){
        return $this->hasOne(Servicio::class, 'id_cliente', 'id');
    }
    public function mecanico(){
        return $this->hasOne(Servicio::class, 'id_usuario', 'id');
    }

}
