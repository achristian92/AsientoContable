@extends('layouts.admin.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Clientes',
        'tab' => 'Gestión comercial',
    ])
    @component('components.form')
        @slot('title','Crear cliente')
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{route('admin.customers.store')}}">
                @include('admin.customers.partials.fields',[
                'back'=> route('admin.customers.index')
                ])
            </form>
        @endslot
    @endcomponent
@endsection
