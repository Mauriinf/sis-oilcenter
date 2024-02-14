<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    use HasFactory;
    protected $table='detalle_venta';

    protected $primaryKey='id';
    public $timestamps=true;
    Protected $fillable = [
        'id_articulo',
        'id_venta',
        'cantidad',
        'precio_venta',
    ];
    protected $guarded=[

    ];
    public function articulo(){
        return $this->belongsTo(Articulo::class, 'id_articulo', 'id');
    }
    public function venta(){
        return $this->belongsTo(Venta::class, 'id_venta', 'id');
    }
}
