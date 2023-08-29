<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\SeasonRepository;
use App\Repository\Eloquent\SerieRepository;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    private SeasonRepository $seasonRepository;
    private SerieRepository $serieRepository;

    public function __construct()
    {
        $this->seasonRepository = new SeasonRepository();
        $this->serieRepository = new SerieRepository();
    }
    public function index(Request $request)
    {
        $series = $this->serieRepository->find($request->series);
        return view('seasons.index')
            ->with('seasons', $series->seasons)
            ->with('series', $series);
    }
}
