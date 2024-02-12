<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $table='ingreso';

    protected $primaryKey='id';
    public $timestamps=true;
    Protected $fillable = [
        'id_proveedor',
        'id_almacenero',
        'monto_total',
        'fecha_hora',
        'estado',
        'monto_cancelado',
        'monto_deuda'
    ];

    public function proveedor(){
        return $this->belongsTo(User::class, 'id_proveedor', 'id');
    }
    public function almacenero(){
        return $this->belongsTo(User::class, 'id_almacenero', 'id');
    }
    public function detalle_ingreso(){
        return $this->hasMany(Detalle_ingreso::class, 'id_ingreso', 'id');
    }
}
