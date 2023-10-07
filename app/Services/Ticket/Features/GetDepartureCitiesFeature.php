<?php

namespace App\Services\Ticket\Features;

use App\Composables\Responses\Features\PresentsSuccessfully;
use App\Domains\Ticket\Jobs\GetDepartureCitiesListJob;
use Illuminate\Http\Response;
use Lucid\Units\Feature;

class GetDepartureCitiesFeature extends Feature
{
    use PresentsSuccessfully;

    public function __construct(
        private readonly GetDepartureCitiesListJob $getDepartureCitiesListJob,
    )
    {
    }

    public function handle(): Response
    {
        return $this->presentData(
            $this->getDepartureCitiesListJob->handle()
        );
    }
}
