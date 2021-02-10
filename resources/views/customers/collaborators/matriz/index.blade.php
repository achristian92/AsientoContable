@extends('layouts.customer.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right" >
                            <button type="button" class="btn btn-outline-light btn-pulse btn-sm ml-2">
                                <i class="ti-plus mr-1"></i> Nuevo
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr class="font-italic font-weight-bold">
                                <th scope="col">Nombres</th>
                                <th scope="col">Área trabajo</th>
                                <th scope="col">Fecha ingreso</th>
                                <th scope="col">Estado</th>
                                <th class="text-right" scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Cecilia Bockos<br>
                                    <small class="text-muted"> Cod: 000162 </small>
                                </td>
                                <td>
                                    Gerencia<br>
                                    <small class="text-muted"> Cargo: AUTOMATIZADOR DE PRUEBA </small>
                                </td>
                                <td>
                                    04/05/2020
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    ALZAMORA MAMANI RAFAEL PABLO<br>
                                    <small class="text-muted"> Cod: 000162 </small>
                                </td>
                                <td>
                                    Gerencia<br>
                                    <small class="text-muted"> Cargo: AUTOMATIZADOR DE PRUEBA </small>
                                </td>
                                <td>
                                    04/05/2020
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    CHAPEYQUEN PAJUELO PIERO PAOLO<br>
                                    <small class="text-muted"> Cod: 000162 </small>
                                </td>
                                <td>
                                    Producción<br>
                                    <small class="text-muted"> Cargo: ANALISTA PROGRAMADOR JAVA </small>
                                </td>
                                <td>
                                    05/02/2020
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    HUAMAN ACUÑA DENIS GIANPIER<br>
                                    <small class="text-muted"> Cod: 000162 </small>
                                </td>
                                <td>
                                    Gerencia<br>
                                    <small class="text-muted"> Cargo: CONSULTOR SOA </small>
                                </td>
                                <td>
                                    02/07/2018
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    PEREZ VASQUEZ CRISTHIAN FABIAN<br>
                                    <small class="text-muted"> Cod: 000120 </small>
                                </td>
                                <td>
                                    Gerencia<br>
                                    <small class="text-muted"> Cargo: ING. DE OPERAC Y MONITORIZAC </small>
                                </td>
                                <td>
                                    10/08/2018
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    Cecilia Bockos<br>
                                    <small class="text-muted"> Cod: 000162 </small>
                                </td>
                                <td>
                                    Gerencia<br>
                                    <small class="text-muted"> Cargo: AUTOMATIZADOR DE PRUEBA </small>
                                </td>
                                <td>
                                    04/05/2020
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    ALZAMORA MAMANI RAFAEL PABLO<br>
                                    <small class="text-muted"> Cod: 000162 </small>
                                </td>
                                <td>
                                    Gerencia<br>
                                    <small class="text-muted"> Cargo: AUTOMATIZADOR DE PRUEBA </small>
                                </td>
                                <td>
                                    04/05/2020
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    CHAPEYQUEN PAJUELO PIERO PAOLO<br>
                                    <small class="text-muted"> Cod: 000162 </small>
                                </td>
                                <td>
                                    Producción<br>
                                    <small class="text-muted"> Cargo: ANALISTA PROGRAMADOR JAVA </small>
                                </td>
                                <td>
                                    05/02/2020
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    HUAMAN ACUÑA DENIS GIANPIER<br>
                                    <small class="text-muted"> Cod: 000162 </small>
                                </td>
                                <td>
                                    Gerencia<br>
                                    <small class="text-muted"> Cargo: CONSULTOR SOA </small>
                                </td>
                                <td>
                                    02/07/2018
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
                                    PEREZ VASQUEZ CRISTHIAN FABIAN<br>
                                    <small class="text-muted"> Cod: 000120 </small>
                                </td>
                                <td>
                                    Gerencia<br>
                                    <small class="text-muted"> Cargo: ING. DE OPERAC Y MONITORIZAC </small>
                                </td>
                                <td>
                                    10/08/2018
                                </td>
                                <td><span class='badge badge-success'>Activo</span></td>
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
@endsection
