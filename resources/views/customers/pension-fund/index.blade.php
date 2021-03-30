@extends('layouts.customer.app')
@section('content')
    @component('components.list')
        @slot('actions')
            @include('components.btn-create',['route' =>  route('admin.customers.pensions.create',$currentCustomer->id) ])
        @endslot
        @slot('table')
            <div tabindex="1" class="table-responsive" style="overflow: hidden; outline: none;">
                <table class="table table-striped">
                    <thead>
                    <tr class="text-uppercase font-size-11 text-muted">
                        <th>Abreviatura</th>
                        <th>Nombre</th>
                        <th>Cuenta contable</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @each('customers.pension-fund.partials.row', $pensions,'pension', 'components.row-empty')
                    </tbody>
                </table>
            </div>
        @endslot
    @endcomponent
@endsection
