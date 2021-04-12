@csrf
<div class="form-row mb-1">
    <div class="form-group col-md-3">
        @include('components.input-group-sm', ['title' => 'Nombres', 'name' => 'name'])
    </div>
    <div class="form-group col-md-3">
        @include('components.input-group-sm', ['title' => 'Código', 'name' => 'code'])
    </div>
    <div class="form-group col-md-3">
        @include('components.input-group-sm', ['title' => 'Símbolo', 'name' => 'symbol'])
    </div>
    <div class="form-group col-md-3">
        @include('components.input-group-sm', ['title' => 'Valor', 'name' => 'rate'])
    </div>
</div>
<button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
