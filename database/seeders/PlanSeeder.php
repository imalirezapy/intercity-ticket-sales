<?php

namespace Database\Seeders;

use App\Data\Models\Booking;
use App\Data\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::factory(50)->has(
            Booking::factory(5)
        )->create();
    }
}
