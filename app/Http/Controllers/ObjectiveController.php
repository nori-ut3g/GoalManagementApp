<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Carbon\Carbon;
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
        $user = Auth::user();
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
