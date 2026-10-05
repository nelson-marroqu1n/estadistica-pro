<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarFilaConjuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_fila' => 'required|integer|min:1',
            'datos_json' => 'required|array' // Valida que se reciba un objeto/arreglo JSON válido
        ];
    }

    public function messages(): array
    {
        return [
            'id_fila.required' => 'El id_fila es obligatorio.',
            'id_fila.integer' => 'El id_fila debe ser un número entero.',
            'id_fila.min' => 'El id_fila debe ser mayor a 0.',
            'datos_json.required' => 'El campo datos_json es obligatorio.',
            'datos_json.array' => 'El campo datos_json debe ser un objeto o arreglo válido.'
        ];
    }
}