<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface SoftDeletableRepositoryInterface
{
    public function restore(Model $model): bool;

    public function forceDelete(Model $model): bool;
}
