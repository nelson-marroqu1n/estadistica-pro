<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarConjuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_conjunto' => 'required|integer|min:1',
            'nombre_conjunto' => 'required|string|max:100'
        ];
    }

    public function messages(): array
    {
        return [
            'id_conjunto.required' => 'El id_conjunto es obligatorio.',
            'id_conjunto.integer' => 'El id_conjunto debe ser un número entero.',
            'id_conjunto.min' => 'El id_conjunto debe ser mayor a 0.',
            'nombre_conjunto.required' => 'El nombre_conjunto es obligatorio.',
            'nombre_conjunto.string' => 'El nombre_conjunto debe ser texto.',
            'nombre_conjunto.max' => 'El nombre_conjunto no debe exceder los 100 caracteres.'
        ];
    }
}