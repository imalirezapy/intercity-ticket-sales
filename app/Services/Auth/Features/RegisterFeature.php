<?php

namespace App\Services\Auth\Features;

use App\Composables\Responses\Features\PresentsSuccessfully;
use App\Data\Resources\UserResource;
use App\Domains\Auth\Jobs\CreateUserJob;
use App\Domains\Auth\Jobs\GenerateTokenJob;
use App\Domains\Auth\Requests\RegisterRequest;
use Illuminate\Http\Response;
use Lucid\Units\Feature;

class RegisterFeature extends Feature
{
    use PresentsSuccessfully;

    private string $tokenName = 'register';

    public function __construct(
        private readonly CreateUserJob $createUserJob,
        private readonly GenerateTokenJob $generateTokenJob,
    )
    {
    }

    public function handle(RegisterRequest $request): Response
    {
        $userDTO = $request->getUserDTO();
        $userDTO->password = bcrypt($request->getPass());

        $userDTO = $this->createUserJob->handle($userDTO);

        $token = $this->generateTokenJob->handle($userDTO->id, $this->tokenName);

        return $this->presentMessagefulData(
            [
                'user' => new UserResource($userDTO),
                'token' => $token,
            ]
        );
    }
}
