<?php
namespace App\Composables\Models\Relations;


use App\Data\Models\Plan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BookingModelRelations
{
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
