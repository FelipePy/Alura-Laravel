<x-layout title="Nova Série">

    <form action={{ route('series.store') }} method="post" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-8">
                <label for="name" class="form-label">Nome:</label>
                <input type="text"
                       autofocus
                       id="name" name="name"
                       class="form-control"
                       placeholder="nome da série"
                       value="{{ old('name') }}"
                >
            </div>

            <div class="col-2">
                <label for="seasonsQty" class="form-label">N° Temporadas:</label>
                <input type="text"
                       id="seasonsQty" name="seasonsQty"
                       class="form-control"
                       placeholder="Número de temporadas"
                       value="{{ old('seasonsQty') }}"
                >
            </div>

            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">N° de episódios:</label>
                <input type="text"
                       id="episodesPerSeason" name="episodesPerSeason"
                       class="form-control"
                       placeholder="Número de episódios"
                       value="{{ old('episodesPerSeason') }}"
                >
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label">Capa</label>
                <input type="file"
                       class="form-control"
                       id="cover"
                       name="cover"
                       accept="image/gif, image/png, image/jpeg">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Criar</button>

    </form>

</x-layout>
