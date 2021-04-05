@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            @include('customers.collaborators.monthly-payroll.partials.sidebar')
            <div class="col-md-9 app-content">
                <payrolls-data-table :p_payrolls="{{ json_encode($payrolls) }}"></payrolls-data-table>
            </div>
        </div>
        @include('customers.collaborators.monthly-payroll.partials.import')
    </div>
@endsection
