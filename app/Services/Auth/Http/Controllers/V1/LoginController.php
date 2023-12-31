<?php

namespace App\Services\Auth\Http\Controllers\V1;

use App\Domains\Auth\Requests\LoginRequest;
use App\Services\Auth\Features\LoginFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/login",
 *     tags={"Auth"},
 *     summary="Login user with email and password",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="email", type="string", format="email", example="example@gmail.com"),
 *             @OA\Property(property="password", type="string", format="password", description="Must be greater than 6", example="password")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful login"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable - Invalid credentials"
 *     )
 * )
 */
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
