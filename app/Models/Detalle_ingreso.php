<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_ingreso extends Model
{
    use HasFactory;
    protected $table='detalle_ingreso';

    protected $primaryKey='id';
    public $timestamps=true;
    Protected $fillable = [
        'id_articulo',
        'id_ingreso',
        'cantidad',
        'precio_compra',
        'precio_venta_normal',
        'precio_venta_factura'
    ];
    protected $guarded=[

    ];
    public function articulo(){
        return $this->belongsTo(Articulo::class, 'id_articulo', 'id');
    }
    public function ingreso(){
        return $this->belongsTo(Ingreso::class, 'id_ingreso', 'id');
    }
}
