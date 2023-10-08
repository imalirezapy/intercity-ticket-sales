<?php

namespace Database\Factories;

use App\Data\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class PlanFactory extends Factory
{
    protected $model = Plan::class;

    private array $cities = [
        'ahvaz',
        'arak',
        'ardabil',
        'bandar-abbas',
        'birjand',
        'bojnord',
        'bushehr',
        'gorgan',
        'hamadan',
        'ilam',
        'isfahan',
        'karaj',
        'kerman',
        'kermanshah',
        'khorramabad',
        'mashhad',
        'qazvin',
        'qom',
        'rasht',
        'sanandaj',
        'sari',
        'semnan',
        'shahr-,e Kord',
        'shiraz',
        'tabriz',
        'tehran',
        'urmia',
        'yasuj',
        'yazd',
        'zahedan',
        'zanjan',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'departure_city' => $departCity = Arr::random($this->cities),
            'arrival_city' => $arriveCity = Arr::random($this->cities),
            'departure_terminal' => $departCity . '-tr' . fake()->randomNumber(1),
            'arrival_terminal' => $arriveCity . '-tr' . fake()->randomNumber(1),
            'departure_week_day' => fake()->numberBetween(0, 6),
            'departure_time' => fake()->dateTime(),
            'duration' => fake()->numberBetween(60, 450),
            'total_capacity' => fake()->numberBetween(15, 30),
            'remain_capacity_r' => fake()->numberBetween(0, 30),
            'bus_type' => fake()->sentence(),
            'price_in_rial' => fake()->numberBetween(70, 150) . "0000000",
            "created_at" => now(),
        ];
    }
}
