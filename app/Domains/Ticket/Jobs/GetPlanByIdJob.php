<?php

namespace App\Domains\Ticket\Jobs;

use App\Contracts\Repositories\PlanRepositoryInterface;
use App\Data\DTO\PlanDTO;
use Lucid\Units\Job;

class GetPlanByIdJob extends Job
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

    public function handle(int $planId): ?PlanDTO
    {
        return $this->repository->find($planId);
    }
}
