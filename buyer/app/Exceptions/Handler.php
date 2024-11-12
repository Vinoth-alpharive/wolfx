<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use \Illuminate\Http\Exceptions\PostTooLargeException;
use \Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {  
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json(['success' => false,"error" => true, 'message' => 'Method Not Allowed!']);
            }
            if ($exception instanceof TokenMismatchException) {
                // Redirect to a form. Here is an example of how I handle mine
               return response()->json(['success' => false,"error" => true, 'message' => "Oops! Seems you couldn't submit form for a long time. Please try again."]);
            }

            // 404 page when a model is not found
            if ($exception instanceof ModelNotFoundException) {
                return response()->json(['success' => false,"error" => true, 'message' => "Oops! Not Found"]);
            }

            if ($exception instanceof PostTooLargeException) { 
                return response()->json(['success' => false,"error" => true, 'message' => "Oops! image may not be greater than 10,240 kilobytes. Please try again."]); 
            }

            if ($exception instanceof NotFoundHttpException) { 
                return response()->json(['success' => false,"error" => true, 'message' => "Page not found"]); 
            }

            if ($exception instanceof AuthenticationException) { 
                return response()->json(['success' => false,"error" => true, 'message' => "Unauthenticated!"]); 
            }
            return response()->json(['success' => false,"error" => true, 'message' => "Whoops, looks like something went wrong! $exception"]); 
        }
		if ($exception instanceof MethodNotAllowedHttpException) {
            return redirect()->back();
        }
        if ($exception instanceof TokenMismatchException) {
            // Redirect to a form. Here is an example of how I handle mine
            return redirect()->back()->with('error', "Oops! Seems you couldn't submit form for a long time. Please try again.");
        }

        // 404 page when a model is not found
        if ($exception instanceof ModelNotFoundException) {
           return response()->view('errors.404', [], 404);
        }
        if ($exception instanceof PostTooLargeException) {       
            return redirect()->back()->with('error', "Oops! image may not be greater than 10,240 kilobytes. Please try again.");        
        }
		// custom error message
        if ($exception instanceof \ErrorException) {
           //return response()->view('errors.404', [], 500);
        } else {
            return parent::render($request, $exception);
        }
        return parent::render($request, $exception);
    }
}
