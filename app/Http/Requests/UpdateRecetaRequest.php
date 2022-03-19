<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecetaRequest extends FormRequest
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
            'nombre' => 'required',
            'raciones' => ['required', 'numeric'],
            'descripcion' => 'required',
            'categoria' => 'required',
            'imagenes_subidas.*' => 'image',
            'pasos.*.nombre' => 'required',
            'pasos.*.descripcion' => 'required',
            'ingredientes.*.ingrediente' => 'required',
            'ingredientes.*.cantidad' => ['required', 'numeric'],
            'ingredientes.*.unidad' => 'required',
        ];
    }
}
