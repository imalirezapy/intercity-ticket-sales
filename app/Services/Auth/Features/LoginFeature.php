<?php

namespace App\Services\Auth\Features;

use App\Composables\Responses\Features\PresentsSuccessfully;
use App\Composables\Responses\Features\ThrowsFailure;
use App\Composables\Responses\Features\ThrowsValidationError;
use App\Domains\Auth\Jobs\AttemptCredentialsJob;
use App\Domains\Auth\Jobs\GenerateTokenJob;
use App\Domains\Auth\Jobs\GetUserByEmailJob;
use App\Domains\Auth\Requests\LoginRequest;
use App\Enums\ResponseMessageKeys;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lucid\Units\Feature;

class LoginFeature extends Feature
{
    use ThrowsValidationError,
        PresentsSuccessfully;

    const FAILED_MESSAGE = ResponseMessageKeys::CREDENTIALS_ERROR->value;
    const SUCCESS_MESSAGE = ResponseMessageKeys::NEW_TOKEN_GENERATED->value;

    private string $tokenName = 'login';

    public function __construct(
        private readonly AttemptCredentialsJob $attemptCredentialsJob,
        private readonly GetUserByEmailJob $getUserByEmailJob,
        private readonly GenerateTokenJob $generateTokenJob,
    )
    {
    }

    public function handle(LoginRequest $request): Response
    {
        if (!$this->attemptCredentialsJob->handle($request->getEmail(), $request->getPass())) {
            return $this->validationErrorResponse(
                self::FAILED_MESSAGE,

            );
        }

        $user = $this->getUserByEmailJob->handle($request->getEmail());

        $token = $this->generateTokenJob->handle($user->id, $this->tokenName);

        return $this->presentMessagefulData(
            [
                'token' => $token,
            ],
            self::SUCCESS_MESSAGE,
        );
    }
}
