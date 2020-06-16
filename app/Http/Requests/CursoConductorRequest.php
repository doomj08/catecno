<?php

namespace App\Http\Requests;

use App\CursoConductor;
use Illuminate\Foundation\Http\FormRequest;

class CursoConductorRequest extends FormRequest
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
    public function rules2()
    {
        return [
            //
            'empresa_id'=>'required|exist:empresa_transporte',
            'conductor_id'=>'required',
            'curso_id'=>'required',
            'carnet'=>'required',
            'certificado'=>'required|max:2000|mimes:pdf',
            'file' => 'max:2000|mimes:jpeg,png,doc,docs,pdf',
            'inicio'=>'required',
            'vence'=>'required',

        ];
    }
    public function rules()
    {
        $eliminado=CursoConductor::where('carnet',$this->carnet)->where('deleted_at','!=',null)->count();
        $editar=CursoConductor::find($this->id);
        if($eliminado>0){
            return [
                'empresa_transporte_id'=>'required|exist:empresa_transporte',
                'conductor_id'=>'required',
                'curso_id'=>'required',
                'carnet'=>'required',
                'certificado'=>'required',
                'inicio'=>'required',
                'vence'=>'required',
                'file'=>'required',
            ];
        }
        elseif(isset($editar->id)){
            return [
                'empresa_transporte_id'=>'required',
                'conductor_id'=>'required',
                'curso_id'=>'required',
                'carnet'=>'required',
                'certificado'=>'required',
                'fecha_ingreso'=>'required',
                'fecha_vence'=>'required',
                'file'=>'required',
            ];
        }
        else{
            return [
                'empresa_transporte_id'=>'required',
                'conductor_id'=>'required',
                'curso_id'=>'required',
                'carnet'=>'required',
                'certificado'=>'required',
                'fecha_ingreso'=>'required',
                'fecha_vence'=>'required',
                'file'=>'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'empresa_id.required' => 'Es obligatorio elegir una empresa',
            'conductor_id.required' => 'Es obligatorio elegir un conductor',
            'curso_id.required' => 'Es obligatorio elegir un curso',
            'carnet.required' => 'El código de carnet es un campo obligatorio',
            'inicio.required' => 'La fecha de inicio es un campo obligatorio',
            'vence.required' => 'La fecha de vencimiento es un campo obligatorio',

        ];
    }
}