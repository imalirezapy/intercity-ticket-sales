<?php

namespace App\Services\Ticket\Features;

use App\Composables\Responses\Features\PresentsSuccessfully;
use App\Composables\Responses\Features\ThrowsNotFound;
use App\Domains\Ticket\Jobs\DeleteBookingByIdJob;
use App\Enums\ResponseMessageKeys;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lucid\Units\Feature;

class DeleteBookingFeature extends Feature
{
    use ThrowsNotFound,
        PresentsSuccessfully;

    public function __construct(
        private readonly DeleteBookingByIdJob $deleteBookingByIdJob,
    )
    {
    }

    public function handle(int $bookingId): Response
    {
        $deleted = $this->deleteBookingByIdJob->handle($bookingId);
        if (!$deleted) {
            $this->notFound();
        }

        return $this->presentSuccessfulResponse(
            ResponseMessageKeys::SUCCESS_BOOKING_DELETED->value,
        );
    }
}
