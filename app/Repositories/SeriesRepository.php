<?php

namespace App\Repositories;

use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;

interface SeriesRepository
{
    public function create(array $attributes): Series;
    public function find(int $id): ? Series;
    public function findAll(): Collection;
    public function delete(int $id);
    public function update(Series $series);
    public function create_season(int $series_id, int $seasonsQty): void;
    public function create_episode(Collection $seasons, int $episodesPerSeason): void;
}
