<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrarFilaConjuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_fila' => 'required|integer|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            'id_fila.required' => 'El id_fila es obligatorio.',
            'id_fila.integer' => 'El id_fila debe ser un número entero.',
            'id_fila.min' => 'El id_fila debe ser mayor a 0.'
        ];
    }
}