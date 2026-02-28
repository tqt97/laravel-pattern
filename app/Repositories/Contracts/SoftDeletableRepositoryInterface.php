<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface SoftDeletableRepositoryInterface
{
    public function restore(int|string $id): bool;

    public function forceDelete(int|string $id): bool;

    public function findWithTrashed(int|string $id): ?Model;
}
