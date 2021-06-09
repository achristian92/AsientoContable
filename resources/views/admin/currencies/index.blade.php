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
                                <th>Fecha</th>
                                <th>Moneda</th>
                                <th>Tipo de cambio</th>
                                {{--<th>Venta</th>--}}
                                <th class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($currencies as $currency)
                                    <tr>
                                        <td>{{ formatDate($currency->created_at) }}</td>
                                        <td>{{ $currency->code }} </td>
                                        <td>{{ $currency->buy }}</td>
                                      {{--  <td>{{ $currency->sell }}</td>--}}
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
