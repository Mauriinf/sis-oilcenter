<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetalleIngresoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'id_articulo'=>'required',
            'id_ingreso'=>'required',
            'd_cantidad'=>'required',
            'd_p_compra'=>'required',
            'd_p_venta_normal'=>'required',
            'd_p_venta_factura'=>'required'
            
        ];
    }
}
