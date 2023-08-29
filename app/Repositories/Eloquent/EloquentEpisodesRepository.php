<?php

namespace App\Repositories\Eloquent;

use App\Models\Episode;
use App\Repositories\EpisodesRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentEpisodesRepository implements EpisodesRepository
{
    public function create(array $episodes)
    {
        return Episode::insert($episodes);
    }

    public function find(int $id): ? Episode
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

    public function update(Episode $episodes)
    {
        $episodes->update();
    }




}
