@extends('layouts.admin.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Clientes',
        'tab' => 'Gestión comercial',
    ])
    <edit-customer :p_customer="{{ $customer }}"></edit-customer>
@endsection
