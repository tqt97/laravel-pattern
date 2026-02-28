<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    abstract protected function model(): string;

    /**
     * Get a new instance of the query builder for the repository.
     */
    protected function query(): Builder
    {
        return (new ($this->model()))->newQuery();
    }

    /**
     * Retrieve a model by its primary key or return null.
     */
    public function find(string|int $id): ?Model
    {
        return $this->query()->find($id);
    }

    /**
     * Creates a new model instance with given attributes.
     */
    public function create(array $attributes): Model
    {
        return $this->query()->create($attributes);
    }

    /**
     * Updates a model with a given id.
     */
    public function update(Model $model, array $attributes): Model
    {
        $model->fill($attributes);
        $model->save();

        return $model->refresh();
    }

    /**
     * Deletes a model with a given id.
     */
    public function delete(Model $model): void
    {
        $model->delete();
    }
}
