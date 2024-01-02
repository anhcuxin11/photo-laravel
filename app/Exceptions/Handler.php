<?php

namespace App\Exceptions;

use App\Transformers\ErrorResource;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (ApiException $e, $request) {
            return $this->makeErrorResponse($e->getCode(), $e->getMessage(), null, $e->getData());
        });
    }

    /**
     * @param int $code
     * @param string $message
     * @param array|null $errors
     * @param mixed|null $data
     * @return Response
     */
    protected function makeErrorResponse(int $code, string $message, ?array $errors = null, $data = null): Response
    {
        return (new ErrorResource($code, $message, $errors, $data))->response()->setStatusCode($code);
    }
}
