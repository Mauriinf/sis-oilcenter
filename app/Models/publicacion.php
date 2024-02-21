<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publicacion extends Model
{
    use HasFactory;
    protected $table='publicaciones';

    protected $primaryKey='id';
    public $timestamps=true;
    Protected $fillable = [
        'id_usuario',
        'titulo',
        'fecha',
        'imagen',
        'estado'
    ];

    public function Usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
