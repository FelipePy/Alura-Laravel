<?php

namespace App\Repository\Eloquent;

use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SerieRepository implements EloquentRepositoryInterface
{

    public function create(array $attributes): ? Model
    {
        $series = Series::create($attributes);
        return $series;
    }

    public function find(int $id): ? Model
    {
        return Series::findOrFail($id);
    }

    public function findAll(): Collection
    {
        return Series::query()->get();
    }

    public function delete(int $id): int
    {
        return Series::destroy($id);
    }

    public function update(Series|Model $model)
    {
        $model->update();
    }

    public function create_season(int $series_id, int $seasonsQty)
    {
        $seasons = [];
        for ($i = 1; $i <= $seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $series_id,
                'number' => $i
            ];
        }
        return $seasons;
    }

    public function create_episode(Collection $seasons, int $episodesPerSeason)
    {
        $episodes = [];
        foreach ($seasons as $season) {
            for ($i = 1; $i <= $episodesPerSeason; $i++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $i
                ];
            }
        }
        return $episodes;
    }
}
