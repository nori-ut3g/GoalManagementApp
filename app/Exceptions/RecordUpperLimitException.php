<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecordUpperLimitException extends Exception
{
    public $request;
    public $message;

    public function __construct(string $message)
    {
        parent::__construct();

        $this->message = $message;
    }
}
