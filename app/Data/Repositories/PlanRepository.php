<?php

namespace App\Data\Repositories;

use App\Contracts\Repositories\PlanRepositoryInterface;
use App\Data\DTO\PlanDTO;
use App\Data\Models\Plan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PlanRepository implements PlanRepositoryInterface
{

    public function findModel(int $id): ?Plan
    {
        return Plan::find($id);
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

    # TODO: refactor
    public function getTerminalListByCityCode(string $cityCode): Collection|EloquentCollection
    {
        $plans = Plan::select('departure_city', 'arrival_city', 'departure_terminal', 'arrival_terminal')
            ->where('departure_city', $cityCode)
            ->orWhere('arrival_city', $cityCode)
            ->distinct('departure_terminal', 'arrival_terminal')
            ->get();

        $terminals = collect();
        foreach ($plans as $plan) {
            if ($plan->arrival_city === $cityCode) {
                $terminals[] = ['terminal' => $plan->arrival_terminal];
            } else if ($plan->departure_city === $cityCode) {
                $terminals[] = ['terminal' => $plan->departure_terminal];
            }
        }

        return $terminals;

    }

    public function getListParametric(array $params, ?int $perPage = null): LengthAwarePaginator
    {
        return Plan::where('departure_time', '>', now())
            ->when(isset($params['arrival_place']) && isset($params['departure_place']), function ($query) use($params){
                $departPlace = $params['departure_place'];
                $arrivePlace = $params['arrival_place'];
                $query->where(function ($q) use($arrivePlace) {
                    $q->where('arrival_terminal', $arrivePlace)
                        ->orWhere('arrival_city', $arrivePlace);
                })->where(function ($q) use($departPlace) {
                    $q->where('departure_terminal', $departPlace)
                        ->orWhere('departure_city', $departPlace);
                });
            })
            ->when(isset($params['datetime']), function ($query) use ($params) {
                $query->where('departure_time', Carbon::createFromTimestamp($params['datetime']));
            })
            ->latest()
            ->paginate($perPage);
    }
}
