<?php

namespace App\Composables\DTO;

use App\Data\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class DTO
{
    abstract public function __construct();

    private Model|null $model = null;

    protected string $repository;

    const COLUMNS = [];

    public static function from(
        Model|null $model
    ): static|null
    {
        return ($model === null)
            ? null
            : new static(...static::instantiable($model));
    }

    public function getModel(): User|null
    {
        if ($this->model === null) {
            $this->model = $this->findModel();
        }

        return $this->model;
    }

    public function insertable(): array
    {
        $insertable = [];
        foreach (static::COLUMNS as $column) {
            if ($this->$column !== null){
                $insertable[$column] = $this->$column;
            }
        }

        return $insertable;
    }


    private static function instantiable(User $model): array|false
    {
        return ($model->id === null)
            ? false
            : $model->getAttributes();
    }

    private function findModel()
    {
        $repository = resolve($this->repository);

        return ($this->id !== null)
            ? $repository->findModel($this->id)
            : null;
    }

}
