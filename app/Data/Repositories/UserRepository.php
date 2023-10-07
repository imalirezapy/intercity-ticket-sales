<?php

namespace App\Data\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Data\DTO\UserDTO;
use App\Data\Models\User;
use Laravel\Sanctum\NewAccessToken;

class UserRepository implements UserRepositoryInterface
{

    public function findModel(int $id): ?User
    {
        return User::where('id', $id)
                ->first();
    }

    public function find(int $id): ?UserDTO
    {
        return UserDTO::fromObject(
            $this->findModel($id)
        );
    }

    public function create(UserDTO $data): ?UserDTO
    {
        $user = User::create($data->insertable());

        return UserDTO::fromObject($user);
    }

    public function update(int $id, UserDTO $newData): bool
    {
        return $this->findModel($id)
            ->update($newData->insertable());
    }

    public function createToken(int $id, string $tokenName): NewAccessToken
    {
        return $this->findModel($id)->createToken($tokenName);
    }

    public function findByEmail(string $email): ?UserDTO
    {
        return UserDTO::fromObject(
            $this->findModelBy('email', $email)
        );
    }

    private function findModelBy(string $column, string $value): ?User
    {
        return User::where($column, $value)->first();
    }
}
