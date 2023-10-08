<?php

namespace App\Data\Repositories;

use App\Contracts\Repositories\BookingRepositoryInterface;
use App\Data\DTO\BookingDTO;
use App\Data\DTO\PlanDTO;
use App\Data\Models\Booking;
use App\Data\Models\Plan;

class BookingRepository implements BookingRepositoryInterface
{

    public function findModel(int $id): ?Booking
    {
        return Booking::where('id', $id)->first();
    }

    public function find(int $id): ?BookingDTO
    {
        return BookingDTO::from(
            $this->findModel($id)
        );
    }

    public function create(BookingDTO $data): ?BookingDTO
    {
        $created = Booking::create($data->insertable());

        return BookingDTO::from($created);
    }

    public function update(int $id, BookingDTO $newData): bool
    {
        return $this->findModel($id)
            ->update($newData->insertable());
    }

    public function delete(int $id): bool
    {
        return $this->findModel($id)->delete();
    }
}
