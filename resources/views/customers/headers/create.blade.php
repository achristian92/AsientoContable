@extends('layouts.customer.app')
@section('assets')
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js">
@endsection
@section('content')
    @component('components.form')
        @slot('title')
            Crear cabecera <br>
            <small class="text-muted">Las cabeceras sirven para importar la planilla mensual.</small>
        @endslot
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{route('admin.customers.headers.store',$currentCustomer->id)}}">
                @include('customers.headers.partials.fields',[
                'back'=> route('admin.customers.headers.index',$currentCustomer->id)
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
