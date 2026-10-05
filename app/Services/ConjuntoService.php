<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ConjuntoService
{
    /**
     * Ejecuta el Stored Procedure SP_select_conjunto
     */
    public function obtenerConjuntoPorUsuario(int $idUsuario): array
    {
        // Se ejecuta el procedimiento almacenado pasando el parámetro id_usuario
        $resultado = DB::select('EXEC [dbo].[SP_select_conjunto] @id_usuario = ?', [
            $idUsuario
        ]);

        return $resultado;
    }

    public function editarNombreConjunto(int $idConjunto, string $nombreConjunto): bool
    {
        return DB::statement('EXEC [dbo].[SP_editar_nombre_conjunto_id] @id_conjunto = ?, @nombre_conjunto = ?', [
            $idConjunto,
            $nombreConjunto
        ]);
    }

    public function crearConjunto(int $idUsuario, string $nombreConjunto): int
    {
        $resultado = DB::select('EXEC [dbo].[SP_crear_conjunto] @id_usuario = ?, @nombre_conjunto = ?', [
            $idUsuario,
            $nombreConjunto
        ]);

        // Retorna el valor de SCOPE_IDENTITY()
        return (int) $resultado[0]->id_conjunto;
    }

    public function borrarConjunto(int $idConjunto): bool
    {
        return DB::statement('EXEC [dbo].[SP_borrar_conjunto_id] @id_conjunto = ?', [
            $idConjunto
        ]);
    }


    //FILAS
    public function obtenerFilasConjuntoAll(int $idUsuario): array
    {
        $resultados = DB::select('EXEC [dbo].[SP_select_filas_conjunto_all] @id_usuario = ?', [
            $idUsuario
        ]);

        // Mapea el resultado para decodificar el string JSON a un objeto/array nativo
        return array_map(function ($row) {
            return [
                'id_conjunto' => $row->id_conjunto,
                'nombre_conjunto' => $row->nombre_conjunto,
                'id_fila' => $row->id_fila,
                'datos_json' => json_decode($row->datos_json)
            ];
        }, $resultados);
    }

    public function obtenerFilasPorConjuntoId(int $idUsuario, int $idConjunto): array
    {
        $resultados = DB::select('EXEC [dbo].[SP_select_filas_conjunto_id] @id_usuario = ?, @id_conjunto = ?', [
            $idUsuario,
            $idConjunto
        ]);

        return array_map(function ($row) {
            return [
                'id_conjunto' => $row->id_conjunto,
                'nombre_conjunto' => $row->nombre_conjunto,
                'id_fila' => $row->id_fila,
                'datos_json' => json_decode($row->datos_json)
            ];
        }, $resultados);
    }

    public function editarFilaJson(int $idFila, array $datosJson): bool
    {
        // Se convierte el array/objeto a cadena JSON para enviarlo a SQL Server
        $jsonString = json_encode($datosJson, JSON_UNESCAPED_UNICODE);

        return DB::statement('EXEC [dbo].[SP_editar_fila_id] @id_fila = ?, @datos_json = ?', [
            $idFila,
            $jsonString
        ]);
    }

    public function borrarFila(int $idFila): bool
    {
        return DB::statement('EXEC [dbo].[SP_borrar_fila_id] @id_fila = ?', [
            $idFila
        ]);
    }

    public function crearFilaJsonUnica(int $idConjunto, array $datosJson): int
    {
        $jsonString = json_encode($datosJson, JSON_UNESCAPED_UNICODE);

        $resultado = DB::select('EXEC [dbo].[SP_crear_filas_json] @id_conjunto = ?, @datos_json = ?', [
            $idConjunto,
            $jsonString
        ]);

        return (int) $resultado[0]->id_fila;
    }
}