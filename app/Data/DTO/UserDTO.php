<?php

namespace App\Data\DTO;

use App\Composables\DTO\DTO;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Data\Models\User;
use Illuminate\Support\Carbon;

class UserDTO extends DTO
{
    const COLUMNS = [
        'id',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
        'is_admin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    private User|null $model = null;

    protected string $repository = UserRepositoryInterface::class;

    public function __construct(
        public int|null           $id = null,
        public string|null        $first_name = null,
        public string|null        $last_name = null,
        public string|null        $email = null,
        public Carbon|string|null $email_verified_at = null,
        public string|null        $password = null,
        public bool|null          $is_admin = null,
        public Carbon|string|null $created_at = null,
        public Carbon|string|null $updated_at = null,
        public Carbon|string|null $deleted_at = null,
    )
    {
    }
}
