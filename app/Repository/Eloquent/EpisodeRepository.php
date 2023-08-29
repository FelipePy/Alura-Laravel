<?php

namespace App\Repository\Eloquent;

use App\Http\Middleware\TrimStrings;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EpisodeRepository implements EloquentRepositoryInterface
{

    public function create(array $episodes)
    {
        return Episode::insert($episodes);
    }

    public function find(int $id): ? Model
    {
        return Episode::findOrFail($id);
    }

    public function findAll(): Collection
    {
        return Episode::query()->get();
    }

    public function delete(int $id): int
    {
        return Episode::destroy($id);
    }

    public function update(Episode|Model $model)
    {
        $model->update();
    }
}

