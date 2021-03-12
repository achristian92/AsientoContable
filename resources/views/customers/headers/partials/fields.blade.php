@csrf
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="name">Nombre Cabecera</label>
        @include('components.input-sm',['name' => 'name'])
    </div>
</div>
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="name">Orden</label>
        @include('components.input-number-sm',['name' => 'order'])
    </div>
</div>
<button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
