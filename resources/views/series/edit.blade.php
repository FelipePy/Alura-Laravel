<x-layout title="Editar Série {{ $series->name }}">
    <form action={{ route('series.update', $series) }} method="post">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-12">
                <label for="name" class="form-label">Nome:</label>
                <input type="text"
                       autofocus
                       id="name" name="name"
                       class="form-control"
                       value={{ $series->name }}>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Editar</button>

    </form>
</x-layout>

