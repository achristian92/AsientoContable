@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right" >
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-light btn-pulse btn-sm ml-2">
                                <i class="ti-plus mr-1"></i> Nuevo
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr class="font-italic font-weight-bold">
                                <th scope="col">Nombres</th>
                                <th scope="col">Perfil</th>
                                <th scope="col"># Asignaciones</th>
                                <th scope="col">Estado</th>
                                <th class="text-right" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                             @each('admin.users.partials.row', $users,'user', 'components.row-empty')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
