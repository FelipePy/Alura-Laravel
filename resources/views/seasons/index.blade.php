<x-layout title="Temporadas de {{ $series->name }}">

    @isset($successMessage)
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endisset

    <div class="d-flex justify-content-center">
        <img src="{{ asset('storage/' . $series->cover) }}" alt="Capa da série {{ $series->name }}" style="width: 400; height: 400px;" class="img-fluid figure-img rounded">
    </div>
    <ul class="list-group">
        @foreach ($series->seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a class="link-dark" href='{{ route('episodes.index', $season->id) }}'>
                    Temporada {{ $season->number }}
                </a>

                <span class="badge bg-secondary">
                    {{ $season->watchedEpisodes() }} / {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>
