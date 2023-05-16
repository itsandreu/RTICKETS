<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarCambiosTicketRequest extends FormRequest
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
            'id' => 'required',
            'id_user' => 'required',
            'asignado' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
            'id_estado' => 'required|regex:/^[0-9]{1}$/',
            'id_prioridad' => 'required|regex:/^[0-9]{1}$/',
            'updated_by' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El id es requerido',
            'id_user.required' => 'El id_user es requerido',
            'asignado.required' => 'El id asignado es requerida',
            'titulo.required' => 'El titulo es requerido',
            'descripcion.required' => 'La descripción es requerido',
            'id_estado.required' => 'El id_estado es requerido',
            'id_prioridad.required' => 'El id_priodiad es requerido',
            'updated_by.required' => 'El campo updated_by es requerido',
        ];
    }
}
