<x-layout title="Séries" :successMessage="$successMessage">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar série</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item justify-content-between d-flex align-items-center">
                <a class="link-dark" href='{{ route('seasons.index', $serie->id) }}'>
                    {{ $serie->name }}
                </a>

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

            </li>
        @endforeach
    </ul>
</x-layout>
