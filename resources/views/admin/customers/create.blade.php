@extends('layouts.admin.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Clientes',
        'tab' => 'Gestión comercial',
    ])
    <add-customer></add-customer>
@endsection
