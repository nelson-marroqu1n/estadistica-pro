<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearConjuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario' => 'required|integer|min:1',
            'nombre_conjunto' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'id_usuario.required' => 'El id_usuario es obligatorio.',
            'id_usuario.integer' => 'El id_usuario debe ser un número entero.',
            'id_usuario.min' => 'El id_usuario debe ser mayor a 0.',
            'nombre_conjunto.required' => 'El nombre_conjunto es obligatorio.',
            'nombre_conjunto.string' => 'El nombre_conjunto debe ser una cadena de texto.'
        ];
    }
}