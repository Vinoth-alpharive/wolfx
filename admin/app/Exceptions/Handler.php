<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use \Illuminate\Http\Exceptions\PostTooLargeException;

class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception) {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception) {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return redirect()->back();
        }
        if ($exception instanceof TokenMismatchException) {
            // Redirect to a form. Here is an example of how I handle mine
            return redirect()->back()->with('error', "Oops! Seems you couldn't submit form for a long time. Please try again.");
        }

        // 404 page when a model is not found
        if ($exception instanceof ModelNotFoundException) {
            //return response()->view('errors.404', [], 404);
        }
        if ($exception instanceof PostTooLargeException) {       
            return redirect()->back()->with('error', "Oops! image may not be greater than 10,240 kilobytes. Please try again.");        
        }

        // custom error message
        if ($exception instanceof \ErrorException) {
          // return response()->view('errors.500', [], 500);
        } else {
            //return parent::render($request, $exception);
        }
        return parent::render($request, $exception);

    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception) {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        return redirect('/');
    }
}
