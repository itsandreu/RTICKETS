<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarTicketRequest extends FormRequest
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
        'id_user' => 'required',
        'asignado' => 'required',
        'titulo' => 'required',
        'descripcion' => 'required',
        'id_estado' => 'required|regex:/^[0-9]{1}$/',
        'id_prioridad' => 'required|regex:/^[0-9]{1}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'id_user.required' => 'El id del usuario es requerido',
            'asignado.required' => 'El id del asignado es requerido',
            'titulo.required' => 'El título es requerido',
            'descripcion.required' => 'la descripcion es requerida',
            'id_estado.required' => 'El estado es requerido',
            'id_prioridad.unique' => 'La Prioridad es requerida',
        ];
    }
}
