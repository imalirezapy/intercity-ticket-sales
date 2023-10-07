<?php

namespace App\Services\Ticket\Http\Controllers\V1;

use App\Domains\Ticket\Requests\FetchArrivalCitiesRequest;
use App\Services\Ticket\Features\GetArrivalCitiesFeature;
use App\Services\Ticket\Features\GetDepartureCitiesFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;

class PlanController extends Controller
{
    public function __construct(
        private readonly GetDepartureCitiesFeature $getDepartureCitiesFeature,
        private readonly GetArrivalCitiesFeature $getArrivalCitiesFeature,
    )
    {
    }

    public function getDepartureCities(): Response
    {
        return $this->getDepartureCitiesFeature->handle();
    }

    public function getArrivalCities(FetchArrivalCitiesRequest $request): Response
    {
        return $this->getArrivalCitiesFeature->handle($request);
    }
}
