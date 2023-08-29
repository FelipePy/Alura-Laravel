<?php

namespace App\Repository\Eloquent;

use App\Models\Series;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SerieRepository implements EloquentRepositoryInterface
{
    private SeasonRepository $seasonRepository;
    private EpisodeRepository $episodeRepository;

    public function __construct()
    {
        $this->seasonRepository = new SeasonRepository();
        $this->episodeRepository = new EpisodeRepository();
    }

    public function create(array $attributes): ? Model
    {
        $series = Series::create($attributes);
        $this->create_season($series->id, $attributes['seasonsQty']);
        $this->create_episode($series->seasons, $attributes['episodesPerSeason']);
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

    private function create_season(int $series_id, int $seasonsQty)
    {
        $seasons = [];
        for ($i = 1; $i <= $seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $series_id,
                'number' => $i
            ];
        }
        $this->seasonRepository->create($seasons);
    }

    private function create_episode(Collection $seasons, int $episodesPerSeason)
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
        $this->episodeRepository->create($episodes);
    }
}
