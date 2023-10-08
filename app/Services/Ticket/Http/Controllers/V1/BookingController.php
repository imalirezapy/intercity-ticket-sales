<?php

namespace App\Services\Ticket\Http\Controllers\V1;

use App\Domains\Ticket\Requests\BookPlanRequest;
use App\Services\Ticket\Features\BookPlanFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;

class BookingController extends Controller
{
    public function __construct(
        private readonly BookPlanFeature $bookPlanFeature,
    )
    {
    }


    public function store(BookPlanRequest $request): Response
    {
        return $this->bookPlanFeature->handle($request);
    }
}
