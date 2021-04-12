@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            @include('customers.collaborators.vouchers.partials.sidebar')
            <div class="col-md-9 app-content">
                <voucher-show
                    :p_employees="{{ json_encode($employees) }}"
                    :p_file="{{ json_encode($file) }}">
                </voucher-show>
            </div>
        </div>
    </div>
@endsection
