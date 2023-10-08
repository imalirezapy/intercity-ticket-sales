<?php

namespace App\Composables\DTO;

use Illuminate\Database\Eloquent\Model;

abstract class DTO
{
    abstract public function __construct();

    private Model|null $model = null;

    protected string $repository;

    protected static string $primaryKey = 'id';

    const COLUMNS = [];

    public static function from(
        Model|null $model
    ): static|null
    {
        return ($model === null)
            ? null
            : new static(...(self::instantiable($model)));
    }



    public function getModel(): Model|null
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


    private static function instantiable(Model $model): array|false
    {
        return ($model->{static::$primaryKey} === null)
            ? false
            : static::getAttributes($model);
    }

    private static function getAttributes(Model $model): array
    {
        $attrs = [];
        foreach (static::COLUMNS as $COLUMN) {
            $attrs[$COLUMN] = $model->$COLUMN;
        }
        return $attrs;
    }

    private function findModel()
    {
        $repository = resolve($this->repository);

        return ($this->{static::$primaryKey} !== null)
            ? $repository->findModel($this->{static::$primaryKey})
            : null;
    }

}
