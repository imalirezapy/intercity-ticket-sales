<?php

namespace App\Domains\Auth\Jobs;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Data\DTO\UserDTO;
use Lucid\Units\Job;

class CreateUserJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     */
    public function handle(UserDTO $data): UserDTO
    {
        return $this->repository->create($data);
    }
}
