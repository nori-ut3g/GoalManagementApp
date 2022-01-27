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


}
