<?php

namespace App\Services\Ticket\Features;

use App\Composables\Responses\Features\PresentsSuccessfully;
use App\Domains\Ticket\Jobs\CreateBookingJob;
use App\Domains\Ticket\Requests\BookPlanRequest;
use App\Enums\ResponseMessageKeys;
use Hamcrest\SelfDescribing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lucid\Units\Feature;

class BookPlanFeature extends Feature
{
    use PresentsSuccessfully;

    const SUCCESS_MESSAGE = ResponseMessageKeys::SUCCESS_BOOKED_PLAN->value;

    public function __construct(
        private readonly CreateBookingJob $createBookingJob,
    )
    {

    }


    public function handle(BookPlanRequest $request): Response
    {
        $bookingDTO = $request->getBookingDTO();
        $bookingDTO->expires_at = now()->addMinutes(15);

        return $this->presentMessagefulData(
            data:$this->createBookingJob->handle($bookingDTO),
            message: self::SUCCESS_MESSAGE
        );
    }
}
