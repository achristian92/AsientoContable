@extends('layouts.admin.app')
@section('content')
    <div class="row">
        <div class="col-md-12 text-right" >
            <a href="" type="button" class="btn btn-outline-primary btn-pulse btn-sm ">
                <i class="ti-upload mr-1"></i> Importar
            </a>
            <a href="{{ route('admin.customers.create') }}" type="button" class="btn btn-outline-primary btn-pulse btn-sm ml-2">
                <i class="ti-plus mr-1"></i> Nuevo
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        @forelse($customers as $customer)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset('img/edex.png') }}" style="height: 150px;object-fit: contain;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">EDEX SAC</h5>
                        <a href="{{ route('admin.customers.collaborators.index',1) }}" class="btn btn-outline-primary btn-pulse btn-sm ">
                            Ingresar <i class="ti-arrow-right mr-2 ml-2"></i>
                        </a>

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
@endsection
