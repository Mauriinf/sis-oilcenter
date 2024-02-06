<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    use HasFactory;
    protected $table='tipo_servicio';
    protected $fillable = [
        'nombre',
        'estado'
    ];
    public function detalleServicios()
    {
        return $this->hasMany(DetalleServicio::class, 'id_tipo_servicio');
    }
}
