@extends('layouts.customer.app')
@section('content')
    <div class="container-fluid">
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

    </div>
@endsection
