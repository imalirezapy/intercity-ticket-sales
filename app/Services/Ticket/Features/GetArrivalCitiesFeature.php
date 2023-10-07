<?php

namespace App\Services\Ticket\Features;

use App\Composables\Responses\Features\PresentsSuccessfully;
use App\Domains\Ticket\Jobs\GetArrivalCitiesListJob;
use App\Domains\Ticket\Requests\FetchArrivalCitiesRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lucid\Units\Feature;

class GetArrivalCitiesFeature extends Feature
{
    use PresentsSuccessfully;

    public function __construct(
        private readonly GetArrivalCitiesListJob $getArrivalCitiesListJob,
    )
    {
    }

    public function handle(FetchArrivalCitiesRequest $request): Response
    {
        return $this->presentMessagefulData(
            $this->getArrivalCitiesListJob->handle($request->getCityCode())
        );
    }
}
