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
                            @foreach($files as $file)
                                <a href="{{ route('admin.customers.payrolls.show',[$currentCustomer->id,$file->id]) }}" class="list-group-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud width-15 height-15 mr-2"><polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>
                                    {{ $file->name }}
                                    <span class="small ml-auto">{{ $file->payrolls->count() }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 app-content">
                <div class="app-content-overlay"></div>
                <div class="app-action">
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
                <div class="card app-content-body">

                    <div class="card-body">

                        <h6 class="font-size-11 text-uppercase mb-4">Recently Files</h6>

                        <div class="table-responsive">
                            <table class="table table-small">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @include('customers.collaborators.monthly-payroll.partials.import')
    </div>
    {{--<div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right" >
                            <a href="{{ route('admin.customers.accounting-seat.index',1) }}" class="btn btn-outline-light btn-pulse btn-sm ml-2">
                                <i class="ti-settings mr-1 ml-1"></i> G.Asiento
                            </a>
                            <button type="button" class="btn btn-outline-light btn-pulse btn-sm ml-2">
                                <i class="ti-upload mr-1 ml-1"></i> Importar
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr class="font-italic font-weight-bold">
                                        <th scope="col">Archivos cargados</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="" class="text-primary">Planilla Enero-2021</a> <br>
                                            <small class="text-muted"> Por: Marcos Herrera </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Planilla Diciembre-2020<br>
                                            <small class="text-muted"> Por: Maria Alvites</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Planilla Noviembre-2020<br>
                                            <small class="text-muted"> Por: Renato Rossi</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Planilla Octubre-2020<br>
                                            <small class="text-muted"> Por: Renato Rossi</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Planilla Setiembre-2020<br>
                                            <small class="text-muted"> Por: Renato Rossi</small>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr class="font-italic font-weight-bold">
                                        <th scope="col">
                                            <input class="form-check-input" style="margin-left: 2px;" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                            </label>
                                        </th>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Centro costos</th>
                                        <th scope="col">Fondo</th>
                                        <th class="text-right" scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            MENDOZA PALACIOS GIANFRANCO JENSON<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP HABITAT
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            ANGELES DE LA CRUZ MARIA ALEJANDRA<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP PROFUTURO
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            RIEGA VILELA VICTOR MANUEL<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP HABITAT
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            TAYPE IGNACIO LUIS ALDO<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP HABITAT
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            ANCAJIMA MINGUILLO EVELYN YESSENIA<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP HABITAT
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            MENDOZA PALACIOS GIANFRANCO JENSON<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP HABITAT
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            ANGELES DE LA CRUZ MARIA ALEJANDRA<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP PROFUTURO
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            RIEGA VILELA VICTOR MANUEL<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP HABITAT
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            TAYPE IGNACIO LUIS ALDO<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP HABITAT
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            ANCAJIMA MINGUILLO EVELYN YESSENIA<br>
                                            <small class="text-muted"> Cod: 000162 </small>
                                        </td>
                                        <td>
                                            004015<br>
                                        </td>
                                        <td>
                                            AFP HABITAT
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-sm"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>--}}
@endsection
