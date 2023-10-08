<?php

namespace App\Domains\Ticket\Jobs;

use App\Contracts\Repositories\PlanRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Lucid\Units\Job;

class GetBookingsOfPlanByIdJob extends Job
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

    public function handle(int $planId): Collection|EloquentCollection
    {
        return $this->repository->findModel($planId)->bookings;
    }
}
