@extends('layouts.admin.app')
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
                                    data-target="#importModalCustomer">
                                <i class="ti-upload mr-1"></i> Importar
                            </button>
                            <a href="{{ route('admin.customers.create') }}" class="btn btn-outline-dark btn-pulse btn-sm ml-2">
                                <i class="ti-plus mr-1"></i> Nuevo
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <form action="{{ route('admin.customers.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text"
                                       name="q"
                                       class="form-control"
                                       placeholder="Buscar.."
                                       value="{{ request()->input('q') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr class="font-italic font-weight-bold">
                                <th scope="col">RUC</th>
                                <th scope="col">EMPRESA</th>
                                <th scope="col">ESTADO</th>
                                <th class="text-right" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('admin.customers.partials.row', $customers,'customer', 'components.row-empty')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('admin.customers.partials.import')
@endsection
