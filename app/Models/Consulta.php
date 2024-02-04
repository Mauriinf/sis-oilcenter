<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consulta extends Model
{
    use HasFactory;
    protected $table = 'consultas';

    public static function d_tratamientos($id){
        $sql = "SELECT d.numero, d.nombre, o.parte_diente, t.descripcion, t.costo
                FROM odontograma o
                INNER JOIN dientes d
                ON o.id_diente = d.id
                INNER JOIN tratamientos t
                ON o.id_tratamiento=t.id
                WHERE o.id_consulta=$id";
        $dientes_tratamientos = DB::select($sql);
        return $dientes_tratamientos;
    }
}
