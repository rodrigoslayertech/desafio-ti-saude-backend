<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PacienteController;

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

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::group(['middleware' => 'apiJwt'], function () {
   Route::post('/auth/logout', [AuthController::class, 'logout']);
   Route::post('/auth/refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => 'apiJwt', 'prefix' => 'paciente'], function () {
   Route::get('/{id}', [PacienteController::class, 'show']);
});