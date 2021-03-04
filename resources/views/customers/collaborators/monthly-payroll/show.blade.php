@extends('layouts.customer.app')
@section('content')
    @include('components.errors-and-messages')
    <div class="container-fluid">
        <div class="row app-block">
            <div class="col-md-3 app-sidebar">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <button class="btn btn-outline-facebook"
                                    data-toggle="modal"
                                    data-target="#importModalPayroll">
                                <i class="fa fa-upload mr-2"></i> Subir planilla
                            </button>
                        </div>
                    </div>
                    <div class="app-sidebar-menu" tabindex="1" style="overflow: hidden; outline: none;">
                        <div class="list-group list-group-flush">
                            @foreach($files as $file_upload)
                                <a href="{{ route('admin.customers.payrolls.show',[$currentCustomer->id,$file_upload->id]) }}" class="list-group-item d-flex align-items-center {{ $file_upload->id === $file->id ? 'text-primary' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud width-15 height-15 mr-2"><polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>
                                    {{ $file_upload->name }}
                                    <span class="small ml-auto">{{ $file_upload->payrolls->count() }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 app-content">
                <div class="app-content-overlay"></div>
                {{--<div class="app-action">
                    <div class="action-left">
                        <ul class="list-inline">
                            <li class="list-inline-item mb-0">
                                <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                    Ordenar por
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Nombres</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="action-right">
                        <form class="d-flex mr-3">
                            <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                            </a>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search file" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-light" type="button" id="button-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>--}}
                <div class="card app-content-body">
                    <div class="card-body">
                        <div class="app-action mb-0">
                            <div class="action-left">
                                <ul class="list-inline">
                                    <li class="list-inline-item mb-0">
                                        <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                            Ordenar por
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Nombres</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="action-right">
                                <form class="d-flex mr-3">
                                    <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                    </a>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search file" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-light" type="button" id="button-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{--<div class="row">
                            <div class="col-md-3 text-right">
                                <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                    Ordenar por
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Nombres</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <form class="d-flex mr-3">
                                    <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                    </a>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search file" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-light" type="button" id="button-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>--}}
                        <div class="row mb-2">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-sm btn-outline-dark text-right">
                                    <i class="ti-settings mr-1 ml-1"></i> G.Asiento
                                </button>
                            </div>
                        </div>


                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        <input class="form-check-input" style="margin-left: 2px;" type="checkbox" value="" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            &nbsp;&nbsp;
                                        </label>
                                    </th>
                                    <th class="text-center">Nombres</th>
                                    <th class="text-center">Ingresos</th>
                                    <th class="text-center">Egresos</th>
                                    <th class="text-center">Aportes</th>
                                    <th class="text-center">Neto</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payrolls as $payroll)
                                    <tr>
                                        <td class="text-center">
                                            <input class="form-check-input" style="margin-left: 2px;" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                &nbsp;&nbsp;
                                            </label>
                                        </td>
                                        <td>
                                            {{ ucwords(strtolower($payroll->collaborator->full_name)) }} <br>
                                            <small>
                                                <a href="#" data-toggle="tooltip" title="{{ $payroll->work_area }} | {{ $payroll->position }}" data-original-title="Asignación familiar">
                                                    <i class="fa fa-id-card-o"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" title="{{ $payroll->pension }}" data-original-title="Asignación familiar">
                                                    <span class="ml-2">{{ $payroll->pension_short }} </span>
                                                </a>
                                                @if ($payroll->family_allowance)
                                                    <a href="#" data-toggle="tooltip" title="" data-original-title="Asignación familiar">
                                                        <i class="fa fa-user-o ml-2"></i>
                                                    </a>
                                                @endif
                                            </small>
                                        </td>
                                        <td class="text-primary text-center">+ S/{{ number_format($payroll->total_income,2) }}</td>
                                        <td class="text-danger text-center">- S/{{ number_format($payroll->total_expense,2) }}</td>
                                        <td class="text-success text-center">S/{{ number_format($payroll->total_contribution,2) }}</td>
                                        <td class="text-info text-center">S/{{ number_format($payroll->net_pay,2) }}</td>
                                        <td class="text-right">
                                            <a href="#" data-toggle="tooltip" title="" data-original-title="Detail">
                                                <i class="fa fa-external-link"></i>
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
        @include('customers.collaborators.monthly-payroll.partials.import')
    </div>
@endsection
