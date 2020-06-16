<?php

namespace App\Http\Requests;

use App\EmpresaTransporte;
use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
        //$eliminado=EmpresaTransporte::()->where('Razon_social',$this->razon_social)->where('deleted_at','!=',null)->count();
        $eliminado=0;
        $editar=EmpresaTransporte::find($this->id);
        if($eliminado>0){
            return [
                'razon_social'=>'required',
            ];
        }
        elseif(isset($editar->id)){
            return [
                'razon_social'=>'required',
            ];
        }
        else{
            return [
                'razon_social'=>'required|unique:empresa_transportes',
            ];
        }
    }
    public function messages()
    {
        return [
            'razon_social.required' => 'El nombre de la empresa (razón social) es un campo obligatorio',
            'razon_social.unique' => 'Esta razón social ya se encuentra registrada',
        ];
    }
}
