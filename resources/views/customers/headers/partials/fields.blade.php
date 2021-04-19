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
        <label for="name">Tipo(Opcional)</label>
        <select class="form-control" name="type">
            <option value="">Seleccionar</option>
            @foreach($types as $type)
                <option value="{{$type}}"
                    {{ ( $model->type == $type) ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-row mb-1">
    <div class="form-group col-md-6">
        <label for="name">Cuenta contable</label>
        <select class="form-control js-accounts" name="account_plan_id">
            <option value="">Seleccionar</option>
            @foreach($accounts as $account)
                <option value="{{$account->id}}"
                {{ ( $model->account_plan_id == $account->id) ? 'selected' : '' }}>
                    {{$account->code}}-{{ $account->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input"
           type="radio"
           name="is_account_main"
           id="ismainaccount"
           value="1"
        {{ old('is_active',$model->is_account_main) ? 'checked' : '' }}>
    <label class="form-check-label" for="ismainaccount">Cuenta Principal</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input"
           type="radio"
           name="is_account_main"
           id="ismainaccount2"
           value="0"
        {{ old('is_account_main',!$model->is_account_main) ? 'checked' : '' }}>
    <label class="form-check-label" for="ismainaccount2">Cuenta Secundaria</label>
</div>
<br>
<br>
@if ($model->id)
    <h5>Estado</h5>
    <div class="form-check form-check-inline">
        <input class="form-check-input"
               type="radio"
               name="is_active"
               id="radio1"
               value="1"
            {{ old('is_active',$model->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="radio1">Activar</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input"
               type="radio"
               name="is_active"
               id="radio2"
               value="0"
            {{ old('is_active',!$model->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="radio2">Desactivar</label>
    </div>
@endif
<br>
<br>
<button type="submit" class="btn btn-sm btn-primary"> Guardar </button>
<a href="{{ $back }}" class="btn btn-sm btn-outline-light ml-2"> Regresar </a>
