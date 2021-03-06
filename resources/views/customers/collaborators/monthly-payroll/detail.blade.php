@extends('layouts.customer.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.customers.payrolls.show',[$detail['info']['customer_id'],$detail['info']['file_id']]) }}" class="btn btn-outline-light btn-sm">
                        <i class="ti-back-left mr-2"></i>
                        Regresar
                    </a>
                </div>
                <div class="col text-right text-info font-size-16">
                    {{ $detail['info']['payrollMonth'] }} <br>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <span class="text-dark font-size-16 font-weight-bold">{{ $detail['info']['worker'] }}</span>
                </div>
                <div class="col text-right">
                    <span class="text-primary font-size-16">
                        <small class="text-muted mr-2 text-right">Remuneración Básica:</small>
                        {{ $detail['info']['remuneration'] }}
                    </span>
                </div>
            </div>
            @include('customers.collaborators.monthly-payroll.partials.total-costs',[
                'income'       =>  $detail['costs']['totalIncome'],
                'expense'      =>  $detail['costs']['totalExpense'],
                'contribution' =>  $detail['costs']['totalContribution'],
                'net'          =>  $detail['costs']['netToPay'],
            ])
            <div class="row mt-3 mb-1">
                @foreach ($detail['concepts']->chunk(11) as $chunk)
                    <div class="row col-md-4">
                        @foreach ($chunk as $product)
                            <div class="col-5 text-muted text-right font-size-11">{{ $product->header }}</div>
                            <div class="col-7 font-size-11">{{ $product->value }}</div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive mt-5" tabindex="2" style="overflow: hidden; outline: none;">
                        <table class="table table-borderless table-striped mb-0 table-sm">
                            <thead>
                            <tr class="bg-info-bright">
                                <th>Centro de costo</th>
                                <th>Porcentaje</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($detail['costCenters'] as $cost)
                                <tr class="font-size-11">
                                    <td>{{ $cost['cost'] }}</td>
                                    <td>{{ $cost['percentage'] }}%</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive mt-5" tabindex="2" style="overflow: hidden; outline: none;">
                        <table class="table table-borderless table-striped mb-0 table-sm">
                            <thead>
                            <tr class="bg-info-bright">
                                <th class=" text-center">CONCEPTOS</th>
                                <th class="wd-10 text-center text-center">CTA</th>
                                <th class="wd-50 text-center text-center">DETALLE</th>
                                <th class="wd-10 text-center">DEBE</th>
                                <th class="wd-10 text-center">HABER</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($detail['accounts'] as $account)
                                <tr class="font-size-11">
                                    <td class="text-muted text-center">{{ $account['concept'] }}</td>
                                    <td class="text-center">{{ $account['nroAccount'] }}</td>
                                    <td>{{ $account['account'] }}</td>
                                    <td class="text-right">@if ($account['type'] === \App\AsientoContable\AccountPlan\AccountPlan::TYPE_EXPENSE) {{ number_format($account['value'],2) }}  @endif</td>
                                    <td class="text-right">@if ($account['type'] === \App\AsientoContable\AccountPlan\AccountPlan::TYPE_PASIVE) {{ number_format($account['value'],2) }}  @endif</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right font-weight-800">{{ $detail['totalMust'] }}</td>
                                <td class="text-right font-weight-800">{{ $detail['totalHas'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
