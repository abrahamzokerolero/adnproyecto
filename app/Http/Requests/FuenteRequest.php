<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuenteRequest extends FormRequest
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
            'nombre' => 'min:3|max:90|required|unique:fuentes'
        ];
    }

    public function messages(){
        return [
            'nombre.min' => 'El tamaño minimo del nombre de la fuente es de 3 caracteres',
            'nombre.max' => 'El tamaño maximo del nombre de la fuente deber de ser de 90 caracteres',
            'nombre.required' => 'El campo debe ser llenado',
            'nombre.unique' => 'El nombre de fuente ya existe'
        ];
    }
}
