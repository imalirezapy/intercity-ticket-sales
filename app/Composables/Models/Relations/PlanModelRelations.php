<?php

namespace App\Composables\Models\Relations;

use App\Data\Models\Booking;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait PlanModelRelations
{
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'plan_id')
            ->where('expires_at', '>', now());
    }
}
