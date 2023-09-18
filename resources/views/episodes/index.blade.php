<x-layout title="Episódios da temporada {{ $season->number }}" :successMessage="$successMessage">

    <ul class="list-group">
        <form action="{{ route('episodes.update', $season->id, $season->episodes()) }}" method="post" >
            @csrf
            @method('PUT')
            @foreach ($season->episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episode->number }}
                        <input type="checkbox"
                               name="episodes[]"
                               value="{{ $episode->id }}"
                        @if($episode->watched) checked @endif >

                </li>
            @endforeach
            <button class="btn btn-primary mt-2 mb-2">Salvar</button>
        </form>

    </ul>
</x-layout>
