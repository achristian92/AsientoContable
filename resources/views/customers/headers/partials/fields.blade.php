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
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="name">R.Cuenta Contable</label>
        <select class="form-control" id="exampleFormControlSelect1" name="heacher_accounting_id">
            @foreach($headers as $header)
                <option value="{{$header->id}}">{{ $header->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
