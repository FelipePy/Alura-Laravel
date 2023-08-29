<?php

namespace App\Http\Controllers;

use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Request $request, SeriesRepository $repository)
    {
        $series = $repository->find($request->series);
        return view('seasons.index')
            ->with('series', $series);
    }
}
