<?php

namespace App\Data\DTO;

use DragonCode\SimpleDataTransferObject\DataTransferObject;
use Illuminate\Support\Carbon;

class UserDTO extends DataTransferObject
{
    public int|null $id = null;
    public string|null $first_name = null;
    public string|null $last_name = null;
    public string|null $email = null;
    public Carbon|string|null $email_verified_at = null;
    public ?string $password = null;
    public bool|int $is_admin = false;
    public Carbon|string|null $created_at = null;
    public Carbon|string|null $updated_at = null;
    public Carbon|string|null $deleted_at = null;

    public function insertable(): array
    {
        $insertable = [];
        foreach ($this->toArray() as $column => $value) {
            if ($value !== null){
                $insertable[$column] = $value;
            }
        }

        return $insertable;
    }
}
