@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr class="font-italic font-weight-bold">
                                <th scope="col">Moneda</th>
                                <th scope="col">Compra</th>
                                <th scope="col">Venta</th>
                                <th scope="col">Fecha creación</th>
                                <th class="text-right" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($currencies as $currency)
                                    <tr>
                                        @if ($loop->first)
                                        <td>{{ $currency->code }} <span class="badge badge-info">Usando</span></td>
                                        @else
                                            <td>{{ $currency->code }} </td>
                                        @endif
                                        <td>{{ $currency->buy }}</td>
                                        <td>{{ $currency->sell }}</td>
                                        <td>{{ formatDate($currency->created_at,true) }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.currencies.edit',$currency->id) }}" data-toggle="tooltip" title="" data-original-title="Editar">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
