<form action="{{ $action }}" method="post">
    @csrf

    @if($update)
        @method('PUT')
        {{ $buttonText = 'Editar' }}
    @else
        {{ $buttonText = 'Adicionar' }}
    @endif

    <div class="mb-3">
        <input type="text"
               id="nome" name="nome"
               class="form-control"
               @isset($nome)value="{{ $nome }}" @endisset
        >
    </div>

    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>

</form>
