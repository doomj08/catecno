<?php

namespace App\Http\Requests;

use App\Curso;
use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
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
        //$eliminado=Curso::withTrashed()->where('nombre',$this->nombre)->where('deleted_at','!=',null)->count();
        $eliminado=0;
        $editar=Curso::find($this->id);
        if($eliminado>0){
            return [
                'nombre'=>'required',
            ];
        }
        elseif(isset($editar->id)){
            return [
                'nombre'=>'required',
            ];
        }
        else{
            return [
                'nombre'=>'required|unique:cursos',
            ];
        }
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del curso es es un campo obligatorio',
            'nombre.unique' => 'Este curso ya existe',
        ];
    }
}
