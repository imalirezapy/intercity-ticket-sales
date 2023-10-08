<?php

namespace App\Exceptions\Api;

use App\Composables\Responses\Features\ThrowsFailure;
use App\Composables\Responses\Features\ThrowsNotFound;
use App\Enums\ResponseMessageKeys;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiAuthenticationExceptionHandler extends ExceptionHandler
{
    use ThrowsFailure;

    public function render($request, Throwable $e)
    {
        $this->failedResponse(
            ResponseMessageKeys::UNAUTHORIZED->value,
            Response::HTTP_UNAUTHORIZED
        );
    }
}
