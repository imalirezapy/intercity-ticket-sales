<?php

namespace App\Data\DTO;

use App\Composables\DTO\DTO;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Data\Models\User;
use Illuminate\Support\Carbon;

class PlanDTO extends DTO
{
    const COLUMNS = [
        'id',
        'code',
        'departure_city',
        'arrival_city',
        'departure_terminal',
        'arrival_terminal',
        'departure_week_day',
        'departure_time',
        'duration',
        'total_capacity',
        'remain_capacity_r',
        'bus_type',
        'price_in_rial',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    private User|null $model = null;

    protected string $repository = UserRepositoryInterface::class;

    public function __construct(
        public int|null           $id = null,
        public string|null        $code = null,
        public string|null        $departure_city = null,
        public string|null        $arrival_city = null,
        public string|null        $departure_terminal = null,
        public string|null        $arrival_terminal = null,
        public int|null           $departure_week_day = null,
        public Carbon|string|null $departure_time = null,
        public int|null           $duration = null,
        public int|null           $total_capacity = null,
        public int|null           $remain_capacity_r = null,
        public string|null        $bus_type = null,
        public int|null           $price_in_rial = null,
        public Carbon|string|null $created_at = null,
        public Carbon|string|null $updated_at = null,
        public Carbon|string|null $deleted_at = null,
    )
    {
    }
}
