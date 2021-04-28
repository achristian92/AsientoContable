@csrf
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Razón social</label>
        @include('components.input-sm',['name' => 'name'])
    </div>
    <div class="form-group col-md-6">
        <label for="inputEmail4">RUC</label>
        @include('components.input-number-sm',['name' => 'ruc'])
    </div>
</div>
<div class="form-row mb-1">
    <div class="form-group col-md-4">
        <label for="inputEmail4">Correo electronico</label>
        @include('components.input-sm',['name' => 'email'])
    </div>
    <div class="form-group col-md-4">
        <label for="inputEmail4">Teléfonos</label>
        @include('components.input-sm',['name' => 'phones'])
    </div>
    <div class="form-group col-md-4">
        <label for="inputEmail4">Nombre Contacto</label>
        @include('components.input-sm',['name' => 'contact_name'])
    </div>
</div>
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Dirección</label>
        @include('components.input-sm',['name' => 'address'])
    </div>
</div>
@if(isset($model->id))
    <div class="form-check mt-0">
        <input
            class="form-check-input"
            type="checkbox"
            name="is_active"
            id="isActive"
            {{ old('is_active',$model->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="isActive" >
            Activar
        </label>
    </div>
    <div class="form-group row">
        <div class="col text-right">
            <a href="#destroy-{{$model->id}}" data-toggle="modal" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash mr-2"></i> Eliminar</a>
        </div>
    </div>
@endif
<button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
