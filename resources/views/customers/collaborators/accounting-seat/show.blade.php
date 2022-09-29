@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            @include('customers.collaborators.accounting-seat.partials.sidebar')
            <div class="col-md-9 app-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <H4>Asientos generado  {{ $file->name }}</H4>
                            <div class="row">
                                <div class="col-md-12 text-right" >
                                    @if($file->status === 'Abierto')
                                        <a href="{{ route('admin.customers.seating.delete',[$currentCustomer->id,$file->id]) }}" class="btn btn-outline-danger btn-pulse btn-sm ml-2">
                                            <i class="ti-trash mr-1 ml-1"></i> Eliminar
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.customers.seating.export',[$currentCustomer->id,$file->id]) }}" class="btn btn-outline-light btn-pulse btn-sm ml-2">
                                        <i class="ti-download mr-1 ml-1"></i> Exportar
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr class="font-italic font-weight-bold">
                                        <th>Nro</th>
                                        <th>Cuenta-Glosa</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Centro</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($seating as $seat)
                                        <tr class="small">
                                            <td>
                                                {{ $seat->nro_asiento }}
                                            </td>
                                            <td>
                                                {{ $seat->cuenta_contable }} - {{ $seat->glosa_asiento }} <br>
                                                <span class="text-muted">{{ $seat->employee->full_name }}({{ $seat->nro_documento }})</span>
                                            </td>
                                            <td class="text-right">
                                                S/{{ number_format($seat->debe,2) }} <br>
                                                <span class="text-muted">${{ number_format($seat->debe_usd,2) }}</span>
                                            </td>
                                            <td class="text-right">
                                                S/{{ number_format($seat->haber,2) }} <br>
                                                <span class="text-muted">${{ number_format($seat->haber_usd,2) }}</span>
                                            </td>
                                            <td class="text-right">
                                                {{ $seat->cost }}
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
        </div>
    </div>

@endsection
