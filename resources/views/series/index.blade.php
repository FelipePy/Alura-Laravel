<x-layout title="Séries" :successMessage="$successMessage">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar série</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item justify-content-between d-flex align-items-center">
                @auth<a class="link-dark" href='{{ route('seasons.index', $serie->id) }}'>@endauth
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $serie->cover) }}" alt="Capa da série {{ $serie->name }}" width="100" class="img-fluid figure-img rounded me-3">
                        {{ $serie->name }}
                    </div>
                @auth</a>@endauth

                @auth
                    <span class="d-flex">
                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                            E
                        </a>

                        <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                X
                            </button>
                        </form>
                    </span>
                @endauth

            </li>
        @endforeach
    </ul>
</x-layout>
