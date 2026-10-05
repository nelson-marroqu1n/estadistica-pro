<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearFilaConjuntoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_conjunto' => 'required|integer|min:1',
            'datos_json' => 'required|array'
        ];
    }

    public function messages(): array
    {
        return [
            'id_conjunto.required' => 'El id_conjunto es obligatorio.',
            'id_conjunto.integer' => 'El id_conjunto debe ser un número entero.',
            'id_conjunto.min' => 'El id_conjunto debe ser mayor a 0.',
            'datos_json.required' => 'El campo datos_json es obligatorio.',
            'datos_json.array' => 'El campo datos_json debe ser un objeto o arreglo válido.'
        ];
    }
}