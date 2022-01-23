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
    public function showTasks(string $objective_id){
        return Task::where('objective_id', $objective_id)->get();
    }

    //タスクの新規作成
    public function createTask(Request $request){

        $task = new Task();
        $task->order = 0;
        $task->objective_id = $request->objective_id;
        $task->status = $request->status;
        $task->title = $request->title;
        $task->note = $request->note;
//        $task->start_date = Carbon::now();
        $task->start_date = null;
//        $task->finish_date = Carbon::now();
        $task->finish_date = null;
        $task->save();
        return new JsonResponse(['task' => $task]);

    }

    //タスクの内容変更
    public function editTitle(string $objective_id, string $id, Request $request){
        $task = Task::find($id);
        $task->title = $request->title;
        $task->save();
    }

    public function editNote(string $objective_id, string $id, Request $request){
        $task = Task::find($id);
        $task->note = $request->note;
        $task->save();
    }

    //タスク開始
    public function start(string $objective_id, string $id){
        $task = Task::find($id);
        $task->start_date = Carbon::now();
        $task->status = 1;
        $task->save();
    }

    //タスク終了
    public function finish(string $objective_id, string $id){
        $task = Task::find($id);
        $task->finish_date = Carbon::now();
        $task->status = 2;
        $task->save();
    }

    //タスク開始へ戻す
    public function undoStart(string $objective_id, string $id){
        $task = Task::find($id);
        $task->start_date = null;
        $task->status = 0;
        $task->save();
    }

    public function undoFinish(string $objective_id, string $id){
        $task = Task::find($id);
        $task->finish_date = null;
        $task->status = 1;
        $task->save();
    }

    public function deleteTask(string $objective_id, string $id){
        $task = Task::find($id);
        $task->delete();
    }



    //タスク開始
    public function setStartDate(string $objective_id, string $id, Request $request){
        $task = Task::find($id);
        $task->start_date = $request->start_date;
        $task->save();

    }

    //タスク終了
    public function setFinishDate(string $objective_id, string $id, Request $request){
        $task = Task::find($id);
        $task->finish_date = $request->finish_date;
        $task->save();
    }

}
