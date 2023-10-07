<?php

namespace App\Data\Models;

use Database\Factories\PlanFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $casts = [
        'departure_time' => 'timestamp',
    ];

    protected static function newFactory()
    {
        return PlanFactory::new();
    }
}
