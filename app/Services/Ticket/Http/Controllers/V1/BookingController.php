<?php

namespace App\Services\Ticket\Http\Controllers\V1;

use App\Domains\Ticket\Requests\BookPlanRequest;
use App\Services\Ticket\Features\BookPlanFeature;
use App\Services\Ticket\Features\DeleteBookingFeature;
use Illuminate\Http\Response;
use Lucid\Units\Controller;

class BookingController extends Controller
{
    public function __construct(
        private readonly BookPlanFeature $bookPlanFeature,
        private readonly DeleteBookingFeature $deleteBookingFeature,
    )
    {
    }

    public function store(BookPlanRequest $request): Response
    {
        return $this->bookPlanFeature->handle($request);
    }

    public function delete(int $bookingId): Response
    {
        return $this->deleteBookingFeature->handle($bookingId);
    }
}
