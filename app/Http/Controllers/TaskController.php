<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function showTasks(int $objective_id){
        return Task::where('objective_id', $objective_id)->get();
    }

    //タスクの新規作成
    public function createTask(Request $request){

        $task = new Task();
        $task->order = 0;
        $task->objective_id = (int)$request->objective_id;
        $task->status = $request->status;
        $task->title = $request->title;
        $task->contents = $request->contents;
        $task->start_date = Carbon::now();
        $task->finish_date = Carbon::now();
        $task->save();
        return new JsonResponse(['task' => $task]);

    }

    //タスクの内容変更
    public function editTitle(int $id, Request $request){
        $task = Task::find($id);
        $task->title = $request->title;
        $task->save();
    }

    public function editContents(int $id, Request $request){
        $task = Task::find($id);
        $task->contents = $request->contents;
        $task->save();
    }

    //タスク開始
    public function start(int $id){
        $task = Task::find($id);
        $task->start_date = Carbon::now();
        $task->save();
    }

    //タスク終了
    public function end(int $id){
        $task = Task::find($id);
        $task->finish_date = Carbon::now();
        $task->save();
    }

}
