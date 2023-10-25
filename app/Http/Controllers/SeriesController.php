<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use \App\Events\Series\SeriesCreated as SeriesCreatedEvent;

class SeriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('authenticator')->except('index');
    }

    public function index(SeriesRepository $repository)
    {
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

    public function store(
        SeriesFormRequest $request,
        SeriesRepository $serieRepository
    )
    {
        $attributes = $request->all();

        # O DB::transaction serve para que se alguma coisa de errado na interação com o banco de dados,
        # Ele de rollback automaticamente.
        $series = DB::transaction(function () use ($attributes, $serieRepository) {
            return $serieRepository->create($attributes);
        });

        SeriesCreatedEvent::dispatch(
            $series->name,
            $series->id,
            $request->seasonsQty,
            $request->episodesPerSeason
        );

        return to_route('series.index')
            ->with('successMessage', "A série '{$series->name}' foi adicionada com sucesso.");
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
