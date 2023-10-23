<x-mail::message>
# Olá {{\Illuminate\Support\Facades\Auth::user()->name}}!
Uma nova Série foi criada.

 - Nome da série: {{ $seriesName }}
 - Quantidade de temporadas: {{ $seasonsQty }}
 - Quantidade de episódios: {{ $episodesPerSeason }}

Acesse aqui:
<x-mail::button :url="route('seasons.index', $seriesId)">
    Ver Série
</x-mail::button>
</x-mail::message>
