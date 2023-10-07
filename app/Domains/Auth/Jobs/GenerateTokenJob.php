<?php

namespace App\Domains\Auth\Jobs;

use App\Contracts\Repositories\UserRepositoryInterface;
use Laravel\Sanctum\NewAccessToken;
use Lucid\Units\Job;

class GenerateTokenJob extends Job
{
    /**
     * Create a new job instance.
     *
     */
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    )
    {
        //
    }

    /**
     * create new access token
     */
    public function handle(int $id, string $tokenName): string
    {
        return $this->repository
            ->createToken($id, $tokenName)
            ->plainTextToken;
    }
}
