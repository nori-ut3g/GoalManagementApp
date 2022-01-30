<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{



    public function login(Request $request)
    {

        //validator

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            Auth::attempt($credentials);
            $request->session()->regenerate();
            return new JsonResponse(['message' => 'ログインしました']);
        }else{
            throw new AuthenticationException;
        }

    }

    //
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return new JsonResponse(['message' => 'ログアウトしました']);
    }

    private function getGuard(){
        return Auth::guard(config('auth.defaults.guard'));
    }
}

