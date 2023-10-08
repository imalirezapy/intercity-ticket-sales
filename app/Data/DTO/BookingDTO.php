<?php

namespace App\Data\DTO;

use App\Composables\DTO\DTO;
use App\Contracts\Repositories\BookingRepositoryInterface;
use App\Data\Models\Booking;
use Illuminate\Support\Carbon;

class BookingDTO extends DTO
{
    const COLUMNS = [
        'id',
        'user_id',
        'plan_id',
        'count',
        'seats_numbers',
        'expires_at',
        'created_at',
        'updated_at',
    ];

    private Booking|null $model = null;

    protected string $repository = BookingRepositoryInterface::class;

    public function __construct(
        public int|null           $id = null,
        public int|null           $user_id = null,
        public int|null           $plan_id = null,
        public int|null           $count = null,
        public array|string|null  $seats_numbers = null,
        public Carbon|string|null $expires_at = null,
        public Carbon|string|null $created_at = null,
        public Carbon|string|null $updated_at = null,
    )
    {
    }
}
