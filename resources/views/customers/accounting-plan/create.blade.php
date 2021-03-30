@extends('layouts.customer.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Plan de cuentas',
        'tab' => 'Gestión comercial',
    ])
   <add-plan-account></add-plan-account>
@endsection
