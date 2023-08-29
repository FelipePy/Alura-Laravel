<?php

namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface EloquentRepositoryInterface
{
    public function create(array $attributes);

    public function find(int $id): ? Model;

    public function findAll(): Collection;

    public function delete(int $id);

    public function update(Model $model);
}
