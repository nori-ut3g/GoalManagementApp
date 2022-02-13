<?php

namespace App\Exceptions;

use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e){
        //api以外を除く
        if(!$request->is('api/*')){
            return parent::render($request, $e);
        }


        if($e instanceof ValidationException) {
            // バリデーションエラー発生時
            // controllerでthrow new ValidationException($validator)をなげる
            $message = $e->validator->messages();
            return response()->json([
                'message' => $message
            ], 400);

        }else if($e instanceof AuthenticationException){
            // 認証エラー
            // controllerでthrow new ValidationException($validator)をなげる
            return response()->json([
                'message' => '認証エラーが発生しました。'
            ], 401);
        }else if($e instanceof RecordUpperLimitException){
            // 認証エラー
            // controllerでthrow new ValidationException($validator)をなげる
            return response()->json([
                'message' => $e->message
            ], 406);
        }
//        else if($e instanceof QueryException){
//            // migrationでUserに上限Objective設定
//            // migrationでUserに上限Task設定
//            return response()->json([
//                'message' => 'レコードが登録されていません。'
//            ], 400);
//        }

        return parent::render($request, $e);
    }
}
