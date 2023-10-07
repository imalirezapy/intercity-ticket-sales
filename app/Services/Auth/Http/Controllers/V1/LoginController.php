<?php

namespace App\Services\Auth\Http\Controllers\V1;

use App\Domains\Auth\Requests\LoginRequest;
use App\Services\Auth\Features\LoginFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginFeature $loginFeature,
    )
    {
    }

    public function __invoke(LoginRequest $request): Response
    {
        return $this->loginFeature->handle($request);
    }

}
