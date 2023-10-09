<?php

namespace App\Composables\Models\Attributes;


use App\Data\Models\Booking;
use App\Enums\TablesEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;

trait PlanAttributes
{
    public function remainCapacity(): Attribute
    {
        return Attribute::get(
            fn() => $this->total_capacity - ($this->remain_capacity_r + $this->bookings()->sum('count'))
        );
    }

    public function availableSeats(): Attribute
    {
        return Attribute::get(
            fn() => collect(range(1, $this->total_capacity))
                ->diff($this->bookings()
                    ->pluck('seats_numbers')
                    ->flatten(1)
                    ->unique())
        );
    }
}
