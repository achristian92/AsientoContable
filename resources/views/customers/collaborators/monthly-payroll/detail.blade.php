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
                            <div class="col-4 text-muted text-right font-size-11">{{ $product->header }}</div>
                            <div class="col-8 font-size-11">{{ $product->value }}</div>
                        @endforeach
                    </div>
                @endforeach
            </div>
           {{-- @if (count($payroll->costs_center) > 1)
                <div class="row col-md-6 mt-1">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Costos distribuidos</h6>
                            <h1>
                                {{ $payroll->total_percentage }} %
                                <small>Total</small>
                            </h1>
                            <div class="list-group list-group-flush m-t-10">
                                @foreach($payroll->costs_center as $cost_center)
                                    <div class="list-group-item p-t-b-10 p-l-r-0 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span>{{ $cost_center['name'] }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="ml-3">{{ $cost_center['percentage'] }}%</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive mt-5" tabindex="2" style="overflow: hidden; outline: none;">
                        <table class="table table-borderless table-striped mb-0 table-sm">
                            <thead>
                            <tr class="bg-info-bright">
                                <th class="wd-20 text-center">CONCEPTOS</th>
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
                                    <td class="text-center">{{ $account['cta'] }}</td>
                                    <td>{{ $account['description'] }}</td>
                                    <td class="text-right">@if ($account['type'] === 'debits') {{ number_format($account['value'],2) }}  @endif</td>
                                    <td class="text-right">@if ($account['type'] === 'credits') {{ number_format($account['value'],2) }}  @endif</td>
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
