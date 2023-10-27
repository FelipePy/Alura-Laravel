<?php

namespace App\Repositories\Eloquent;

use App\Events\TransactionFailed;
use App\Models\Series;
use App\Repositories\EpisodesRepository;
use App\Repositories\SeasonsRepository;
use App\Repositories\SeriesRepository;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use function Illuminate\Events\queueable;

class EloquentSeriesRepository implements SeriesRepository
{
    public function __construct(private SeasonsRepository $seasonRepository, private EpisodesRepository $episodeRepository)
    {
        DB::beginTransaction();
    }

    public function __destruct()
    {
        // TODO: Posso criar um evento que observa sempre que algo relacionado ao banco de dados falhe
        // para que assim eu possa pegar ele no destruct e realizar o rollback ou commit

        Event::listen(function (TransactionFailed $event) {
            DB::rollBack();
        });
        DB::commit();
    }

    public function create(array $attributes): Series
    {
        $serie = Series::create($attributes);
        $this->create_season($serie->id, $attributes['seasonsQty']);
        $this->create_episode($serie->seasons, $attributes['episodePerSeason']);
        return $serie;

        #try {
         #   $serie = Series::create($attributes);
          #  $this->create_season($serie->id, $attributes['seasonsQty']);
           # $this->create_episode($serie->seasons, $attributes['episodePerSeason']);
            #DB::commit();
            #return $serie;
        #} catch (\Exception $e) {
         #   TransactionFailed::dispatch($e);
        #}
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
                'number' => $i,
                'created_at' => new DateTime('now', new \DateTimeZone('America/Sao_Paulo')),
                'updated_at' => new DateTime('now', new \DateTimeZone('America/Sao_Paulo'))
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
                    'number' => $i,
                    'created_at' => new DateTime('now', new \DateTimeZone('America/Sao_Paulo')),
                    'updated_at' => new DateTime('now', new \DateTimeZone('America/Sao_Paulo'))
                ];
            }
        }
        $this->episodeRepository->create($episodes);
    }
}
