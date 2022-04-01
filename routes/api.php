<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//User

Route::get('/user', [UserController::class, 'getRolByUser'])->middleware('jwt.auth','is_admin');


// TASKS
Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::get('/tasks', [TaskController::class, 'getAll']);
    Route::get('/task/{id}', [TaskController::class, 'getOne']);    
    Route::delete('/task/{id}', [TaskController::class, 'delete']);    
    Route::post('/task', [TaskController::class, 'create']);    
    Route::get('/tasks_user', [TaskController::class, 'getAllByUser']);
    Route::put('/task/{id}', [TaskController::class, 'update']);
});


// Ejemplo middleware basico
Route::get('/task_middleware', [TaskController::class, 'exampleMiddleware'])->middleware('fsd');


// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});
