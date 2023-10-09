<?php

namespace App\Services\Ticket\Features;

use App\Composables\Responses\Features\PresentsSuccessfully;
use App\Composables\Responses\SendsResponses;
use App\Composables\Responses\SendsSuccessResponses;
use App\Contracts\Repositories\PlanRepositoryInterface;
use App\Data\Resources\PlanResource;
use App\Domains\Ticket\Requests\FetchPlansRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;
use Lucid\Units\Feature;

class FetchPlansFeature extends Feature
{
    use SendsSuccessResponses;

    public function __construct(
        private readonly PlanRepositoryInterface $repository,
    )
    {
    }

    public function handle(FetchPlansRequest $request): Response
    {
        return $this->successResponseForPaginated(
            $this->fetchPlansParametric(
                $request->validated(),
                $request->perPage(),
            ),
            PlanResource::class,
        );
    }

    #TODO: make job for this method
    private function fetchPlansParametric(array $params, ?int $perPage = null): LengthAwarePaginator
    {
        return $this->repository->getListParametric($params, $perPage);
    }
}
