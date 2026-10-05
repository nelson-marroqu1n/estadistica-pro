<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObtenerConjuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario' => 'required|integer|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'id_usuario.required' => 'El id_usuario es obligatorio.',
            'id_usuario.integer' => 'El id_usuario debe ser un número entero.',
            'id_usuario.min' => 'El id_usuario debe ser mayor a 0.'
        ];
    }
}