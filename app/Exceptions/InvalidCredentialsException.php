<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvalidCredentialsException extends Exception
{
    public function render(Request $request): Response
    {
        return response('invalid credentials');
    }
}
