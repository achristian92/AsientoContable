@csrf
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Razón social</label>
        @include('components.input-sm',['name' => 'name'])
    </div>
    <div class="form-group col-md-6">
        <label for="inputPassword4">RUC</label>
        @include('components.input-number-sm',['name' => 'ruc'])
    </div>
</div>
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Dirección</label>
        @include('components.input-sm',['name' => 'address'])
    </div>
    <div class="form-group col-md-6">
        <label for="inputPassword4">Teléfono</label>
        @include('components.input-sm',['name' => 'phone'])
    </div>
</div>
<h5 class="text-muted">Contacto</h5>
<div class="form-row mb-1">
    <div class="form-group col-md-4">
        @include('components.input-group-sm',['title'=>'Nombre', 'name' => 'contact_name'])
    </div>
    <div class="form-group col-md-4">
        @include('components.input-group-sm',['title'=>'Email', 'name' => 'contact_email'])
    </div>
    <div class="form-group col-md-4">
        @include('components.input-group-sm',['title'=>'Teléfono', 'name' => 'contact_phone'])
    </div>
</div>
<button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
