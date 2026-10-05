<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AuthService
{
    public function validarCredenciales(string $correo, string $contrasenha): ?array
    {
        $resultado = DB::select(
            'EXEC [dbo].[SP_validar_existe_usuario] @correo_usuario = ?, @contrasenha = ?',
            [$correo, $contrasenha]
        );

        if (empty($resultado) || $resultado[0]->estado !== 'Bienvenido/a') {
            return null;
        }

        $usuario = DB::table('usuario')
            ->where('correo_usuario', $correo)
            ->first();

        if (!$usuario) {
            return null;
        }

        return [
            'id_usuario' => $usuario->id_usuario,
            'correo_usuario' => $usuario->correo_usuario,
        ];
    }
}