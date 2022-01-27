<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    //

    public function emailValidator(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
//            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json('OK', Response::HTTP_OK);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20', 'min:4'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
//            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json('ユーザ登録しました', Response::HTTP_OK);
    }

    private function getGuard(){
        return Auth::guard(config('auth.defaults.guard'));
    }
}
