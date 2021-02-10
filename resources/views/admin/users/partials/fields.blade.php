@csrf
<div class="form-row mb-1">
    <div class="form-group col-md-4">
        @include('components.input-group-sm', ['title' => 'Nombres', 'name' => 'name'])
    </div>
    <div class="form-group col-md-4">
        @include('components.input-group-sm', ['title' => 'Apellidos', 'name' => 'last_name'])
    </div>
    <div class="form-group col-md-4">
        @include('components.input-group-sm', ['title' => 'Documento', 'name' => 'nro_document'])
    </div>
</div>
<div class="form-row mb-1">
    <div class="form-group col-md-4">
        @include('components.input-group-sm', ['title' => 'Teléfono', 'name' => 'phone'])
    </div>
    <div class="form-group col-md-4">
        @include('components.input-group-sm', ['title' => 'Correo', 'name' => 'email'])
    </div>
</div>
<h5 class="text-muted">Roles</h5>
<div class="form-group row">
    @foreach($roles as $rol)
        <div class="col-sm-3">
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    name="roles[]"
                    value="{{ $rol->id }}">
                <label class="form-check-label" >
                    {{ $rol->name }}
                </label>
            </div>
        </div>
    @endforeach
</div>




<button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
