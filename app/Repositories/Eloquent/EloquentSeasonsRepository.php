<?php

namespace App\Repositories\Eloquent;

use App\Models\Season;
use App\Repositories\SeasonsRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentSeasonsRepository implements SeasonsRepository
{

    public function create(array $seasons)
    {
        return Season::insert($seasons);
    }

    public function find(int $id): ? Season
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

    public function update(Season $seasons)
    {
        $seasons->update();
    }
}
