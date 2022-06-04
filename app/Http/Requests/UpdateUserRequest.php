<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

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
        return auth()->user()->isAdmin(['superadmin']);
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', Rules\Password::defaults()],
            'perfil.cp' => ['nullable', 'numeric'],
            'perfil.telefonos' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'roles' => ['required']
        ];
    }
}
