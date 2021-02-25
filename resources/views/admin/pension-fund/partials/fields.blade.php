@csrf
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="cod">Código</label>
        @include('components.input-sm',['name' => 'code'])
    </div>
</div>
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="name">Abreviatura</label>
        @include('components.input-sm',['name' => 'short'])
    </div>
</div>
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="name">Nombre</label>
        @include('components.input-sm',['name' => 'name'])
    </div>
</div>
<button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
