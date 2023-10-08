<?php

namespace App\Contracts\Repositories;

use App\Data\DTO\BookingDTO;
use App\Data\Models\Booking;
use Laravel\Sanctum\NewAccessToken;

interface BookingRepositoryInterface
{
    public function findModel(int $id): ?Booking;

    public function find(int $id): ?BookingDTO;

    public function create(BookingDTO $data): ?BookingDTO;

    public function update(int $id, BookingDTO $newData): bool;

    public function delete(int $id): bool;
}
