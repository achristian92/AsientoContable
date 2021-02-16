@extends('layouts.admin.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="row">
        <div class="col-md-12 text-right" >
            <button type="button"
                    class="btn btn-outline-primary btn-pulse btn-sm"
                    data-toggle="modal"
                    data-target="#importModalCustomer">
                <i class="ti-upload mr-1"></i> Importar
            </button>
            <a href="{{ route('admin.customers.create') }}" type="button" class="btn btn-outline-primary btn-pulse btn-sm ml-2">
                <i class="ti-plus mr-1"></i> Nuevo
            </a>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="input-group mb-3 mt-3">
            <input type="text" class="form-control"
                   aria-label="Example text with button addon"
                   placeholder="Buscar por nombre o ruc..." autofocus="" aria-describedby="button-addon1">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="button-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse($customers as $customer)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2">{{ $customer->name }}</h5>
                        <small>Ruc: {{ $customer->ruc }}</small> <br>
                        <small># Colaboradores: {{ $customer->collaborators->count() }}</small> <br>
                       {{--<small>Últ. asiento: 02-Ferb</small>--}}
                        <div class="row col-md-12 mt-3">
                            <a href="{{ route('admin.customers.collaborators.index',$customer->id) }}"
                               class="btn btn-outline-primary btn-sm mr-3 {{ !$customer->is_active ? 'disabled' : ''}}">
                                Ir <i class="ti-arrow-right mr-2 ml-2"></i>
                            </a>
                            <a href="{{ route('admin.customers.edit',$customer->id) }}"
                               class="btn btn-outline-light btn-sm">
                                <i class="ti-pencil"></i>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        @empty
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Aún no tienes clientes registrados</h5>
                    <p class="card-text">Puedes importar los clientes desde un excel o crearlo individual.</p>
                    <a href="#" class="btn btn-outline-primary">
                        <i class="ti-plus mr-1"></i> Nuevo
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    @include('admin.customers.partials.import')
@endsection
