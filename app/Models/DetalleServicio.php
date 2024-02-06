<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleServicio extends Model
{
    use HasFactory;
    protected $table='detalle_servicio';
    protected $fillable = [
        'id_servicio',
        'id_tipo_servicio'
    ];
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    public function tipoServicio()
    {
        return $this->belongsTo(TipoServicio::class, 'id_tipo_servicio');
    }
}
