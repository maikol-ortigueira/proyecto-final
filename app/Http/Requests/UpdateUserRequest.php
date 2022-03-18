<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Solo un superadministrador puede actualizar usuarios
        return auth()->user()->isAdmin('superadmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'perfil.cp' => ['numeric'],
            'perfil.telefonos' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        ];
    }
}
