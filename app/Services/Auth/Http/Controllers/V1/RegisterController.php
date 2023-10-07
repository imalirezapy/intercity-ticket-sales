<?php

namespace App\Services\Auth\Http\Controllers\V1;

use App\Domains\Auth\Requests\RegisterRequest;
use App\Services\Auth\Features\RegisterFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;

class RegisterController extends Controller
{
    public function __construct(
        private readonly RegisterFeature $registerFeature,
    )
    {
        //
    }

    public function __invoke(RegisterRequest $request): Response
    {
        return $this->registerFeature->handle($request);
    }
}
