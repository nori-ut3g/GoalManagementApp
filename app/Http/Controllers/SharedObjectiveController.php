<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use App\Models\SharedObjective;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SharedObjectiveController extends Controller
{
    // shareする
    public function share(Request $request){
        $objective = Objective::find($request->objective_id);
        $sharedObjective = new SharedObjective();
        $sharedObjective->objective_id = $objective->id;
        $sharedObjective->save();
        return $sharedObjective;
    }

    public function private($objective_id){
        $sharedObjectives = SharedObjective::where('objective_id', $objective_id)->get();

        foreach ($sharedObjectives as $sharedObjective){
            $sharedObjective->delete();
        }
    }


    public function getSharedObjectiveId($objective_id){

        $sharedObjective = SharedObjective::where('objective_id', $objective_id)->first();

        if($sharedObjective === null){
            return new JsonResponse(['shared_objective' => null]);
        }else{
            return new JsonResponse(['shared_objective' => $sharedObjective[0]]);
        }
    }

    //シェア用
    public function getSharedObjective($shared_objective_id){
        $sharedObjective = SharedObjective::find($shared_objective_id);
        if($sharedObjective === null){
            return new JsonResponse(['objective' => null]);
        }else{
            $objective = Objective::find($sharedObjective->objective_id);
            return new JsonResponse(['objective' => $objective]);
        }
    }


}
