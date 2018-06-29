<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
        //\Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        //file_put_contents('test.txt',$exception);
        if($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){

        }else if($exception instanceof \Illuminate\Validation\ValidationException){

        }else{
            
            ding()->at(['15738849971'])->text(config('app.name') . "\n" . (string) $exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->is('admin/*') && $request->ajax() && $exception instanceof ValidationException) {
            return response()->json([
                'Status' => 'Erro',
                'Erro' => $exception->validator->errors()->first(),
            ]);
        }
        if ($request->is('api/*') && $exception instanceof ValidationException) {
            return response()->json([
                'status' => '300',
                'message' => $exception->validator->errors()->first(),
                'data'=>[],
            ]);
        }

        return parent::render($request, $exception);
    }
}
