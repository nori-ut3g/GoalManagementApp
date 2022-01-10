<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    //
    public function login(Request $request){
        $result = false;
        $status = 401;
        $message = 'ユーザが見つかりません。';
        $user = null;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Success
            $result = true;
            $status = 200;
            $message = 'OK';
        }
        return response()->json(['result' => $result, 'status' => $status, 'message' => $message]);

        }
    }

