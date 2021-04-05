@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            @include('customers.collaborators.month-costs.partials.sidebar')
            <div class="col-md-9 app-content">
                <month-assign-show
                    :p_assigns="{{ json_encode($assigns) }}"
                    :p_file="{{ json_encode($file) }}">
                </month-assign-show>
            </div>
        </div>
        @include('customers.collaborators.month-costs.partials.month')
    </div>
@endsection
