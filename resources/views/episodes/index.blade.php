<x-layout title="Episódios da temporada {{ $season->number }}">

    @isset($successMessage)
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endisset

    <ul class="list-group">
        <form action="{{ route('episodes.store', $season->id, $season->episodes()) }}" method="post" >
            @csrf
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
