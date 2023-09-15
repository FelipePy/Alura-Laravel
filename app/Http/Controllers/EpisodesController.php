<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use App\Repositories\EpisodesRepository;
use App\Repositories\SeasonsRepository;
use DateTime;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Season $season, SeasonsRepository $repository)
    {
        $season = $repository->find($season->id);
        $episodes = $season->episodes();
        return view('episodes.index')
            ->with('season', $season);
    }

    public function store(Request $request, EpisodesRepository $repository, Season $season)
    {
        $watchedEpisodes = $request->episodes;
        $episodes = $season->episodes;

        # TODO: Alterar somente aqueles que foram modificados.
        # Todos os episódios estão sendo alterados, o que faz com que seu updated_at seja atualizado.

        $episodes->each(function ($episode) use ($watchedEpisodes) {
            if (!$episode->watched && in_array($episode->id, $watchedEpisodes)) {
                echo "$episode->id True";
                $episode->watched = true;
                $episode->updated_at = new DateTime('now', new \DateTimeZone('America/Sao_Paulo'));

            } elseif ($episode->watched && !in_array($episode->id, $watchedEpisodes)) {
                echo "$episode->id False";
                $episode->watched = false;
                $episode->updated_at = new DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
            }
        });

        $episodes = $episodes->toArray();
        $repository->create($episodes);

        return to_route('episodes.index', $season->id);
    }
}
