<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfRequest extends FormRequest
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
            'cedula' => 'required|numeric|exists:conductores,cedula'
        ];
    }
    public function messages()
    {
        return [
            'cedula.required' => 'La cédula es un campo obligatorio',
            'cedula.numeric' => 'La cédula debe ser numèrico',
            'cedula.exists' => 'El número del documento no se encuentra registrado.',
        ];
    }
}
