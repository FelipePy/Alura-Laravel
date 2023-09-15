<?php

namespace App\Http\Controllers;

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
            ->with('season', $season)
            ->with('successMessage', session("successMessage"));
    }

    public function store(Request $request, EpisodesRepository $repository, Season $season)
    {
        if (!is_null($request->episodes)) {
            $watchedEpisodes = $request->episodes;
        } else {
            $watchedEpisodes = [];
        }

        $episodes = $season->episodes;

        $episodes->each(function ($episode) use ($watchedEpisodes) {
            if (!$episode->watched && in_array($episode->id, $watchedEpisodes)) {
                $episode->watched = true;
                $episode->updated_at = new DateTime('now', new \DateTimeZone('America/Sao_Paulo'));

            } elseif ($episode->watched && !in_array($episode->id, $watchedEpisodes)) {
                $episode->watched = false;
                $episode->updated_at = new DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
            }
        });

        $episodes = $episodes->toArray();
        $repository->create($episodes);

        return to_route('episodes.index', $season->id)
            ->with("successMessage", "Episódios alterados com sucesso.");
    }
}
