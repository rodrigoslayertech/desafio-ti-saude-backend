<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ConsultaController;
use App\Http\Controllers\Api\EspecialidadeController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\PlanosController;
use App\Http\Controllers\Api\ProcedimentoController;
use App\Http\Controllers\Api\VinculosController;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ! Auth
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'apiJwt'], function () {
   Route::post('/auth/logout', [AuthController::class, 'logout']);
   Route::post('/auth/refresh', [AuthController::class, 'refresh']);
});


// ! Pacientes
Route::group(['middleware' => 'apiJwt', 'prefix' => 'pacientes'], function () {
   Route::get('/', [PacienteController::class, 'index']);
   Route::post('/', [PacienteController::class, 'create']);
   Route::get('/{id}', [PacienteController::class, 'show']);
   Route::put('/{id}', [PacienteController::class, 'update']);
   Route::delete('/{id}', [PacienteController::class, 'destroy']);
});

// ! Vinculos
Route::group(['middleware' => 'apiJwt', 'prefix' => 'vinculos'], function () {
   Route::get('/', [VinculosController::class, 'index']);
   Route::post('/', [VinculosController::class, 'create']);
   Route::get('/{id}', [VinculosController::class, 'show']);
   Route::put('/{id}', [VinculosController::class, 'update']);
   Route::delete('/{id}', [VinculosController::class, 'destroy']);
});

// ! Planos
Route::group(['middleware' => 'apiJwt', 'prefix' => 'planos'], function () {
   Route::get('/', [PlanosController::class, 'index']);
   Route::post('/', [PlanosController::class, 'create']);
   Route::get('/{id}', [PlanosController::class, 'show']);
   Route::put('/{id}', [PlanosController::class, 'update']);
   Route::delete('/{id}', [PlanosController::class, 'destroy']);
});

// ! Consultas
Route::group(['middleware' => 'apiJwt', 'prefix' => 'consultas'], function () {
   Route::get('/', [ConsultaController::class, 'index']);
   Route::post('/', [ConsultaController::class, 'create']);
   Route::get('/{id}', [ConsultaController::class, 'show']);
   Route::put('/{id}', [ConsultaController::class, 'update']);
   Route::delete('/{id}', [ConsultaController::class, 'destroy']);
});

// ! Procedimentos
Route::group(['middleware' => 'apiJwt', 'prefix' => 'procedimentos'], function () {
   Route::get('/', [ProcedimentoController::class, 'index']);
   Route::post('/', [ProcedimentoController::class, 'create']);
   Route::get('/{id}', [ProcedimentoController::class, 'show']);
   Route::put('/{id}', [ProcedimentoController::class, 'update']);
   Route::delete('/{id}', [ProcedimentoController::class, 'destroy']);
});

// ! Medicos
Route::group(['middleware' => 'apiJwt', 'prefix' => 'medicos'], function () {
   Route::get('/', [MedicoController::class, 'index']);
   Route::post('/', [MedicoController::class, 'create']);
   Route::get('/{id}', [MedicoController::class, 'show']);
   Route::put('/{id}', [MedicoController::class, 'update']);
   Route::delete('/{id}', [MedicoController::class, 'destroy']);
});

// ! Especialidades
Route::group(['middleware' => 'apiJwt', 'prefix' => 'especialidades'], function () {
   Route::get('/', [EspecialidadeController::class, 'index']);
   Route::post('/', [EspecialidadeController::class, 'create']);
   Route::get('/{id}', [EspecialidadeController::class, 'show']);
   Route::put('/{id}', [EspecialidadeController::class, 'update']);
   Route::delete('/{id}', [EspecialidadeController::class, 'destroy']);
});
