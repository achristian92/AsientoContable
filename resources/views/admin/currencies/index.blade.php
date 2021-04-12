@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr class="font-italic font-weight-bold">
                                <th scope="col">Nombres</th>
                                <th scope="col">Código</th>
                                <th scope="col">Símbolo</th>
                                <th scope="col">Valor</th>
                                <th class="text-right" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('admin.currencies.partials.row', $currencies,'currency', 'components.row-empty')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
