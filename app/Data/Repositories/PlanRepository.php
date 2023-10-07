<?php

namespace App\Data\Repositories;

use App\Contracts\Repositories\PlanRepositoryInterface;
use App\Data\DTO\PlanDTO;
use App\Data\Models\Plan;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class PlanRepository implements PlanRepositoryInterface
{

    public function findModel(int $id): ?Plan
    {
        return Plan::where('id', $id)->first();
    }

    public function find(int $id): ?PlanDTO
    {
        return PlanDTO::from(
            $this->findModel($id)
        );
    }

    public function create(PlanDTO $data): ?PlanDTO
    {
        $plan = PlanDTO::create($data->insertable());

        return PlanDTO::from($plan);
    }

    public function update(int $id, PlanDTO $newData): bool
    {
        return $this->findModel($id)
            ->update($newData->insertable());
    }

    public function findByCode(string $code): ?PlanDTO
    {
        return PlanDTO::from(
            $this->findBy('code', $code)
        );
    }

    private function findBy(string $column, string $value): ?Plan
    {
        return Plan::where($column, $value)->first();
    }

    public function getDepartureCitiesList(): Collection|EloquentCollection
    {
        return Plan::select('departure_city')
            ->distinct()
            ->get();
    }

    public function getArrivalCitiesListByDeparture(string $departureCityCode): Collection|EloquentCollection
    {
        return Plan::select('departure_city', 'arrival_city')
                ->where('departure_city', $departureCityCode)
                ->distinct('arrival_city')
                ->get();
    }

    public function getTerminalListByCityCode(string $cityCode): Collection|EloquentCollection
    {
        return Plan::select('departure_city', 'arrival_city', 'departure_terminal')
            ->where('departure_city', $cityCode)
            ->orWhere('arrival_city', $cityCode)
            ->distinct('departure_terminal')
            ->get();
    }
}
