<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BloqueDia extends Model
{
    use HasFactory;

    protected $table = 'bloque_dia';
    protected $fillable = [
        'id_usuario', 'estado', 'id_dia', 'id_bloque'
    ];

    public static function get_agenda($bloque_id,$id_usuario){
        $resultados = DB::select(
            DB::raw("
            SELECT bdia.id as bd_id, bdia.estado as bd_estado, d.nombre_dia as bd_nombre
            FROM bloque_dia bdia
      INNER JOIN users u
              ON bdia.id_usuario = u.id
      INNER JOIN dia d
              ON bdia.id_dia = d.id
      INNER JOIN bloque b
              ON bdia.id_bloque = b.id
           WHERE bdia.id_bloque = $bloque_id
           AND u.id=$id_usuario
        ORDER BY bdia.id_dia ASC
        "));
        return $resultados;
    }
}
