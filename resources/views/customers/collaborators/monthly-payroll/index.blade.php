@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            @include('customers.collaborators.monthly-payroll.partials.sidebar')
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
                    </div>
                </div>
            </div>
        </div>
    <import-payroll></import-payroll>
    </div>
@endsection
