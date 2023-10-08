<?php

namespace App\Domains\Ticket\Jobs;

use App\Contracts\Repositories\BookingRepositoryInterface;
use App\Data\DTO\BookingDTO;
use Lucid\Units\Job;

class CreateBookingJob extends Job
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
    public function handle(BookingDTO $data): ?BookingDTO
    {
        return $this->repository->create($data);
    }
}
