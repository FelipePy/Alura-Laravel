<?php

namespace App\Repository\Eloquent;

use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SeasonRepository implements EloquentRepositoryInterface
{

    public function create(array $seasons)
    {
        return Season::insert($seasons);
    }

    public function find(int $id): ? Model
    {
        return Season::findOrfail($id);
    }

    public function findAll(): Collection
    {
        return Season::query()->get();
    }

    public function delete(int $id): int
    {
        return Season::destroy($id);
    }

    public function update(Season|Model $model)
    {
        $model->update();
    }
}
