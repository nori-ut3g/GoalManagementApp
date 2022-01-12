<?php

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
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register']);

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::get('/objectives', [\App\Http\Controllers\ObjectiveController::class, 'index']);
    Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index']);
    Route::get('/objectives/{id}/tasks', [\App\Http\Controllers\TaskController::class, 'showTasks']);
    Route::post('/objectives/{id}/tasks/create', [\App\Http\Controllers\TaskController::class, 'createTask']);
    Route::post('/objectives/create', [\App\Http\Controllers\ObjectiveController::class, 'create']);


});





