<?php

namespace App\Http\Controllers;

use App\Exceptions\RecordUpperLimitException;
use App\Models\Objective;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function showTasks(string $objective_id){
        return Task::where('objective_id', $objective_id)->get();
    }

    public function createMultipleTasks(Request $request){
        $user = Auth::user();
        $maxNum = $user->getMaxTasksNum();
        $objective = Auth::user()
            ->objectives()
            ->find($request->objective_id);

        $referenceTasks = $request->tasks;

        if(count($referenceTasks) >= $maxNum){
            $message = $maxNum . "個以上のタスクは作成できません。Importするにはアップグレードが必要です。";
            throw new RecordUpperLimitException($message);
        }
        foreach ($referenceTasks as $referenceTask){
            $newTask = new Task();
            $newTask->order = 0;
            $newTask->user_id = Auth::id();
            $newTask->objective_id = $request->objective_id;
            $newTask->status = 0;
            $newTask->title = $referenceTask['title'];
            $newTask->note = $referenceTask['note'];
            $newTask->start_date = null;
            $newTask->finish_date = null;

            $newTask->save();
        }
    }

    //タスクの新規作成
    public function createTask(Request $request){
        $user = Auth::user();
        $maxNum = $user->getMaxTasksNum();
        $objective = Auth::user()
            ->objectives()
            ->find($request->objective_id);

        if(count($objective->tasks()->get()) >= $maxNum){
            $message = $maxNum . "個以上のタスクは作成できません。";
            throw new RecordUpperLimitException($message);
        }

        $task = new Task();
        $task->order = 0;
        $task->user_id = Auth::id();
        $task->objective_id = $request->objective_id;
        $task->status = $request->status;
        $task->title = $request->title;
        $task->note = $request->note;
        $task->start_date = null;
        $task->finish_date = null;
        $task->save();

        return new JsonResponse(['task' => $task]);

    }

    //タスクの内容変更
    public function editTitle(string $objective_id, string $id, Request $request){
        //TODO:check
        $user = Auth::user();
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



    //タスク開始日設定
    public function setStartDate(string $objective_id, string $id, Request $request){
        $task = Task::find($id);
        $task->start_date = $request->start_date;
        $task->save();

    }

    //タスク終了日設定
    public function setFinishDate(string $objective_id, string $id, Request $request){
        $task = Task::find($id);
        $task->finish_date = $request->finish_date;
        $task->save();
    }

}
