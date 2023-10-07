<?php

namespace App\Services\Ticket\Http\Controllers\V1;

use App\Services\Ticket\Features\GetDepartureCitiesFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;

class PlanController extends Controller
{
    public function __construct(
        private readonly GetDepartureCitiesFeature $getDepartureCitiesFeature,
    )
    {
    }

    public function getDepartureCities(): Response
    {
        return $this->getDepartureCitiesFeature->handle();
    }
}
