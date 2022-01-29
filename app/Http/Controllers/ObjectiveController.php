<?php

namespace App\Http\Controllers;

use App\Exceptions\RecordUpperLimitException;
use App\Models\Objective;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ObjectiveController extends Controller
{
    public function getUserObjectives(){
        return Auth::user()->objectives()->get();
    }

    public function getObjective($id){

        return Objective::find($id);
    }

    //作成後のidを返す
    public function create(Request $request){
        $user = Auth::user();
        //
        $maxNum = $user->getMaxObjectiveNum();

        if(count($user->objectives()->get()) >= $maxNum){
            $message = "目標設定数上限エラー";
            throw new RecordUpperLimitException($message);
        }

        $objective = new Objective();
        $objective->title = $request->title;
        $objective->due_date = $request->due_date;

        $user->objectives()->save($objective);


        return new JsonResponse(['objective_id' => $objective->id]);
    }

    public function finish($objective_id){
        $objective = Auth::user()
            ->objectives()
            ->where('id', $objective_id)
            ->get();

        $objective->status = 1;
        $objective->finish_date = Carbon::now();

        $objective->save();
    }

    public function undoFinish($objective_id){
        $objective = Auth::user()
            ->objectives()
            ->where('id', $objective_id)
            ->get();

        $objective->status = 0;
        $objective->finish_date = null;

        $objective->save();
    }

    public function delete($objective_id){
        $objective = Auth::user()
            ->objectives()
            ->where('id', $objective_id)
            ->get();

            $tasks = $objective->tasks()->get();
            foreach ($tasks as $task){
                $task -> delete();
            }
            $sharedObjectives = $objective->sharedObjectives()->get();

            foreach ($sharedObjectives as $sharedObjective){
                $sharedObjective->delete();
            }
            $objective -> delete();
        return new JsonResponse(['message' => '目標を削除しました。']);
    }

    public function allDelete(){
        $user = Auth::user();
        $objectives = $user->objectives()->get();

        foreach ($objectives as $objective){
            //目標内のタスクをすべて削除削除する
            $tasks = $objective->tasks()->get();
            foreach ($tasks as $task){
                $task -> delete();
            }

            //公開用DB内の関連データを削除する。
            $sharedObjectives = $objective->sharedObjectives()->get();
            foreach ($sharedObjectives as $sharedObjective){
                $sharedObjective->delete();
            }

            $objective -> delete();
        }
        return new JsonResponse(['message' => '目標を全て削除しました。']);

    }


}
