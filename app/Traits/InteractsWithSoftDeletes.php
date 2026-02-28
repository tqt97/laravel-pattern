<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use LogicException;

trait InteractsWithSoftDeletes
{
    public function restore(Model $model): void
    {
        if (! method_exists($model, 'restore')) {
            throw new LogicException('Model does not support soft deletes.');
        }

        if (! $model->trashed()) {
            return;
        }

        $model->restore();
    }

    public function forceDelete(Model $model): void
    {
        if (! method_exists($model, 'forceDelete')) {
            throw new LogicException('Model does not support soft deletes.');
        }

        $model->forceDelete();
    }

    public function findWithTrashed(int|string $id): ?Model
    {
        return $this->query()->withTrashed()->find($id);
    }
}
