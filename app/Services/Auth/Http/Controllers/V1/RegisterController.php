<?php

namespace App\Services\Auth\Http\Controllers\V1;

use App\Domains\Auth\Requests\RegisterRequest;
use App\Services\Auth\Features\RegisterFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/register",
 *     tags={"Auth"},
 *     summary="register user with email and password",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="first_name", type="string", description="first name", nullable=true),
 *             @OA\Property(property="last_name", type="string", description="last name", nullable=true),
 *             @OA\Property(property="email", type="string", format="email", example="example@gmail.com"),
 *             @OA\Property(property="password", type="string", format="password", description="Must be greater than 6", example="password")
 *
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful register new user"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable - Invalid credentials"
 *     )
 * )
 */
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
