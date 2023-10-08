<?php

namespace App\Domains\Ticket\Jobs;

use App\Contracts\Repositories\PlanRepositoryInterface;
use App\Data\DTO\PlanDTO;
use Lucid\Units\Job;

class GetPlanByUlidJob extends Job
{
    /**
     * Create a new job instance.
     *
     */
    public function __construct(
        private readonly PlanRepositoryInterface $repository,
    )
    {
        //
    }

    public function handle(string $planId): ?PlanDTO
    {
        return $this->repository->find($planId);
    }
}
