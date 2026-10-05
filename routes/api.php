<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConjuntoController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/conjunto', [ConjuntoController:: class, 'index']);
Route::put('/conjunto/editar', [ConjuntoController::class, 'update']);
Route::post('/conjunto/crear', [ConjuntoController::class, 'store']);
Route::delete('/conjunto', [ConjuntoController::class, 'destroy']);
Route::post('/conjunto/filas-all', [ConjuntoController::class, 'obtenerFilas']);
Route::post('/conjunto/filas-id', [ConjuntoController::class, 'obtenerFilasPorConjunto']);
Route::put('/conjunto/fila', [ConjuntoController::class, 'editarFila']);
Route::delete('/conjunto/fila', [ConjuntoController::class, 'borrarFila']);
Route::post('/conjunto/fila', [ConjuntoController::class, 'crearFila']);

