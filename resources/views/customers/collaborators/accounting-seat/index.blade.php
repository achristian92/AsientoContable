@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            @include('customers.collaborators.accounting-seat.partials.sidebar')
            <div class="col-md-9 app-content">
                <div class="card text-center">
                    <div class="card-header">
                        Asientos Generados
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('img/upload-files.png')  }}" class="text-center" style="width: 300px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
