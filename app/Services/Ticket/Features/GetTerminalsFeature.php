<?php

namespace App\Services\Ticket\Features;

use App\Composables\Responses\Features\PresentsSuccessfully;
use App\Domains\Ticket\Jobs\GetTerminalsListJob;
use App\Domains\Ticket\Requests\FetchTerminalsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lucid\Units\Feature;

class GetTerminalsFeature extends Feature
{
    use PresentsSuccessfully;

    public function __construct(
        private readonly GetTerminalsListJob $getTerminalsListJob,
    )
    {
    }

    public function handle(FetchTerminalsRequest $request): Response
    {
        return $this->presentData(
            $this->getTerminalsListJob->handle($request->getCityCode())
        );
    }
}
