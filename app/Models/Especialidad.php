<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Especialidad extends Model
{
    use HasFactory;
    protected $table='especialidades';
    public static function create_user_espec($id_user,$especialidad){
        $query=DB::select ("INSERT INTO especialidad_user(user_id,especialidad_id)
        VALUES('$id_user','$especialidad') ");
        return $query;
    }
    public static function especialidades_user(){
        $query=DB::select ("SELECT * FROM especialidad_user ");
        return $query;
    }
    public static function delete_user_espec($id_user){
        $query=DB::select ("DELETE FROM especialidad_user WHERE user_id='$id_user' ");
        return $query;
    }

}
