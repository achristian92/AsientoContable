@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            @include('customers.collaborators.vouchers.partials.sidebar')
            <div class="col-md-9 app-content">
                <div class="card text-center">
                    <div class="card-header">
                        Gestión de boletas de pago
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('img/upload-files.png')  }}" class="text-center" style="width: 300px">
                        <h5 class="card-title">Recuerda!</h5>
                        <p class="card-text">1. Selecciona el mes.</p>
                        <p class="card-text">2. Descarga tu boleta.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
