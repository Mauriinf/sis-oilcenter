<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table='servicios';
    protected $fillable = [
        'id_cliente',
        'id_usuario',
        'fecha_hora',
        'km_actual',
        'precio',
        'descripcion'
    ];
    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }

    public function mecanico()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function detalleServicios()
    {
        return $this->hasMany(DetalleServicio::class, 'id_servicio');
    }
    public function citas()
    {
        return $this->hasOne(Cita::class, 'id_servicio');
    }
}
