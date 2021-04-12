@extends('layouts.customer.app')
@section('content')
    @component('components.list')
        @slot('actions')
            <button type="button"
                    class="btn btn-outline-dark btn-pulse btn-sm mr-2"
                    data-toggle="modal"
                    data-target="#importEmployee">
                <i class="ti-upload mr-1"></i> Importar
            </button>
            <a href="{{ route('admin.customers.employee.export',$currentCustomer->id) }}" type="button" class="btn btn-outline-dark btn-pulse btn-sm">
                <i class="ti-download mr-1"></i> Exportar
            </a>

        @endslot
        @slot('table')
            <table class="table">
                <thead class="thead-light">
                <tr class="font-italic font-weight-bold">
                    <th scope="col">Nombres</th>
                    <th scope="col">Fecha ingreso</th>
                    <th scope="col">Acceso Pension</th>
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
    @include('customers.collaborators.matriz.partials.import')
@endsection

