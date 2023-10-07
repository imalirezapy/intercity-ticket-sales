<?php

namespace App\Contracts\Repositories;

use App\Data\DTO\UserDTO;
use App\Data\Models\User;
use Laravel\Sanctum\NewAccessToken;

interface UserRepositoryInterface
{
    public function findModel(int $id): ?User;

    public function find(int $id): ?UserDTO;

    public function create(UserDTO $data): ?UserDTO;

    public function update(int $id, UserDTO $newData): bool;

    public function createToken(int $id, string $tokenName): NewAccessToken;

    public function findByEmail(string $email): ?UserDTO;
}
