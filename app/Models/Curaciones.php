<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
class Curaciones extends Model
{
    use HasFactory;
    protected $table='consultas';
    protected $fillable = [
        'id_cliente',
        'id_doctor',
        'motivo',
        'diagnostico',
        'medicamentos',
        'fecha_creacion',
        'fecha_inicio',
        'fecha_final',
        'alergias',
        'enfermedades',
        'estado',
        'otros',
        'costo_total'
    ];
    public static function consultas(){
        $consulta="SELECT CONCAT(IFNULL(CONCAT(us.nombres, ' '), ''),IFNULL(CONCAT(us.paterno, ' '), ''),IFNULL(CONCAT(us.materno, ' '), '')) as nombre_paciente,us.id as id_paciente,us.ci as ci_paciente,us.nombres as nom_paciente,us.paterno as pat_paciente,us.materno as mat_paciente,doc.ci as ci_doctor,CONCAT(IFNULL(CONCAT(doc.nombres, ' '), ''),IFNULL(CONCAT(doc.paterno, ' '), ''),IFNULL(CONCAT(doc.materno, ' '), '')) as nombre_doctor ,co.*, ( SELECT SUM(od.pago) from odontograma od where od.id_consulta=co.id) as total_pagado
        FROM consultas co INNER JOIN users us
                    ON us.id=co.id_cliente
                    INNER JOIN users doc
                    ON doc.id=co.id_doctor ";
        $user= Auth::user();
        $where='';
        if($user->hasRole('Doctor')){
            $where.=" WHERE co.id_doctor='$user->id'";
        }elseif($user->hasRole('Paciente')){
            $where.=" WHERE co.id_cliente='$user->id'";
        }
        $query=DB::select ($consulta.$where);
        return $query;
    }
    public static function cobros_entre_fechas($inicio,$fin){
        $query=DB::select ("SELECT CONCAT(IFNULL(CONCAT(us.nombres, ' '), ''),IFNULL(CONCAT(us.paterno, ' '), ''),IFNULL(CONCAT(us.materno, ' '), '')) as nombre_paciente,
                        us.ci as ci_paciente,us.sexo,us.fec_nac,co.diagnostico,us.nombres as nom_paciente,us.paterno as pat_paciente,us.materno as mat_paciente,doc.ci as ci_doctor,
                        CONCAT(IFNULL(CONCAT(doc.nombres, ' '), ''),IFNULL(CONCAT(doc.paterno, ' '), ''),IFNULL(CONCAT(doc.materno, ' '), '')) as nombre_doctor ,
                        co.costo_total, ( SELECT SUM(od.pago) from odontograma od where od.id_consulta=co.id AND od.fecha>='$inicio'
                        AND od.fecha<='$fin') as total_pagado
                                                FROM consultas co INNER JOIN users us
                                                            ON us.id=co.id_cliente
                                                            INNER JOIN users doc
                                                            ON doc.id=co.id_doctor");
        return $query;
    }
    public static function cobros_entre_fechas_doctor($inicio,$fin,$id_doctor){
        $query=DB::select ("SELECT CONCAT(IFNULL(CONCAT(us.nombres, ' '), ''),IFNULL(CONCAT(us.paterno, ' '), ''),IFNULL(CONCAT(us.materno, ' '), '')) as nombre_paciente,
                        us.ci as ci_paciente,us.sexo,us.fec_nac,co.diagnostico,us.nombres as nom_paciente,us.paterno as pat_paciente,us.materno as mat_paciente,doc.ci as ci_doctor,
                        CONCAT(IFNULL(CONCAT(doc.nombres, ' '), ''),IFNULL(CONCAT(doc.paterno, ' '), ''),IFNULL(CONCAT(doc.materno, ' '), '')) as nombre_doctor ,
                        co.costo_total, ( SELECT SUM(od.pago) from odontograma od where od.id_consulta=co.id AND od.fecha>='$inicio'
                        AND od.fecha<='$fin') as total_pagado
                                                FROM consultas co INNER JOIN users us
                                                            ON us.id=co.id_cliente
                                                            INNER JOIN users doc
                                                            ON doc.id=co.id_doctor
                                                            AND co.id_doctor='$id_doctor'");
        return $query;
    }
    public static function atendidos_entre_fechas($inicio,$fin){
        $query=DB::select ("SELECT DISTINCT us.ci as ci_paciente, CONCAT(IFNULL(CONCAT(us.nombres, ' '), ''),IFNULL(CONCAT(us.paterno, ' '), ''),IFNULL(CONCAT(us.materno, ' '), '')) as nombre_paciente
        FROM consultas co INNER JOIN users us
                    ON us.id=co.id_cliente
                    WHERE co.fecha_creacion>='$inicio'
                    AND co.fecha_creacion<='$fin'");
        return $query;
    }
    public static function atendidos_entre_fechas_doctor($inicio,$fin,$id_doctor){
        $query=DB::select ("SELECT DISTINCT us.ci as ci_paciente, CONCAT(IFNULL(CONCAT(us.nombres, ' '), ''),IFNULL(CONCAT(us.paterno, ' '), ''),IFNULL(CONCAT(us.materno, ' '), '')) as nombre_paciente
        FROM consultas co INNER JOIN users us
                    ON us.id=co.id_cliente
                    WHERE co.fecha_creacion>='$inicio'
                    AND co.fecha_creacion<='$fin'
                    AND co.id_doctor='$id_doctor'");
        return $query;
    }
    public static function hombres_mujeres_atendidos(){
        $query=DB::select ("SELECT count(*) as total,
                sum(us.sexo = 'M') as Masculinos,
                sum(us.sexo = 'F') as Femeninos
                FROM users us
        WHERE us.id IN(
        SELECT cs.id_cliente
        from consultas cs
        GROUP BY cs.id_cliente)");
        return $query;

    }
    public static function Mayores_de_edad(){
        $query=DB::select ("SELECT count(*) as mayores_edad FROM (SELECT us.id,YEAR( CURDATE( ) ) - YEAR( us.fec_nac ) - IF( MONTH( CURDATE( ) ) < MONTH(  us.fec_nac), 1, IF ( MONTH(CURDATE( )) = MONTH( us.fec_nac), IF (DAY( CURDATE( ) ) < DAY(  us.fec_nac ),1,0 ),0)) AS edades
        from users us
        WHERE us.id IN(
            SELECT cs.id_cliente
            from consultas cs
            GROUP BY cs.id_cliente) HAVING edades BETWEEN 18 AND 100) as cantidad");
        return $query;
    }
    public static function Menores_de_edad(){
        $query=DB::select ("SELECT count(*) as menores_edad FROM (SELECT us.id,YEAR( CURDATE( ) ) - YEAR( us.fec_nac ) - IF( MONTH( CURDATE( ) ) < MONTH(  us.fec_nac), 1, IF ( MONTH(CURDATE( )) = MONTH( us.fec_nac), IF (DAY( CURDATE( ) ) < DAY(  us.fec_nac ),1,0 ),0)) AS edades
        from users us
        WHERE us.id IN(
            SELECT cs.id_cliente
            from consultas cs
            GROUP BY cs.id_cliente) HAVING edades BETWEEN 0 AND 18) as cantidad");
        return $query;
    }
    public static function consulta_det($id){
        $query=DB::select ("SELECT co.*,CONCAT(IFNULL(CONCAT(us.nombres, ' '), ''),IFNULL(CONCAT(us.paterno, ' '), ''),IFNULL(CONCAT(us.materno, ' '), '')) as nombre_paciente,CONCAT(IFNULL(CONCAT(doc.nombres, ' '), ''),IFNULL(CONCAT(doc.paterno, ' '), ''),IFNULL(CONCAT(doc.materno, ' '), '')) as nombre_doctor,us.ci as ci_paciente,doc.ci as ci_doctor,us.email as email_paciente,us.telefono as telefono_paciente,us.direccion as direccion_paciente,doc.email as email_doctor,doc.telefono as telefono_doctor,doc.direccion as direccion_doctor
                        FROM consultas co
                            INNER JOIN users us
                            ON us.id=co.id_cliente
                            INNER JOIN users doc
                            ON doc.id=co.id_doctor
                            WHERE co.id='$id'");
        return $query;
    }
}
