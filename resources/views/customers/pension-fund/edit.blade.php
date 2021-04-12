@extends('layouts.customer.app')
@section('assets')
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js">
@endsection
@section('content')
    @include('components.header-body',['title' => 'Fondo pensiones'])
    @component('components.form')
        @slot('title','Crear fondo pensión')
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{ route('admin.customers.pensions.update',[$currentCustomer->id,$model->id])}} ">
                @method('PUT')
                @include('customers.pension-fund.partials.fields',[
                'back'=> route('admin.customers.pensions.index',$currentCustomer->id)
                ])
            </form>
        @endslot
    @endcomponent
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.js-accounts').select2();
        });
    </script>
@endpush
