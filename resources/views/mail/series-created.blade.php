<x-mail::message>
# Olá {{ $username }}!
Uma nova Série foi criada.

 - Nome da série: {{ $seriesName }}
 - Quantidade de temporadas: {{ $seasonsQty }}
 - Quantidade de episódios: {{ $episodesPerSeason }}

Acesse aqui:
<x-mail::button :url="route('seasons.index', $seriesId)">
    Ver Série
</x-mail::button>
</x-mail::message>
