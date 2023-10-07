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
        'Ahvaz',
        'Arak',
        'Ardabil',
        'Bandar',
        'Abbas',
        'Birjand',
        'Bojnord',
        'Bushehr',
        'Gorgan',
        'Hamadan',
        'Ilam',
        'Isfahan',
        'Karaj',
        'Kerman',
        'Kermanshah',
        'Khorramabad',
        'Mashhad',
        'Qazvin',
        'Qom',
        'Rasht',
        'Sanandaj',
        'Sari',
        'Semnan',
        'Shahr-,e Kord',
        'hiraz',
        'Tabriz',
        'Tehran',
        'Urmia',
        'Yasuj',
        'Yazd',
        'Zahedan',
        'Zanjan',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->sentence(),
            'departure_city' => Arr::random($this->cities),
            'arrival_city' => Arr::random($this->cities),
            'departure_terminal' => Arr::random($this->cities) . '-tr' . fake()->randomNumber(1),
            'arrival_terminal' => Arr::random($this->cities) . '-tr' . fake()->randomNumber(1),
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
