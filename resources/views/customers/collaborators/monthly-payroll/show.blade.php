@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            @include('customers.collaborators.monthly-payroll.partials.sidebar')
            <div class="col-md-9 app-content">
                <payrolls-data-table
                    :p_file="{{ json_encode($file) }}"
                    :p_payrolls="{{ json_encode($payrolls) }}"
                    :p_more_one_costs="{{$moreCosts}}"
                    :p_without_costs="{{$withoutCosts}}"
                >
                </payrolls-data-table>
            </div>
        </div>
        <import-payroll></import-payroll>
    </div>
@endsection
