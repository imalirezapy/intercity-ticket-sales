<?php

namespace App\Services\Ticket\Rules;

use App\Domains\Ticket\Jobs\GetPlanByIdJob;
use App\Enums\ResponseMessageKeys;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PassengersSeatNumbersRule implements ValidationRule
{
    /**
     * Indicates whether the rule should be implicit.
     *
     * @var bool
     */
    public $implicit = true;

    /**
     * Run the validation rule.
     *
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var GetPlanByIdJob $getBookingsOfPlanByIdJob */
        $getBookingsOfPlanByIdJob = resolve(GetPlanByIdJob::class);

        $availableSeats = $getBookingsOfPlanByIdJob->handle(request()->route('planId'))
            ->available_seats
            ->toArray();

        $invalidSeats = [];
        foreach ($value as $seat) {
            if (!in_array($seat, $availableSeats)) {
                $invalidSeats[] = $seat;
            }
        }
        if (!empty($invalidSeats)) {
            $fail(__( ResponseMessageKeys::INVALID_SEATS_NUMBERS->value, [
                'numbers' => join(', ', $invalidSeats)
            ]));
        }
    }
}
