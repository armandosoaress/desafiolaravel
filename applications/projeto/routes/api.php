<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClienteController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| ROTA DE AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/user', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'index']);
Route::middleware('auth:sanctum')->put('/user', [AuthController::class, 'update']);
/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| CRUD DE CLIENTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/clientes', [ClienteController::class, 'index']);
Route::middleware('auth:sanctum')->get('/cliente/{id}', [ClienteController::class, 'show']);
Route::middleware('auth:sanctum')->post('/clientes', [ClienteController::class, 'store']);
Route::middleware('auth:sanctum')->put('/clientes', [ClienteController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/clientes', [ClienteController::class, 'destroy']);
/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/
