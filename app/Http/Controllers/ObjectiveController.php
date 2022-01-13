<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ObjectiveController extends Controller
{
    public function index(){
        $objectives = Objective::all();

        return $objectives;
    }

    //作成後のidを返す
    public function create(Request $request){
        $objective = new Objective();
        $objective->user_id = $request->user_id;
        $objective->title = $request->title;
        $objective->due_date = $request->due_date;

        $objective->save();
        return new JsonResponse(['objective_id' => $objective->id]);
    }
}
