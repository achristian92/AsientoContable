@extends('layouts.customer.app')
@section('content')
    @component('components.list')
        @slot('actions')
            @include('components.btn-create',['route' =>  route('admin.customers.headers.create',$currentCustomer->id) ])
        @endslot
        @slot('filters')
            <p class="text-muted">* Las cabeceras sirven para importar la planilla mensual y se mostrará de acuerdo al número de orden</p>
        @endslot
        @slot('table')
            <table class="table">
                <thead class="thead-light">
                <tr class="font-italic font-weight-bold">
                    <th>Cabecera</th>
                    <th>Orden</th>
                    <th>R.Cuenta Contable</th>
                    <th class="text-right"></th>
                </tr>
                </thead>
                <tbody>
                @each('customers.headers.partials.row', $headers,'header', 'components.row-empty')
                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection
