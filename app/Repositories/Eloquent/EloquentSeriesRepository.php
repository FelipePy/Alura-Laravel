<?php

namespace App\Repositories\Eloquent;

use App\Models\Series;
use App\Repositories\EpisodesRepository;
use App\Repositories\SeasonsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentSeriesRepository implements SeriesRepository
{
    public function __construct(private SeasonsRepository $seasonRepository, private EpisodesRepository $episodeRepository)
    {
    }

    public function create(array $attributes): Series
    {
        $serie = Series::create($attributes);
        $this->create_season($serie->id, $attributes['seasonsQty']);
        $this->create_episode($serie->seasons, $attributes['episodesPerSeason']);
        return $serie;
    }

    public function find(int $id): ? Series
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

    public function update(Series $series): void
    {
        $series->update();
    }

    public function create_season(int $series_id, int $seasonsQty): void
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

    public function create_episode(Collection $seasons, int $episodesPerSeason): void
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
