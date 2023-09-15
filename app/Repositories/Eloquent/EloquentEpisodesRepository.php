<?php

namespace App\Repositories\Eloquent;

use App\Models\Episode;
use App\Repositories\EpisodesRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentEpisodesRepository implements EpisodesRepository
{
    public function create(array $episodes)
    {
        return Episode::upsert($episodes,
            ['id'],
            ['watched', 'updated_at']);
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
}
