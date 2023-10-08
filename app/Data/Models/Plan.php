<?php

namespace App\Data\Models;

use App\Enums\TablesEnum;
use Database\Factories\PlanFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory, HasUlids;

    protected $primaryKey = 'ulid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = TablesEnum::PLANS->value;
    protected $guarded = []; // FIXME: dev only

    protected $casts = [
        'departure_time' => 'timestamp',
    ];

    protected static function newFactory()
    {
        return PlanFactory::new();
    }
}
