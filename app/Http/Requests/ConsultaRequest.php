<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'costo'=>'required',
            'id_cliente'=>'required|numeric',
        ];
    }
    public function messages(){
        return [
            'costo.required'=>'El campo costo es requerido',
            'id_cliente.required'=>'Seleccione a un Paciente',
            'id_cliente.numeric'=>'Seleccione a un Paciente',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
