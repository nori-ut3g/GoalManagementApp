<?php

namespace App\Http\Controllers;

use App\Models\SharedObjective;
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

    public function changeEmail($request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
//            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        new JsonResponse(['message' => '名前を変更しました。']);
    }

    public function changeName($request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20', 'min:4'],
        ]);



        if ($validator->fails()) {
            throw new ValidationException($validator);
//            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = Auth::user();
        $user->name = $request->new_name;
        $user->save();

        new JsonResponse(['message' => '名前を変更しました。']);
    }

    public function changePassword($request){
        $user = Auth::user();

        if(!password_verify($request->current_password, $user->getAuthPassword())){
            new JsonResponse(['message' => 'passwordが違います']);
        }
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8']
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);

        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        new JsonResponse(['message' => 'passwordを変更しました。']);

    }

    public function delete(){
        $user = Auth::user();
        $objectives = $user->objectives()->get();

        foreach ($objectives as $objective){
            //目標内のタスクをすべて削除削除する
            $tasks = $objective->tasks()->get();
            foreach ($tasks as $task){
                $task -> delete();
            }

            //公開用DB内の関連データを削除する。
            $sharedObjectives = $objective->sharedObjectives()->get();
            foreach ($sharedObjectives as $sharedObjective){
                $sharedObjective->delete();
            }

            $objective -> delete();
        }
        $user->delete();

        return new JsonResponse(['message' => 'ユーザーデータを全て削除しました。']);
    }


    private function getGuard(){
        return Auth::guard(config('auth.defaults.guard'));
    }
}
