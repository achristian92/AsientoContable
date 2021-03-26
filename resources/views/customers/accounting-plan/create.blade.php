@extends('layouts.customer.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Plan de cuentas',
        'tab' => 'Gestión comercial',
    ])
   <add-plan-account :p_headers = "{{ json_encode($headers) }}"></add-plan-account>
@endsection
