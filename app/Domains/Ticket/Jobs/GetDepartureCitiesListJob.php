<?php

namespace App\Domains\Ticket\Jobs;

use App\Contracts\Repositories\PlanRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Lucid\Units\Job;

class GetDepartureCitiesListJob extends Job
{

    public function __construct(
        private readonly PlanRepositoryInterface $repository,
    )
    {
        //
    }

    public function handle(): Collection|EloquentCollection
    {
        return $this->repository->getListByDepartureCity();
    }
}
