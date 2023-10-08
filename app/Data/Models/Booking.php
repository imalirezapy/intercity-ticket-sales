<?php

namespace App\Data\Models;


use App\Composables\Models\Relations\BookingModelRelations;
use App\Enums\TablesEnum;
use Database\Factories\BookingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, BookingModelRelations;

    protected $table = TablesEnum::BOOKINGS->value;
    protected $guarded = []; // FIXME: dev only

    protected $casts = [
        'expires_at' => 'datetime',
        'seats_numbers' => 'json',
    ];

    protected static function newFactory()
    {
        return BookingFactory::new();
    }
}
