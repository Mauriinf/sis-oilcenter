<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
class Cita extends Model
{
    use HasFactory;
    protected $table='citas';
    protected $fillable = [
        'descripcion',
        'id_especialidad',
        'id_usuario',
        'fecha',
        'estado',
        'id_bloque_dia',
    ];
    public static function horas_doctor($date, $doctorId){
        $dayofweek = date('N', strtotime($date));//Obtener el numero del dia de la semana segun una fecha ej: lunes=1,mater=2, etc
        $query=DB::select ("SELECT bd.id as id_bloque_dia, bd.id_usuario,bd.id_dia,bd.id_bloque, bloque.inicio,bloque.fin
                        FROM bloque_dia bd
                            INNER JOIN dia
                            ON dia.id=bd.id_dia
                            INNER JOIN bloque
                            ON bloque.id=bd.id_bloque
                            LEFT JOIN citas ct
                            ON bd.id =ct.id_bloque_dia
                            AND ct.fecha='$date'
                            AND (ct.estado<>'CANCELADO' AND ct.estado<>'ATENDIDO')
                            WHERE bd.estado='ACTIVO'
                            AND bd.id_usuario='$doctorId'
                            AND ct.id_bloque_dia IS NULL
                            AND bd.id_dia='$dayofweek'");

        return $query;
    }
    public static function verificar_reserva($date, $id_bloque){
        $dayofweek = date('N', strtotime($date));//Obtener el numero del dia de la semana segun una fecha ej: lunes=1,mater=2, etc
        $query=DB::select ("SELECT * FROM citas ct
                            INNER JOIN bloque_dia bd
                            ON bd.id=ct.id_bloque_dia
                            WHERE bd.id='$id_bloque'
                            AND ct.fecha='$date'");

        return $query;
    }
    public static function lista_citas($tipo){
        $consulta="SELECT ct.id,paci.paterno as paterno_paciente,paci.materno as materno_paciente,
                        paci.nombres as nombres_paciente,ct.descripcion ,ct.fecha,doc.paterno as paterno_doctor,
                        doc.materno as materno_doctor,doc.nombres as nombres_doctor,bloque.inicio, bloque.fin,
                        ct.estado,esp.nombre as especialidad
                        FROM citas ct
            INNER JOIN bloque_dia bd
            ON bd.id=ct.id_bloque_dia
            INNER JOIN users doc
            ON doc.id=bd.id_usuario
            INNER JOIN users paci
            ON paci.id=ct.id_usuario
            INNER JOIN bloque
            ON bloque.id=bd.id_bloque
            INNER JOIN especialidades esp
            ON esp.id=ct.id_especialidad";
        $user= Auth::user();
        $where='';
        if($tipo=='ANTERIORES')$where=" WHERE (ct.estado='ATENDIDO' or ct.estado='CANCELADO') ";
        else
        $where=" WHERE ct.estado='$tipo' ";
        if($user->hasRole('Doctor')){
            $where.=" AND doc.id='$user->id'";
        }elseif($user->hasRole('Paciente')){
            $where.=" AND paci.id='$user->id'";
        }
        $where.=" ORDER BY ct.fecha ASC, bloque.id ASC";
        $query=DB::select ($consulta.$where);
        return $query;
    }
    public static function detalle_cita($id){
        $query=DB::select ("SELECT ct.id,paci.paterno as paterno_paciente,paci.materno as materno_paciente,
                        paci.nombres as nombres_paciente,ct.descripcion ,ct.fecha,doc.paterno as paterno_doctor,
                        doc.materno as materno_doctor,doc.nombres as nombres_doctor,bloque.inicio, bloque.fin,
                        ct.estado,esp.nombre as especialidad
                        FROM citas ct
                        INNER JOIN bloque_dia bd
                        ON bd.id=ct.id_bloque_dia
                        INNER JOIN users doc
                        ON doc.id=bd.id_usuario
                        INNER JOIN users paci
                        ON paci.id=ct.id_usuario
                        INNER JOIN bloque
                        ON bloque.id=bd.id_bloque
                        INNER JOIN especialidades esp
                        ON esp.id=ct.id_especialidad
                        WHERE ct.id='$id'");
        return $query;
    }
    public static function citas_entre_fechas($inicio,$fin){
        $query=DB::select ("SELECT us.id,us.nombres,us.paterno,us.materno,
        us.ci,us.sexo,us.fec_nac, COUNT(*) as numero_citas
                                FROM citas cit INNER JOIN users us
                                            ON us.id=cit.id_usuario
                                            WHERE cit.fecha>='$inicio'
                                            AND cit.fecha<='$fin'
                                            GROUP BY us.id,us.nombres,us.paterno,us.materno,us.ci,us.sexo,us.fec_nac");
        return $query;
    }
    public static function citas_entre_fechas_doctor($inicio,$fin,$id_doctor){
        $query=DB::select ("SELECT us.id,us.nombres,us.paterno,us.materno,
        us.ci,us.sexo,us.fec_nac, COUNT(*) as numero_citas
                                FROM citas cit INNER JOIN users us
                                            ON us.id=cit.id_usuario
                                            INNER JOIN bloque_dia bd
                                            ON bd.id=cit.id_bloque_dia
                                            AND bd.id_usuario='$id_doctor'
                                            WHERE cit.fecha>='$inicio'
                                            AND cit.fecha<='$fin'
                                            GROUP BY us.id,us.nombres,us.paterno,us.materno,us.ci,us.sexo,us.fec_nac");
        return $query;
    }
}
