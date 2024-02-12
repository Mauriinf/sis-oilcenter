<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table='categoria';

    protected $primaryKey='id';
    public $timestamps=true;
    Protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function articulo(){
        return $this->hasOne(Articulo::class, 'id_categoria', 'id');
    }
    
}
