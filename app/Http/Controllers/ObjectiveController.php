<?php

namespace App\Http\Controllers;

use App\Exceptions\RecordUpperLimitException;
use App\Models\Objective;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
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

        $objective = Objective::find($id);
        $user_id = Auth::id();

        if($objective->user_id !== $user_id){
            throw new AuthenticationException;
        }

        return Objective::find($id);
    }

    //作成後のidを返す
    public function create(Request $request){
        $user = Auth::user();
        $maxNum = $user->getMaxObjectivesNum();

        if(count($user->objectives()->get()) >= $maxNum){
            $message = $maxNum . "個以上の目標は作成できません。";
            throw new RecordUpperLimitException($message);
        }

        $objective = new Objective();
        $objective->title = $request->title;
        $objective->due_date = $request->due_date;

        $user->objectives()->save($objective);


        return new JsonResponse(['objective_id' => $objective->id]);
    }

    public function setStartDate(Request $request){
        $objective = Auth::user()
            ->objectives()
            ->find($request->objective_id);
        $objective->start_date = $request->start_date;
        $objective->save();
    }
    public function setDueDate(Request $request){
        $objective = Auth::user()
            ->objectives()
            ->find($request->objective_id);
        $objective->due_date = $request->due_date;
        $objective->save();
    }

    public function finish($objective_id){
        $objective = Auth::user()
            ->objectives()
            ->find($objective_id);



        $objective->status = 1;
        $objective->finish_date = Carbon::now();

        $objective->save();
    }

    public function undoFinish($objective_id){
        $objective = Auth::user()
            ->objectives()
            ->find($objective_id);

        $objective->status = 0;
        $objective->finish_date = null;

        $objective->save();
    }

    public function delete($objective_id){
        $objective = Auth::user()
            ->objectives()
            ->find($objective_id);

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
