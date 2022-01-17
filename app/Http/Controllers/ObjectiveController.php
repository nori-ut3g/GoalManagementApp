<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ObjectiveController extends Controller
{
    public function getUserObjectives(){
        $user_id = Auth::id();
        $objectives = Objective::where("user_id", $user_id)->get();

        return $objectives;
    }

    public function getObjective($id){

        return Objective::find($id);
    }

    //作成後のidを返す
    public function create(Request $request){
        $user_id = Auth::id();
        $objective = new Objective();
        $objective->user_id = $user_id;
        $objective->title = $request->title;
        $objective->due_date = $request->due_date;

        $objective->save();
        return new JsonResponse(['objective_id' => $objective->id]);
    }
}
