<?php

namespace App\Http\Requests;

use App\Conductor;
use Illuminate\Foundation\Http\FormRequest;

class ConductorRequest extends FormRequest
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
        //$eliminado=Conductor::withTrashed()->where('cedula',$this->cedula)->where('deleted_at','!=',null)->count();
        $eliminado=0;
        $editar=Conductor::find($this->id);
        if($eliminado>0){
            return [
                'cedula'=>'required|numeric|min:1000000|max:9999999999',
                'nombres'=>'required',
                'apellidos'=>'required',
            ];
        }
        elseif(isset($editar->id)){
            return [
                'cedula'=>'required|numeric|min:1000000|max:9999999999',
                'nombres'=>'required',
                'apellidos'=>'required',
            ];
        }
        else{
            return [
                'cedula'=>'required|numeric|min:1000000|max:9999999999|unique:conductores',
                'nombres'=>'required',
                'apellidos'=>'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'cedula.required' => 'La cédula es un campo obligatorio',
            'cedula.numeric' => 'La cédula debe ser numèrico',
            'cedula.unique' => 'Esta cédula ya se encuentra registrada',
            'nombres.required' => 'Los nombres son un campo obligatorio',
            'apellidos.required' => 'Los apellidos son un campo obligatorio',
            'cedula.min'  => 'La cédula debe tener al menos 7 dígitos',
            'cedula.max'  => 'La cédula no  debe tener más de 10 dígitos',
        ];
    }
}
