<?php


namespace App\Exceptions;
use Exception;
use Throwable;

class ApiGeneralException extends Exception {

    /**
     * @var
     */
    public $message;

    public $method;

    /**
     * GeneralException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $method = null, $code = 0, Throwable $previous = null)
    {
        $this->method = $method;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        /*
         * All instances of GeneralException redirect back with a flash message to show a bootstrap alert-error
         */
        return response()->json([
            'status' => false,
            'method' => $this->method,
            'text' => $this->message
        ]);
    }
}