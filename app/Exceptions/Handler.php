<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $e)
    {
        if($e instanceof HttpException) {
            $code = $e->getStatusCode();
            $message = Response::$statusTexts[$code];

            return $this->errorResponse($message, $code);
        }

        if($e instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($e->getModel()));

            return $this->errorResponse("Does not exist any instance of {$model} with the given parameter", Response::HTTP_NOT_FOUND);
        }

        if($e instanceof AuthorizationException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if($e instanceof AuthenticationException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if($e instanceof ValidationException) {
            $errors = $e->validator->errors()->getMessages();

            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY); 
        }

        if($e instanceof ValidationException) {
            $errors = $e->validator->errors()->getMessages();

            return $this->errorResponse($errors, Response::HTTP_UNAUTHORIZED); 
        }
        
        if($e instanceof ExpiredException) {

            return $this->errorResponse('Su sesión ha expirado. Inicie sesión nuevamente.', Response::HTTP_UNAUTHORIZED); 
        }

        if(env('APP_DEBUG', false))
            return parent::render($request, $e);

        return $this->errorResponse('Unexpected error. Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
