<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $table='citas';
    protected $fillable = [
        'id_servicio',
        'fecha_hora',
        'km',
        'descripcion',
        'estado',
    ];
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }
}
