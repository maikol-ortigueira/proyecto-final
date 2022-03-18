<?php

namespace App\Http\Requests;

use App\Models\Ingrediente;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIngredienteRequest extends FormRequest
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
            'nombre' => 'required|unique:ingredientes,nombre,' . $this->ingrediente->id, // Iganoramos este elemento en la validación
            'unidad_id' => 'required'
        ];
    }
}
