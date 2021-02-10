@extends('layouts.admin.app')
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
                                <th scope="col"># Asignaciones</th>
                                <th scope="col">Estado</th>
                                <th class="text-right" scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Alejandro Francia<br>
                                    <small class="text-muted"> Aún no ingresa al sistema </small>
                                </td>
                                <td> 5 Clientes</td>
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
                                    <small class="text-muted"> Aún no ingresa al sistema </small>
                                </td>
                                <td> 10 Clientes</td>
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
                                    Erick Guillen<br>
                                    <small class="text-muted"> Aún no ingresa al sistema </small>
                                </td>
                                <td> Todos Clientes</td>
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
                                    Marcos Herrera<br>
                                    <small class="text-muted"> Aún no ingresa al sistema </small>
                                </td>
                                <td> 45 Clientes</td>
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
