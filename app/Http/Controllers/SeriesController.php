<?php

namespace App\Http\Controllers;

use App\Events\Series\DeletedSeries as DeletedSeriesEvent;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use App\services\SeriesService;
use Illuminate\Support\Facades\Validator;
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
        # TODO: melhorar essas validações
        $validator = Validator::make($request->all(),
            ['cover' => 'required|image'],
            [
                'cover.image' => 'O campo Capa deve ser uma imagem.',
                'cover.required' => 'O campo capa é obrigatório.'
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!is_uploaded_file($request->file('cover'))) {
            return redirect()
                ->back()
                ->withErrors('Essa mensagem não foi enviada corretamente.')
                ->withInput();
        }

        $path = SeriesService::create_path($request);
        $coverPath = $request->file('cover')->storeAs('series_cover', $path, 'public');

        $attributes = $request->all();

        $attributes['cover'] = $coverPath;
        $series = $serieRepository->create($attributes);

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
        $cover = $series->cover;
        $repository->delete($series->id);
        DeletedSeriesEvent::dispatch($cover);

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
