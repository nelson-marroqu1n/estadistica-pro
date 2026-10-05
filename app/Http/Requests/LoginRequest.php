<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'correo_usuario' => 'required|email',
            'contrasenha' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'correo_usuario.required' => 'El correo electrónico es obligatorio.',
            'correo_usuario.email' => 'El correo electrónico no es válido.',
            'contrasenha.required' => 'La contraseña es obligatoria.',
        ];
    }
}