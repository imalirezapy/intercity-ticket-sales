<?php

namespace App\Contracts\Repositories;

use App\Data\DTO\PlanDTO;
use App\Data\Models\Plan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Laravel\Sanctum\NewAccessToken;

interface PlanRepositoryInterface
{
    public function findModel(int $id): ?Plan;

    public function find(int $id): ?PlanDTO;

    public function create(PlanDTO $data): ?PlanDTO;

    public function update(int $id, PlanDTO $newData): bool;

    public function findByCode(string $code): ?PlanDTO;

    public function getDepartureCitiesList(): Collection|EloquentCollection;

    public function getArrivalCitiesListByDeparture(string $departureCityCode): Collection|EloquentCollection;

    public function getTerminalListByCityCode(string $cityCode): Collection|EloquentCollection;

    public function getListParametric(array $params, ?int $perPage = null): LengthAwarePaginator;
}
