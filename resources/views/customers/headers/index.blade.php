@extends('layouts.customer.app')
@section('content')
    @component('components.list')
        @slot('actions')
            @include('components.btn-create',['route' =>  route('admin.customers.headers.create',$currentCustomer->id) ])
        @endslot
        @slot('filters')
            <h4>Cabeceras Planilla</h4>
            <small class="text-muted">Las cabeceras sirven para importar la planilla mensual.</small>
        @endslot
        @slot('table')
            <div class="col-md-12 text-right">(*) La cabecera es obligatorio</div>
            <div tabindex="1" class="table-responsive" style="overflow: hidden; outline: none;">
                <table class="table table-striped">
                    <thead>
                    <tr class="text-uppercase font-size-11 text-muted">
                        <th>Cabecera</th>
                        <th>Orden</th>
                        <th>Cuenta contable</th>
                        <th>Estado</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @each('customers.headers.partials.row', $headers,'header', 'components.row-empty')
                    </tbody>
                </table>
            </div>
        @endslot
    @endcomponent
@endsection
