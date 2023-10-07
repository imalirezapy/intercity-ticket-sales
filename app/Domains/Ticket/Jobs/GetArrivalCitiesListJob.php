<?php

namespace App\Domains\Ticket\Jobs;

use App\Contracts\Repositories\PlanRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Lucid\Units\Job;

class GetArrivalCitiesListJob extends Job
{
    public function __construct(
        private readonly PlanRepositoryInterface $repository,
    )
    {
        //
    }

    public function handle(string $departureCity): Collection|EloquentCollection
    {
        return $this->repository->getArrivalCitiesListByDeparture($departureCity);
    }
}
