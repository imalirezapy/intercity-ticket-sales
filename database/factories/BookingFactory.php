<?php

namespace Database\Factories;

use App\Data\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'count' => $count = $this->faker->numberBetween(1, 15),
            'seats_numbers' => Arr::random(range(1, $count), $this->faker->numberBetween(1, $count)),
            'expires_at' => now()->addMinutes($this->faker->numberBetween(-5, 15)),
            'created_at' => now(),
        ];
    }
}
