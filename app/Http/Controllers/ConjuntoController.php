<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObtenerConjuntoRequest;
use App\Http\Requests\EditarConjuntoRequest;
use App\Http\Requests\CrearConjuntoRequest;
use App\Services\ConjuntoService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\BorrarConjuntoRequest;
use App\Http\Requests\ObtenerFilasConjuntoRequest;
use App\Http\Requests\ObtenerFilasConjuntoIdRequest;
use App\Http\Requests\EditarFilaConjuntoRequest;
use App\Http\Requests\BorrarFilaConjuntoRequest;
use App\Http\Requests\CrearFilaConjuntoRequest;

use Exception;

class ConjuntoController extends Controller
{
    protected ConjuntoService $conjuntoService;

    public function __construct(ConjuntoService $conjuntoService)
    {
        $this->conjuntoService = $conjuntoService;
    }

    /**
     * Endpoint para obtener el conjunto
     */
    public function index(ObtenerConjuntoRequest $request): JsonResponse
    {
        try {
            $idUsuario = $request->validated()['id_usuario'];
            $data = $this->conjuntoService->obtenerConjuntoPorUsuario($idUsuario);

            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al ejecutar el procedimiento almacenado.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(EditarConjuntoRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            
            $this->conjuntoService->editarNombreConjunto(
                $validated['id_conjunto'],
                $validated['nombre_conjunto']
            );

            return response()->json([
                'success' => true,
                'message' => 'Nombre del conjunto actualizado correctamente.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el nombre del conjunto.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(CrearConjuntoRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $idConjunto = $this->conjuntoService->crearConjunto(
                $validated['id_usuario'],
                $validated['nombre_conjunto']
            );

            return response()->json([
                'success' => true,
                'message' => 'Conjunto creado exitosamente.',
                'data' => [
                    'id_conjunto' => $idConjunto
                ]
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el conjunto de datos.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(BorrarConjuntoRequest $request): JsonResponse
    {
        try {
            $idConjunto = $request->validated()['id_conjunto'];

            $this->conjuntoService->borrarConjunto($idConjunto);

            return response()->json([
                'success' => true,
                'message' => 'Conjunto eliminado correctamente.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el conjunto de datos.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //FILAS
    public function obtenerFilas(ObtenerFilasConjuntoRequest $request): JsonResponse
    {
        try {
            $idUsuario = $request->validated()['id_usuario'];
            $data = $this->conjuntoService->obtenerFilasConjuntoAll($idUsuario);

            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las filas del conjunto.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function obtenerFilasPorConjunto(ObtenerFilasConjuntoIdRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $data = $this->conjuntoService->obtenerFilasPorConjuntoId(
                $validated['id_usuario'],
                $validated['id_conjunto']
            );

            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las filas del conjunto especificitado.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function editarFila(EditarFilaConjuntoRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $this->conjuntoService->editarFilaJson(
                $validated['id_fila'],
                $validated['datos_json']
            );

            return response()->json([
                'success' => true,
                'message' => 'Fila actualizada correctamente.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la fila.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function borrarFila(BorrarFilaConjuntoRequest $request): JsonResponse
    {
        try {
            $idFila = $request->validated()['id_fila'];

            $this->conjuntoService->borrarFila($idFila);

            return response()->json([
                'success' => true,
                'message' => 'Fila eliminada correctamente.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la fila.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function crearFila(CrearFilaConjuntoRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $idFila = $this->conjuntoService->crearFilaJsonUnica(
                $validated['id_conjunto'],
                $validated['datos_json']
            );

            return response()->json([
                'success' => true,
                'message' => 'Fila creada exitosamente.',
                'data' => [
                    'id_fila' => $idFila
                ]
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la fila.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}