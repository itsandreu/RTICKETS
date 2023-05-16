<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'apellidos' => 'required',
            'nacimiento' => 'required',
            'dni' => 'required',
            'email' => 'required',
        ];
    }
    public function messages(): array
{
    return [
        'name.required' => 'El nombre es requerido',
        'apellidos.required' => 'El Apellido es requerido',
        'nacimiento.required' => 'La fecha de nacimiento es requerida',
        'dni.required' => 'El DNI es requerido',
        'email.required' => 'El email es requerido',
        'email.unique' => 'El email ya esta en uso',
    ];
}
}
