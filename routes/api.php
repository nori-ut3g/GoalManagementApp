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

Route::get('/sharedObjective/{shared_objective_id}', [\App\Http\Controllers\SharedObjectiveController::class, 'getSharedObjective']);
Route::get('/sharedObjective/{shared_objective_id}/tasks', [\App\Http\Controllers\SharedObjectiveController::class, 'getTasks']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::put('/user/update_name', [\App\Http\Controllers\RegisterController::class, 'changeName']);
    Route::put('/user/update_email', [\App\Http\Controllers\RegisterController::class, 'changeEmail']);
    Route::put('/user/update_pass', [\App\Http\Controllers\RegisterController::class, 'changePassword']);
    Route::delete('/user/delete', [\App\Http\Controllers\RegisterController::class, 'delete']);

    Route::get('/objectives', [\App\Http\Controllers\ObjectiveController::class, 'getUserObjectives']);
    Route::delete('/objectives/delete', [\App\Http\Controllers\ObjectiveController::class, 'allDelete']);
    Route::delete('/objectives/{objective_id}\delete', [\App\Http\Controllers\ObjectiveController::class, 'delete']);
    Route::get('/objectives/{objective_id}', [\App\Http\Controllers\ObjectiveController::class, 'getObjective']);
    Route::post('/objectives/create', [\App\Http\Controllers\ObjectiveController::class, 'create']);
    Route::get('/objectives/{objective_id}/finish', [\App\Http\Controllers\ObjectiveController::class, 'finish']);
    Route::get('/objectives/{objective_id}/undo_finish', [\App\Http\Controllers\ObjectiveController::class, 'undoFinish']);

    Route::get('/objectives/{objective_id}/tasks', [\App\Http\Controllers\TaskController::class, 'showTasks']);
    Route::post('/objectives/{objective_id}/task/create', [\App\Http\Controllers\TaskController::class, 'createTask']);
    Route::put('/objectives/{objective_id}/task/{id}/edit_title', [\App\Http\Controllers\TaskController::class, 'editTitle']);
    Route::put('/objectives/{objective_id}/task/{id}/edit_note', [\App\Http\Controllers\TaskController::class, 'editNote']);
    Route::get('/objectives/{objective_id}/task/{id}/start', [\App\Http\Controllers\TaskController::class, 'start']);
    Route::get('/objectives/{objective_id}/task/{id}/finish', [\App\Http\Controllers\TaskController::class, 'finish']);
    Route::get('/objectives/{objective_id}/task/{id}/undo_start', [\App\Http\Controllers\TaskController::class, 'undoStart']);
    Route::get('/objectives/{objective_id}/task/{id}/undo_finish', [\App\Http\Controllers\TaskController::class, 'undoFinish']);
    Route::delete('/objectives/{objective_id}/task/{id}/delete', [\App\Http\Controllers\TaskController::class, 'deleteTask']);
    Route::put('/objectives/{objective_id}/task/{id}/start', [\App\Http\Controllers\TaskController::class, 'setStartDate']);
    Route::put('/objectives/{objective_id}/task/{id}/finish', [\App\Http\Controllers\TaskController::class, 'setFinishDate']);

    Route::post('/objectives/share', [\App\Http\Controllers\SharedObjectiveController::class, 'share']);
    Route::delete('/objectives/private/{objective_id}', [\App\Http\Controllers\SharedObjectiveController::class, 'private']);
    Route::get('/objectives/shared_id/{objective_id}', [\App\Http\Controllers\SharedObjectiveController::class, 'getSharedObjectiveId']);

});





