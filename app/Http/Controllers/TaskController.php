<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        return Task::all();
//        $objectives = Objective::all();
//
//        $current_Objective = Objective::find($id);
//
//        $tasks = Task::where('folder_id', $current_Objective->id)->get();
//        return $tasks;
    }
    public function showTasks(int $id){
        return Task::where('objective_id', $id)->get();
    }
}
