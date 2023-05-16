<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterVerifyRequest extends FormRequest
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
            'dni' => 'required|unique:users,dni',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'apellidos.required' => 'El Apellido es requerido',
            'nacimiento.required' => 'La fecha de nacimiento es requerida',
            'dni.required' => 'El dni es requerido',
            'dni.unique' => 'Este dni ya existe',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya esta en uso',
            'password.required' => 'La contraseña es requerida'
        ];
    }
}
