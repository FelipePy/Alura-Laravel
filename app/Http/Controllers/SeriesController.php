<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SeriesController extends Controller
{

    public function index(SeriesRepository $repository)
    {
        // return response('', ['Location' => 'url']);
        // Posso usar uma função chamada redirect('url')
        // Que faz o papel da linha 11
//        $series = [
//            'The Hundred',
//            'Dark',
//            'The rain',
//            'Peaky Blinders',
//            'Grey\'s Anatomy'
//        ];

        # $variables = compact('series');

        # $series = Series::all();
        # $baseRepository = new BaseRepository(new Series());
        #$series = $baseRepository->findAll();
        $series = $repository->findAll();
        $successMessage = session('successMessage');

        return view('series.index')
            ->with('series', $series)
            ->with('successMessage', $successMessage);
    }

    public function show(int $id, SeriesRepository $repository): View
    {
        $serie = $repository->find($id);
        return view('series.show')
            ->with('serie', $serie);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, SeriesRepository $serieRepository)
    {
        $attributes = $request->all();
        $serie = DB::transaction(function () use ($attributes, $serieRepository) {
            $serie = $serieRepository->create($attributes);

            return $serie;
        });

        return to_route('series.index')
            ->with('successMessage', "A série '{$serie->name}' foi adicionada com sucesso.");
    }

    public function destroy(Series $series, SeriesRepository $repository)
    {
        $repository->delete($series->id);

        return to_route('series.index')
            ->with('successMessage', "A série '{$series->name}' foi removida com sucesso.");
    }

    public function edit(Series $series)
    {
        return view('series.edit')
            ->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request, SeriesRepository $repository)
    {
        $series->fill($request->all());
        $repository->update($series);

        return to_route('series.index')
            ->with('successMessage', "A série '{$series->name}' foi alterada com sucesso.");
    }
}
