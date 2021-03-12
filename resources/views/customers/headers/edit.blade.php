@extends('layouts.customer.app')
@section('content')
    @component('components.form')
        @slot('title')
            Editar cabecera <br>
        @endslot
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{route('admin.customers.headers.update',[$currentCustomer->id,$model->id])}}">
                @method('PUT')
                @include('customers.headers.partials.fields',[
                'back'=> route('admin.customers.headers.index',$currentCustomer->id)
                ])
            </form>
        @endslot
    @endcomponent
@endsection
