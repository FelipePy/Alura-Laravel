<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repository\Eloquent\SerieRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeriesController extends Controller
{

    private SerieRepository $serieRepository;

    public function __construct()
    {
        $this->serieRepository = new SerieRepository();
    }
    public function index(Request $request)
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
        $series = $this->serieRepository->findAll();
        $successMessage = session('success.message');

        return view('series.index')
            ->with('series', $series)
            ->with('successMessage', $successMessage);
    }

    public function show(int $id): View
    {
        $serie = $this->serieRepository->find($id);
        return view('series.show')
            ->with('serie', $serie);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = $this->serieRepository->create($request->all());

        return to_route('series.index')
            ->with('success.message', "A série '{$serie->name}' adicionada com sucesso.");
    }

    public function destroy(Series $series)
    {
        $this->serieRepository->delete($series->id);

        return to_route('series.index')
            ->with('success.message', "A série '{$series->name}' foi removida com sucesso.");
    }

    public function edit(Series $series)
    {
        return view('series.edit')
            ->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $this->serieRepository->update($series);

        return to_route('series.index')
            ->with('success.message', "A série '{$series->name}' foi alterada com sucesso.");
    }
}
