<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    public function index(){
        $objectives = Objective::all();

        return $objectives;
    }

    public function create(Request $request){
        $objective = new Objective();
        $objective->title = $request->title;
        $objective->due_date = $request->due_date;

        $objective->save();
    }
}
