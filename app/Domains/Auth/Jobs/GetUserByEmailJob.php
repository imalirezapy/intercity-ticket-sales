<?php

namespace App\Domains\Auth\Jobs;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Data\DTO\UserDTO;
use Lucid\Units\Job;

class GetUserByEmailJob extends Job
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    )
    {
        //
    }

    public function handle(string $email): ?UserDTO
    {
        return $this->repository->findByEmail($email);
    }
}
