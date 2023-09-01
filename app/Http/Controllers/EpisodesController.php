<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use App\Repositories\EpisodesRepository;
use App\Repositories\SeasonsRepository;
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
        if ($watchedEpisodes == null) {
            $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
                $episode->watched = false;
            });
        } else {
            $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
                $episode->watched = in_array($episode->id, $watchedEpisodes);
            });
        }

        $season->push();

        return to_route('episodes.index', $season->id);
    }
}
