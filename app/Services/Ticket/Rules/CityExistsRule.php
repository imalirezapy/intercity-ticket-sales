<?php

namespace App\Services\Ticket\Rules;

use App\Data\Models\Plan;
use App\Enums\ResponseMessageKeys;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CityExistsRule implements ValidationRule
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
        # TODO: move this into repository
        $city = Plan::where('arrival_city', $value)
            ->orWhere('departure_city', $value)
            ->first();

        if (is_null($city)) {
            $fail(__( ResponseMessageKeys::INVALID_CITY->value));
        }
    }

}
