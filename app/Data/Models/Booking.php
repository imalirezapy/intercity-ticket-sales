<?php

namespace App\Data\Models;

use App\Composables\Database\Relations\BookingModelRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, BookingModelRelations;



    protected $casts = [
        'expires_at' => 'timestamp',
        'seats_numbers' => 'json',
    ];
}
