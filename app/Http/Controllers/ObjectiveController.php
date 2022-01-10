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
}