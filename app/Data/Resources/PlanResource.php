<?php

namespace App\Data\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'departure_city' => $this->departure_city,
            'arrival_city' => $this->arrival_city,
            'departure_terminal' => $this->departure_terminal,
            'arrival_terminal' => $this->arrival_terminal,
            'departure_week_day' => $this->departure_week_day,
            'departure_time' => $this->departure_time,
            'duration' => $this->duration,
            'total_capacity' => $this->total_capacity,
            'available_seats' => $this->available_seats,
            'remain_capacity' => $this->remain_capacity,
            'bus_type' => $this->bus_type,
            'price_in_rial' => $this->price_in_rial,
            'created_at' => $this->created_at,
        ];
    }
}
