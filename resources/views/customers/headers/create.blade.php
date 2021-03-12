@extends('layouts.customer.app')
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
