@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right" >
                            <button type="button"
                                    class="btn btn-outline-dark btn-pulse btn-sm"
                                    data-toggle="modal"
                                    data-target="#importModalCenterCost2">
                                <i class="ti-upload mr-1"></i> Importar
                            </button>
                            <a href="{{ route('admin.customers.cost-center2.create',$currentCustomer->id) }}" type="button" class="btn btn-outline-dark btn-pulse btn-sm ml-2">
                                <i class="ti-plus mr-1"></i> Nuevo
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr class="font-italic font-weight-bold">
                                <th scope="col">Código</th>
                                <th scope="col">Descripción</th>
                                <th class="text-right" scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @each('customers.cost-center2.partials.row', $centerCosts,'centerCost', 'components.row-empty')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('customers.cost-center2.partials.import')
@endsection
