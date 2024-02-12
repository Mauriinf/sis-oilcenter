<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table='articulo';

    protected $primaryKey='id';
    public $timestamps=true;
    Protected $fillable = [
        'id_categoria',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado',
        'codigo'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }
    public function detalle_ingreso(){
        return $this->hasMany(Detalle_ingreso::class, 'id_articulo', 'id');
    }
}
