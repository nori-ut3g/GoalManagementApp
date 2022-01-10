<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if ($this->getGuard()->attempt($credentials)) {
            $request->session()->regenerate();

            return new JsonResponse(['message' => 'ログインしました']);
        }

        throw new Exception('ログインに失敗しました。再度お試しください');
    }

    //
    public function logout(Request $request)
    {
        $this->getGuard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('app');
    }

    private function getGuard(){
        return Auth::guard(config('auth.defaults.guard'));
    }
}

