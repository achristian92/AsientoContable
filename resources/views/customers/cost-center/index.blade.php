@extends('layouts.customer.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right" >
                            <button type="button" class="btn btn-outline-light btn-pulse btn-sm ml-2">
                                <i class="ti-upload mr-1"></i> Importar
                            </button>
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
                                <th scope="col">Código</th>
                                <th scope="col">Descripción</th>
                                <th class="text-right" scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    0101 <br>
                                </td>
                                <td>
                                    Costos de servicios
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
                                    0202 <br>
                                </td>
                                <td>
                                    Costos administrativos
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
                                    0300 <br>
                                </td>
                                <td>
                                    Costos productivos
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
                                    0400 <br>
                                </td>
                                <td>
                                    Costos ventas
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
@endsection
