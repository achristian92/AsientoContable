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
                                    data-target="#importModalAccount">
                                <i class="ti-upload mr-1"></i> Importar
                            </button>
                            <a href="{{ route('admin.customers.accounting-plan.create',customerID()) }}" class="btn btn-outline-dark btn-pulse btn-sm ml-2">
                                <i class="ti-plus mr-1"></i> Nuevo
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr class="font-italic font-weight-bold">
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th class="text-right" scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $account)
                                    <tr>
                                        <td class="text-left"><strong class="font-size-12">{{ $account['code']  }}</strong></td>
                                        <td><strong class="font-size-12">{{ $account['name']  }}</strong></td>
                                        <td>{{ $account['type'] }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.customers.accounting-plan.edit',[$currentCustomer->id,$account['id']]) }}" data-toggle="tooltip" title="" data-original-title="Editar">
                                                <i class="fa fa-pencil ml-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                        @foreach($account['children'] as $subaccount)
                                            <tr>
                                                <td class="text-center"><strong class="font-size-11">{{ $subaccount['code']  }}</strong></td>
                                                <td><strong class="font-size-11">{{ $subaccount['name']  }}</strong></td>
                                                <td>{{ $subaccount['type'] }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.customers.accounting-plan.edit',[$currentCustomer->id,$subaccount['id']]) }}" data-toggle="tooltip" title="" data-original-title="Editar">
                                                        <i class="fa fa-pencil ml-1"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @foreach($subaccount['children'] as $analitica)
                                                <tr>
                                                    <td class="text-right font-size-11">{{ $analitica['code']  }}</td>
                                                    <td class="font-size-11">{{ $analitica['name']  }}</td>
                                                    <td>{{ $analitica['type'] }}</td>
                                                    <td class="text-right">
                                                        <a href="{{ route('admin.customers.accounting-plan.edit',[$currentCustomer->id,$analitica['id']]) }}" data-toggle="tooltip" title="" data-original-title="Editar">
                                                            <i class="fa fa-pencil ml-1"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endforeach
                                @empty
                                    <tr><td>Aún no tienes registro</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('customers.accounting-plan.partials.import')
@endsection
