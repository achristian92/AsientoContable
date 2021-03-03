@extends('layouts.customer.app')
@section('content')
    @component('components.list')
        @slot('actions')
            @include('components.btn-create',['route' =>  route('admin.customers.collaborators.create',$currentCustomer->id) ])
        @endslot
        @slot('table')
            <table class="table">
                <thead class="thead-light">
                <tr class="font-italic font-weight-bold">
                    <th scope="col">Nombres</th>
                    <th scope="col">Fecha ingreso</th>
                    <th scope="col">Estado</th>
                    <th class="text-right" scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @each('customers.collaborators.matriz.partials.row', $collaborators,'collaborator', 'components.row-empty')
                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection

