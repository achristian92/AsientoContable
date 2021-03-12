@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            <div class="col-md-3 app-sidebar">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <button class="btn btn-outline-facebook"
                                    data-toggle="modal"
                                    data-target="#importModalPayroll">
                                <i class="fa fa-upload mr-2"></i> Subir planilla
                            </button>
                        </div>
                    </div>
                    <div class="app-sidebar-menu" tabindex="1" style="overflow: hidden; outline: none;">
                        <div class="list-group list-group-flush">
                            @foreach($files as $file)
                                <a href="{{ route('admin.customers.payrolls.show',[$currentCustomer->id,$file['id']]) }}" class="list-group-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud width-15 height-15 mr-2"><polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>
                                    {{ $file['name'] }}
                                    <span class="small ml-auto">{{ $file['totalEmployee'] }}</span>
                                </a>
                            @endforeach
                        </div>
                        @if (count($files) === 0)
                            <div class="card-body">
                                <h6 class="mb-4 text-muted">Aún no tienes planillas cargadas</h6>
                                <div class="align-items-center">
                                    <div class="card">
                                        <img src="{{ asset('img/upload_fle.png') }}" style="object-fit: cover" class="card-img-top" alt="...">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9 app-content">
                <div class="card text-center">
                    <div class="card-header">
                        Planilla mensual
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('img/upload-files.png')  }}" class="text-center" style="width: 300px">

                        <h5 class="card-title">Recuerda!</h5>
                        <p class="card-text">1. Carga masivamente o crea tu plan contable <a href="{{ route('admin.customers.accounting-plan.index',$currentCustomer->id) }}">Click aquí</a>.</p>
                        <p class="card-text">2. Carga masivamente o crea tus centro de costos <a href="{{ route('admin.customers.cost-center.index',$currentCustomer->id) }}">Click aquí</a></p>
                        <p class="card-text">3. Si un colaborador tiene varios centros de costo, primero asignarlos.</p>
                    </div>
                </div>
            </div>
        </div>
    @include('customers.collaborators.monthly-payroll.partials.import')
    </div>
@endsection
