<?php

namespace App\Domains\Ticket\Jobs;

use App\Contracts\Repositories\BookingRepositoryInterface;
use Lucid\Units\Job;

class DeleteBookingByIdJob extends Job
{
    /**
     * Create a new job instance.
     *
     */
    public function __construct(
        private readonly BookingRepositoryInterface $repository,
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     */
    public function handle(int $bookingId): bool
    {
        return $this->repository->delete($bookingId);
    }
}
