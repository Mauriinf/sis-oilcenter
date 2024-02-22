<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table='venta';

    protected $primaryKey='id';
    public $timestamps=true;
    Protected $fillable = [
        'id_cliente',
        'id_vendedor',
        'fecha_hora',
        'total_venta',
        'estado',
        'monto_cancelado',
        'monto_deuda'
    ];

    public function cliente(){
        return $this->belongsTo(User::class, 'id_cliente', 'id');
    }
    public function vendedorV(){
        return $this->belongsTo(User::class, 'id_vendedor', 'id');
    }
    public function detalle_venta(){
        return $this->hasMany(Detalle_venta::class, 'id_venta', 'id');
    }
}
