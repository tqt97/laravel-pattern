<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LogicException;

trait InteractsWithSoftDeletes
{
    protected function ensureSoftDeletes(Model $model): void
    {
        if (! in_array(SoftDeletes::class, class_uses_recursive($model))) {
            throw new LogicException(
                sprintf('%s does not use SoftDeletes.', $model::class)
            );
        }
    }

    public function restore(Model $model): void
    {
        $this->ensureSoftDeletes($model);

        if (! $model->trashed()) {
            return;
        }

        $model->restore();
    }

    public function forceDelete(Model $model): void
    {
        $this->ensureSoftDeletes($model);

        $model->forceDelete();
    }
}
