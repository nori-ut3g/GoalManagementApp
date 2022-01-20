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
Route::post('/email_validator', [\App\Http\Controllers\RegisterController::class, 'emailValidator']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::get('/objectives', [\App\Http\Controllers\ObjectiveController::class, 'getUserObjectives']);
    Route::get('/objective/{objective_id}', [\App\Http\Controllers\ObjectiveController::class, 'getObjective']);

//    Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index']);
    Route::get('/objectives/{objective_id}/tasks', [\App\Http\Controllers\TaskController::class, 'showTasks']);
    Route::post('/objectives/{objective_id}/task/create', [\App\Http\Controllers\TaskController::class, 'createTask']);
    Route::post('/objectives/{objective_id}/task/{id}/edit_title', [\App\Http\Controllers\TaskController::class, 'editTitle']);
    Route::post('/objectives/{objective_id}/task/{id}/edit_note', [\App\Http\Controllers\TaskController::class, 'editNote']);
    Route::get('/objectives/{objective_id}/task/{id}/start', [\App\Http\Controllers\TaskController::class, 'start']);
    Route::get('/objectives/{objective_id}/task/{id}/finish', [\App\Http\Controllers\TaskController::class, 'finish']);
    Route::get('/objectives/{objective_id}/task/{id}/undo_start', [\App\Http\Controllers\TaskController::class, 'undoStart']);
    Route::get('/objectives/{objective_id}/task/{id}/undo_finish', [\App\Http\Controllers\TaskController::class, 'undoFinish']);
    Route::delete('/objectives/{objective_id}/task/{id}/delete', [\App\Http\Controllers\TaskController::class, 'deleteTask']);


    Route::post('/objectives/{objective_id}/task/{id}/start', [\App\Http\Controllers\TaskController::class, 'setStartDate']);
    Route::post('/objectives/{objective_id}/task/{id}/finish', [\App\Http\Controllers\TaskController::class, 'setFinishDate']);


    Route::post('/objectives/create', [\App\Http\Controllers\ObjectiveController::class, 'create']);


});





