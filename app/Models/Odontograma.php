<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Odontograma extends Model
{
    use HasFactory;
    protected $table='odontograma';
    public static function save_info($id_consulta,$id_tratamiento,$numeroDiente,$parteDiente,$obsevacion){
        $fecha = date('Y/m/d');
        $query=DB::select ("INSERT INTO odontograma (id_consulta,id_tratamiento, id_diente, parte_diente, observacion,estado,fecha,pago)
        VALUES ('$id_consulta', '$id_tratamiento', '$numeroDiente', '$parteDiente', '$obsevacion', 'PROCESO','$fecha',0) ");
        return $query;
    }
    public static function delete_odontograma($id){
        $query=DB::select ("DELETE FROM odontograma where id='$id' ");
        return $query;

    }
    public static function pagos($id,$pago){
        $pagos=DB::select ("SELECT co.costo_total, ( SELECT SUM(od.pago) from odontograma od where od.id_consulta=co.id and od.id<>$id ) as total_pagado
                                                FROM consultas co
                                                WHERE co.id in (SELECT odon.id_consulta FROM odontograma odon where odon.id=$id)");
        if(count($pagos)>0){
            $costo_total=$pagos[0]->costo_total;
            $total_pagado=$pagos[0]->total_pagado+$pago;
            if($total_pagado>$costo_total){
                return '0';
            }
        }
        $fecha = date('Y/m/d');
        $query=DB::select ("UPDATE odontograma SET pago = '$pago', fecha = '$fecha' where id='$id' ");
        return '1';
    }
    public static function consulta_cobros($id){
        $query=DB::select ("SELECT od.*,tr.descripcion,tr.costo,di.nombre FROM odontograma od
                        INNER JOIN tratamientos tr
                        ON tr.id=od.id_tratamiento
                        INNER JOIN dientes di
                        ON di.numero=od.id_diente where od.id_consulta='$id' ");
        return $query;
    }
}
