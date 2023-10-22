<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WrongLoginException extends Exception
{
    public function report()
    {
        //
    }

    public function render()
    {
        return response()->json([
            'errors' => [
                'message' => 'O login utilizado não é do tipo de usuário candidato',
                'code' => ResponseAlias::HTTP_UNAUTHORIZED,
            ]
        ], ResponseAlias::HTTP_UNAUTHORIZED);
    }
}
