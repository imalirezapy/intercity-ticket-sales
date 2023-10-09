<?php

namespace App\Domains\Ticket\Jobs;

use App\Contracts\Repositories\BookingRepositoryInterface;
use App\Data\DTO\BookingDTO;
use Lucid\Units\Job;

class GetBookingByIdJob extends Job
{
    /**
     * Create a new job instance.
     *
     */
    public function __construct(
        private readonly BookingRepositoryInterface $repository,
    )
    {

    }

    /**
     * Execute the job.
     *
     */
    public function handle(int $bookingId): ?BookingDTO
    {
        return $this->repository->find($bookingId);
    }
}
