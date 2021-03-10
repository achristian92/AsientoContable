@extends('layouts.customer.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.customers.payrolls.show',[$payroll->customer,$payroll->file]) }}" class="btn btn-outline-light btn-sm">
                        <i class="ti-back-left mr-2"></i>
                        Regresar
                    </a>
                </div>
                <div class="col text-right text-info font-size-16">
                    {{ $payroll->payroll_month }} <br>
                    <small class="text-dark">Inicio:{{ $payroll->work_start }} - Cese: {{ $payroll->work_end }}</small>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <span class="text-dark font-size-16 font-weight-bold">{{ $payroll->employee }}</span>
                </div>
                <div class="col text-right">
                    <span class="text-primary font-size-16">
                        <small class="text-muted mr-2 text-right">Básico:</small>
                        {{ $payroll->salary }}
                    </span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="card mb-0">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-twitter text-success">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div>
                                    <h6 class="text-uppercase font-size-11">Total ingresos</h6>
                                    <h4 class="mb-0 font-weight-bold">{{ $payroll->total_income }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-0">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-danger  text-danger">
                                    <span class="font-weight-800">-</span>
                                </div>
                                <div>
                                    <h6 class="text-uppercase font-size-11">Total Egresos</h6>
                                    <h4 class="mb-0 font-weight-bold">{{ $payroll->total_expenses }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-0">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-success text-warning">
                                    <i class="fa fa-hospital-o"></i>
                                </div>
                                <div>
                                    <h6 class="text-uppercase font-size-11">Total Aportes</h6>
                                    <h4 class="mb-0 font-weight-bold">{{ $payroll->contribution }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-0">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-block icon-block-floating mr-3 icon-block-lg icon-block-outline-instagram text-warning">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <div>
                                    <h6 class="text-uppercase font-size-11">Neto</h6>
                                    <h4 class="mb-0 font-weight-bold">{{ $payroll->net }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-1">
                <div class="col-md-4">
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Código:</div>
                        <div class="col-8">{{ $payroll->code }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Documento:</div>
                        <div class="col-8">{{ $payroll->document }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Área:</div>
                        <div class="col-8">{{ $payroll->work_area }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Cargo:</div>
                        <div class="col-8">{{ $payroll->position }}</div>
                    </div>
                    @if (count($payroll->costs_center) === 1)
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Centro costos:</div>
                        <div class="col-8">
                            {{ $payroll->costs_center[0]['name'] }}-{{ $payroll->costs_center[0]['percentage'] }}%
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Días Lab:</div>
                        <div class="col-8">{{ $payroll->worked_days }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Horas Lab:</div>
                        <div class="col-8">{{ $payroll->worked_hours }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Asig. Familiar:</div>
                        <div class="col-8">{{ $payroll->has_household }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Pensión:</div>
                        <div class="col-8">{{ $payroll->pension }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">EsSalud:</div>
                        <div class="col-8">{{ $payroll->essalud }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">EPS:</div>
                        <div class="col-8">{{ $payroll->eps }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">Renta 5ta.:</div>
                        <div class="col-8">{{ $payroll->category5 }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">AFP/ONP:</div>
                        <div class="col-8">{{ $payroll->afp_discount }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">AFP Seguro:</div>
                        <div class="col-8">{{ $payroll->insurance }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 text-muted text-right">AFP (RA):</div>
                        <div class="col-8">{{ $payroll->commission }}</div>
                    </div>
                </div>
            </div>
            @if (count($payroll->costs_center) > 1)
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
            @endif
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
                            <tr class="font-size-11">
                                <td class="bg-primary-gradient">Remuneración Básica</td>
                                <td class="text-center">{{ $payroll->concepts['salary']['code'] }}</td>
                                <td>{{ $payroll->concepts['salary']['name'] }}</td>
                                <td class="text-right">{{ $payroll->concepts['salary']['amount'] }}</td>
                                <td class="text-right"></td>
                            </tr>
                            <tr class="font-size-11">
                                <td class="bg-primary-gradient">Asignación Familiar</td>
                                <td class="text-center">{{ $payroll->concepts['family']['code'] }}</td>
                                <td>{{ $payroll->concepts['family']['name'] }}</td>
                                <td class="text-right">{{ $payroll->concepts['family']['amount'] }}</td>
                                <td class="text-right"></td>
                            </tr>
                            <tr class="font-size-11">
                                <td class="bg-danger-gradient">Fondo Pensión</td>
                                <td class="text-center">{{ $payroll->concepts['pension']['code'] }}</td>
                                <td>{{ $payroll->concepts['pension']['name'] }}</td>
                                <td class="text-right"></td>
                                <td class="text-right">{{ $payroll->concepts['pension']['amount'] }}</td>
                            </tr>
                            <tr class="font-size-11">
                                <td class="bg-danger-gradient">Renta de 5ta. Categoría</td>
                                <td class="text-center">{{ $payroll->concepts['5cat']['code'] }}</td>
                                <td>{{ $payroll->concepts['5cat']['name'] }}</td>
                                <td class="text-right"></td>
                                <td class="text-right">{{ $payroll->concepts['5cat']['amount'] }}</td>
                            </tr>
                            <tr class="font-size-11">
                                <td class="bg-danger-gradient">EPS Empleado</td>
                                <td class="text-center">{{ $payroll->concepts['eps']['code'] }}</td>
                                <td>{{ $payroll->concepts['eps']['name'] }}</td>
                                <td class="text-right"></td>
                                <td class="text-right">{{ $payroll->concepts['eps']['amount'] }}</td>
                            </tr>
                            <tr class="font-size-11">
                                <td class="bg-success-gradient">EsSalud</td>
                                <td class="text-center">{{ $payroll->concepts['essalud_g']['code'] }}</td>
                                <td>{{ $payroll->concepts['essalud_g']['name'] }}</td>
                                <td class="text-right">{{ $payroll->concepts['essalud_g']['amount'] }}</td>
                                <td class="text-right"></td>
                            </tr>
                            <tr class="font-size-11">
                                <td class="bg-success-gradient">Total Aporte</td>
                                <td class="text-center">{{ $payroll->concepts['total_pay']['code'] }}</td>
                                <td>{{ $payroll->concepts['total_pay']['name'] }}</td>
                                <td class="text-right"></td>
                                <td class="text-right">{{ $payroll->concepts['total_pay']['amount'] }}</td>
                            </tr>
                            <tr class="font-size-11">
                                <td class="">EsSalud</td>
                                <td class="text-center">{{ $payroll->concepts['essalud_p']['code'] }}</td>
                                <td>{{ $payroll->concepts['essalud_p']['name'] }}</td>
                                <td class="text-right"></td>
                                <td class="text-right">{{ $payroll->concepts['essalud_p']['amount'] }}</td>
                            </tr>
                            <tr class="font-size-11">
                                <td colspan="3"></td>
                                <td class="text-right font-weight-800">{{ $payroll->totalExpense }}</td>
                                <td class="text-right font-weight-800">{{ $payroll->totalPasive }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
